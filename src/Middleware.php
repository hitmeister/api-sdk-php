<?php

namespace Hitmeister\Component\Api;

use GuzzleHttp\Ring\Core;
use Hitmeister\Component\Api\Exceptions\BadRequestException;
use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Exceptions\ServerException;
use Hitmeister\Component\Api\Exceptions\TransportException;
use Hitmeister\Component\Api\Helper\Logger;
use Hitmeister\Component\Api\Helper\Security;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * Class Middleware
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Middleware
{
	/**
	 * @param callable $handler
	 * @param string   $clientKey
	 * @param string   $clientSecret
	 * @return callable
	 */
	public static function signRequest(callable $handler, $clientKey, $clientSecret)
	{
		return function (array $request) use ($handler, $clientKey, $clientSecret) {
			$now = time();

			// Client and time stamp
			$request['headers']['HM-Client'] = [$clientKey];
			$request['headers']['HM-Timestamp'] = [$now];

			// Sign and add
			$body = isset($request['body']) ? $request['body'] : '';
			$signature =
				Security::signRequest($clientSecret, $request['http_method'], Core::url($request), $body, $now);
			$request['headers']['HM-Signature'] = [$signature];

			// Send the request using the handler and return the response.
			return $handler($request);
		};
	}

	/**
	 * @param callable        $handler
	 * @param LoggerInterface $logger
	 * @return callable
	 */
	public static function processResponse(callable $handler, LoggerInterface $logger)
	{
		return function (array $request) use ($handler, $logger) {
			return Core::proxy($handler($request), function (array $response) use ($request, $logger) {
				// Is there any error?
				if (isset($response['error'])) {
					$exception = new TransportException('Request failure', 0, $response['error']);

					Logger::logState($logger, $request, $response, $exception, LogLevel::CRITICAL);
					throw $exception;
				}

				$response['json'] = null;

				// Read body
				if (isset($response['body']) && is_resource($response['body'])) {
					$response['body'] = stream_get_contents($response['body']); // false if something wrong

					// Extract json data
					if ($response['body']) {
						$response['json'] = json_decode($response['body'], true); // null if something wrong
					}
				}

				// Process errors
				if ($response['status'] >= 400) {
					$ignore = isset($request['client']['ignore']) ? (array)$request['client']['ignore'] : [];

					// It is possible to ignore some status codes
					if (!in_array($response['status'], $ignore)) {
						// Is there any message?
						$message = isset($response['json']['message']) ? $response['json']['message'] : 'Unknown error';

						if ($response['status'] >= 400 && $response['status'] < 500) {
							if (404 == $response['status']) {
								$exception = new ResourceNotFoundException();
							} else {
								$exception = new BadRequestException($message, $response['status']);
							}
						} else {
							$exception = new ServerException($message, $response['status']);
						}

						Logger::logState($logger, $request, $response, $exception, LogLevel::ERROR);
						throw $exception;
					}
				}

				Logger::logState($logger, $request, $response);
				return $response;
			});
		};
	}
}