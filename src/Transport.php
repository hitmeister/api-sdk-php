<?php

namespace Hitmeister\Component\Api;

use GuzzleHttp\Ring\Core;
use Hitmeister\Component\Api\Exceptions\BadRequestException;
use Hitmeister\Component\Api\Exceptions\InvalidArgumentException;
use Hitmeister\Component\Api\Exceptions\ServerException;
use Hitmeister\Component\Api\Exceptions\TransportException;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * Class Transport
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Transport
{
	/**
	 * @var callable
	 */
	private $handler;

	/** @var LoggerInterface */
	private $logger;

	/** @var string */
	private $schema = 'https';

	/** @var string */
	private $uriPrefix = '/api/v1/';

	/** @var string */
	private $host = 'www.hitmeister.de';

	/** @var string  */
	private $userAgent = 'HitmeisterSDK';

	/**
	 * @param callable        $handler
	 * @param string          $baseUrl
	 * @param LoggerInterface $logger
	 * @throws InvalidArgumentException
	 */
	public function __construct(callable $handler, $baseUrl, LoggerInterface $logger)
	{
		$hostDetails = parse_url($baseUrl);
		if (false === $hostDetails) {
			throw new InvalidArgumentException('Could not parse API URL');
		}

		if (isset($hostDetails['scheme'])) {
			$this->schema = $hostDetails['scheme'];
		}
		if (isset($hostDetails['path'])) {
			$this->uriPrefix = rtrim($hostDetails['path'], '/') . '/';
		}
		if (isset($hostDetails['host'])) {
			$this->host = $hostDetails['host'];
		}

		$this->handler = $this->wrapHandler($handler, $logger);
		$this->logger = $logger;
	}

	/**
	 * @param string $method
	 * @param string $uri
	 * @param array  $params
	 * @param mixed  $body
	 * @param array  $options
	 * @return array
	 */
	public function performRequest($method, $uri, $params = null, $body = null, array $options = [])
	{
		if (isset($body)) {
			$body = json_encode($body);
		}

		$request = [
			'http_method' => $method,
			'scheme' => $this->schema,
			'uri' => $this->uriPrefix . $uri,
			'body' => $body,
			'headers' => [
				'Host' => [$this->host],
				'User-Agent' => [$this->userAgent],
			],
			'client' => [
				'connect_timeout' => 30,
				'timeout' => 60,
			],
		];

		// Build query
		if (!empty($params)) {
			$request['query_string'] = http_build_query($params);
		}

		// To be able to change some options
		$request = array_merge_recursive($request, $options);

		// Run
		$handler = $this->handler;
		$result = $handler($request);

		return $result;
	}

	/**
	 * @param callable        $handler
	 * @param LoggerInterface $logger
	 * @return callable
	 */
	protected function wrapHandler(callable $handler, LoggerInterface $logger)
	{
		return function (array $request) use ($handler, $logger) {
			$response = Core::proxy($handler($request), function (array $response) use ($request, $logger) {

				// Shit happens
				if (isset($response['error'])) {
					/** @var \Exception $error */
					$error = $response['error'];
					$message = 'Request failure: ' . $error->getMessage();
					$exception = new TransportException($message, 0, $error);

					$this->log($request, $response, $message, LogLevel::CRITICAL);
					throw $exception;
				}

				// Read body
				if (isset($response['body'])) {
					$response['body'] = stream_get_contents($response['body']);

					// Extract json data
					if (!empty($response['body'])) {
						$response['json'] = json_decode($response['body'], true);
					}
				}

				// Process errors
				if ($response['status'] >= 400) {
					$this->processError($request, $response);
				}

				$this->log($request, $response, 'Request success');
				return $response;
			});

			return $response;
		};
	}

	/**
	 * @param array $request
	 * @param array $response
	 * @throws BadRequestException
	 * @throws ServerException
	 */
	protected function processError(array $request, array $response)
	{
		// It is possible to ignore this status codes
		$ignore = isset($request['client']['ignore']) ? (array)$request['client']['ignore'] : [];
		if (in_array($response['status'], $ignore)) {
			return;
		}

		// Is there any message?
		$message = isset($response['json']['message']) ? $response['json']['message'] : 'Unknown error';

		if ($response['status'] >= 400 && $response['status'] < 500) {
			$exception = new BadRequestException('Client Error: ' . $message, $response['status']);
		} else {
			$exception = new ServerException('Server Error: ' . $message, $response['status']);
		}

		$this->log($request, $response, $exception->getMessage(), LogLevel::ERROR);
		throw $exception;
	}

	/**
	 * @param array  $request
	 * @param array  $response
	 * @param string $message
	 * @param string $level
	 */
	protected function log(array $request, array $response, $message, $level = LogLevel::INFO)
	{
		if (isset($request['body'])) {
			$this->logger->debug('Hitmeister API Request body', (array)$request['body']);
		}

		$this->logger->log($level, 'Hitmeister API ' . $message, [
			'method' => $request['request_method'],
			'uri' => $response['effective_url'],
			'headers' => $request['headers'],
			'duration' => $response['transfer_stats']['total_time'],
			'status' => $response['status'],
		]);

		if (isset($response['body'])) {
			$this->logger->debug('Hitmeister API Response body', (array)$response['body']);
		}
	}
}