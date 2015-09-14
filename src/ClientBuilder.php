<?php

namespace Hitmeister\Component\Api;

use GuzzleHttp\Ring\Client\CurlHandler;
use GuzzleHttp\Ring\Client\CurlMultiHandler;
use Hitmeister\Component\Api\Exceptions\RuntimeException;
use Hitmeister\Component\Api\Transport\RequestBuilder;
use Hitmeister\Component\Api\Transport\Transport;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Class ClientBuilder
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ClientBuilder
{
	/** @var LoggerInterface */
	private $logger;

	/** @var string */
	private $clientKey;

	/** @var string */
	private $clientSecret;

	/** @var string */
	private $baseUrl;

	/** @var callable */
	private $handler;

	/** @var Transport */
	private $transport;

	/**
	 * @return ClientBuilder
	 */
	public static function create()
	{
		return new static();
	}

	/**
	 * @param array $options
	 * @return callable
	 * @throws RuntimeException
	 */
	public static function defaultHandler(array $options = [])
	{
		if (!extension_loaded('curl'))
			throw new RuntimeException('Hitmeister SDK requires cURL, or a custom HTTP handler.');

		// For some reason `CurlHandler` uses `curl_reset` function from PHP 5.5
		if (!function_exists('curl_reset'))
			return new CurlMultiHandler($options);

		return new CurlHandler($options);
	}

	/**
	 * @param LoggerInterface $logger
	 * @return $this
	 */
	public function setLogger($logger)
	{
		$this->logger = $logger;
		return $this;
	}

	/**
	 * @param string $clientKey
	 * @return $this
	 */
	public function setClientKey($clientKey)
	{
		$this->clientKey = $clientKey;
		return $this;
	}

	/**
	 * @param string $clientSecret
	 * @return $this
	 */
	public function setClientSecret($clientSecret)
	{
		$this->clientSecret = $clientSecret;
		return $this;
	}

	/**
	 * @param string $baseUrl
	 * @return $this
	 */
	public function setBaseUrl($baseUrl)
	{
		$this->baseUrl = rtrim($baseUrl, '/') . '/';
		return $this;
	}

	/**
	 * @param callable $handler
	 * @return $this
	 */
	public function setHandler(callable $handler)
	{
		$this->handler = $handler;
		return $this;
	}

	/**
	 * @param Transport $transport
	 * @return $this
	 */
	public function setTransport(Transport $transport)
	{
		$this->transport = $transport;
		return $this;
	}

	/**
	 * @return Client
	 */
	public function build()
	{
		$this->validate();

		if (null === $this->logger)
			$this->logger = new NullLogger();

		if (null === $this->handler)
			$this->handler = ClientBuilder::defaultHandler();

		$this->handler = Middleware::signRequest($this->handler, $this->clientKey, $this->clientSecret);
		$this->handler = Middleware::processResponse($this->handler, $this->logger);

		if (null === $this->transport)
			$this->transport = new Transport($this->handler, new RequestBuilder($this->baseUrl));

		return new Client($this->transport);
	}

	/**
	 * @throws RuntimeException
	 */
	protected function validate()
	{
		if (empty($this->clientKey) || empty($this->clientSecret)) {
			throw new RuntimeException('Please specify clientKey and clientSecret');
		}
	}
}