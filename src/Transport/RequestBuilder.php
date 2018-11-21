<?php

namespace Hitmeister\Component\Api\Transport;

use Hitmeister\Component\Api\Client;

/**
 * Class RequestBuilder
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Transport
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class RequestBuilder
{
	/** @var string */
	protected $schema = 'https';

	/** @var string */
	protected $host = 'www.real.de';

	/** @var string */
	protected $uri = '/api/v1/';

	/** @var string */
	protected $userAgent;

	/**
	 * @param string $apiUrl
	 */
	public function __construct($apiUrl = null)
	{
		if (null === $apiUrl) {
			$apiUrl = static::defaultApiUrl();
		}

		$urlComponents = parse_url($apiUrl);

		if (isset($urlComponents['scheme'])) {
			$this->schema = $urlComponents['scheme'];
		}
		if (isset($urlComponents['host'])) {
			$this->host = $urlComponents['host'];
		}
		if (isset($urlComponents['path'])) {
			$this->uri = rtrim($urlComponents['path'], '/') . '/';
		}
	}

	/**
	 * @return string
	 * @codeCoverageIgnore
	 */
	public static function defaultApiUrl()
	{
		return 'https://www.real.de/api/v1/'; // trailing slash is required
	}

	/**
	 * @return string
	 */
	public function getUserAgent()
	{
		if (null === $this->userAgent) {
			$this->userAgent = 'HitSDK/' . Client::VERSION;
			if (extension_loaded('curl') && function_exists('curl_version')) {
				$this->userAgent .= ' curl/' . \curl_version()['version'];
			}
			$this->userAgent .= ' PHP/' . PHP_VERSION;
		}
		return $this->userAgent;
	}

	/**
	 * Creates only basic request params
	 *
	 * @param string     $method
	 * @param string     $uri
	 * @param null|array $params
	 * @return array
	 */
	public function build($method, $uri, $params = null)
	{
		$request = [
			'http_method' => $method,
			'scheme' => $this->schema,
			'uri' => $this->uri . $uri,
			'headers' => [
				'Host' => [$this->host],
				'User-Agent' => [$this->getUserAgent()],
			],
			'client' => [
				'connect_timeout' => 30,
				'timeout' => 60,
			],
			'version' => 1.1,
		];

		// Build query
		if (!empty($params)) {
			$request['query_string'] = http_build_query($params);
		}

		return $request;
	}
}