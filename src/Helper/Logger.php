<?php

namespace Hitmeister\Component\Api\Helper;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * Class Logger
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Helper
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Logger
{
	/**
	 * @param LoggerInterface $logger
	 * @param array           $request
	 * @param array           $response
	 * @param \Exception|null $exception
	 * @param string          $level
	 * @codeCoverageIgnore
	 */
	public static function logState(LoggerInterface $logger, array $request, array $response, \Exception $exception = null, $level = LogLevel::INFO)
	{
		if (isset($request['body'])) {
			static::log($logger, 'Request body', (array)$request['body'], LogLevel::DEBUG);
		}

		$message = (null === $exception ? 'Request success' : $exception->getMessage());
		$context = [
			'method'    => $request['http_method'],
			'headers'   => $request['headers'],
			'uri'       => $response['effective_url'],
			'duration'  => $response['transfer_stats']['total_time'],
			'status'    => $response['status'],
			'exception' => ($exception?:[])
		];

		static::log($logger, $message, $context, $level);

		if (isset($response['body'])) {
			static::log($logger, 'Response body', (array)$response['body'], LogLevel::DEBUG);
		}
	}

	/**
	 * @param LoggerInterface $logger
	 * @param string          $message
	 * @param array           $context
	 * @param string          $level
	 */
	protected static function log(LoggerInterface $logger, $message, array $context, $level)
	{
		$logger->log($level, 'Hitmeister API '.$message, $context);
	}
}