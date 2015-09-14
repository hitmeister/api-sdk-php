<?php

namespace Hitmeister\Component\Api\Transport;

use GuzzleHttp\Ring\Future\FutureArrayInterface;

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

	/**
	 * @param callable       $handler
	 * @param RequestBuilder $requestBuilder
	 */
	public function __construct(callable $handler, RequestBuilder $requestBuilder)
	{
		$this->handler = $handler;
		$this->requestBuilder = $requestBuilder;
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
		$request = array_merge_recursive($request, $options);

		// Run
		$handler = $this->handler;
		$result = $handler($request);

		if ($result instanceof FutureArrayInterface) {
			do {
				$result = $result->wait();
			} while ($result instanceof FutureArrayInterface);
		}

		return $result;
	}
}