<?php

namespace Hitmeister\Component\Api\Transport;

use GuzzleHttp\Ring\Future\FutureArrayInterface;
use Hitmeister\Component\Api\Middleware;

/**
 * Class Transport
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Transport
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Transport
{
	/** @var callable */
	private $handler;

	/** @var RequestBuilder */
	private $requestBuilder;

	/** @var string */
	private $clientKey;

	/** @var string */
	private $clientSecret;

	/**
	 * @param callable $handler
	 * @param RequestBuilder $requestBuilder
	 * @param string $clientKey
	 * @param string $clientSecret
	 */
	public function __construct(callable $handler, RequestBuilder $requestBuilder, string $clientKey = '', string $clientSecret = '')
	{
		$this->handler = $handler;
		$this->requestBuilder = $requestBuilder;
		$this->clientKey = $clientKey;
		$this->clientSecret = $clientSecret;
	}

	/**
	 * @param string     $method
	 * @param string     $uri
	 * @param null|array $params
	 * @param mixed      $body
	 * @param array      $options
	 * @return mixed
	 */
	public function performRequest($method, $uri, $params = null, $body = null, array $options = [])
	{
		// Basic request
		$request = $this->requestBuilder->build($method, $uri, $params);

		// Build body
		if (isset($body)) {
			$request['body'] = json_encode($body);
		}

		// To be able to change some options
		$request = array_merge($request, $options);

		// Run
		$handler = $this->handler;
		$result = $handler($request);

		// If there is a redirect, resign the request and send it to the new location
		if (preg_match('/^3/', $result['status'])) {
			$redirectUrl = $result['headers']['Location'][0];

			$options['headers']['Host'] = [parse_url($redirectUrl)['host']];

			$this->handler = Middleware::signRequest($handler, $this->clientKey, $this->clientSecret);

			return self::performRequest($method, $uri, $params, $body, $options);
		}

		if ($result instanceof FutureArrayInterface) {
			do {
				$result = $result->wait();
			} while ($result instanceof FutureArrayInterface);
		}

		return $result;
	}
}
