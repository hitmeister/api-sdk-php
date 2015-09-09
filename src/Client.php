<?php
/**
 * Created for Hitmeister Project.
 * User: Maksim Naumov <maksim.naumov@hitmeister.de>
 * Date: 09/09/15
 * Time: 15:08
 */

namespace Hitmeister\Component\Api;

use GuzzleHttp;

class Client
{
	/**
	 *
	 */
	const VERSION = 'development';

	/**
	 * Hitmeister API endpoint
	 */
	const API_URL = 'https://www.hitmeister.de/api/v1/';

	/** @var GuzzleHttp\Client */
	private $client;

	/**
	 * @param string        $client Client key
	 * @param string        $clientSecret Client secret key
	 * @param callable|null $handler HTTP handler function to use with the stack. Mostly for testing purpose.
	 * @codeCoverageIgnore
	 */
	public function __construct($client, $clientSecret, callable $handler = null)
	{
		// Create default stack handler
		$stack = new GuzzleHttp\HandlerStack($handler ?: GuzzleHttp\choose_handler());
		$stack->push(GuzzleHttp\Middleware::prepareBody(), 'prepare_body');

		// Add custom middleware
		$stack->push(Middleware::httpErrors(), 'http_errors');
		$stack->push(Middleware::signRequest($client, $clientSecret), 'sign_request');

		$this->client = new GuzzleHttp\Client([
			// Client options
			'handler' => $stack,
			'base_uri' => static::API_URL,
			// Basic request options
			GuzzleHttp\RequestOptions::ALLOW_REDIRECTS => false,
			GuzzleHttp\RequestOptions::CONNECT_TIMEOUT => 30,
			GuzzleHttp\RequestOptions::TIMEOUT => 60,
			GuzzleHttp\RequestOptions::HEADERS => $this->getDefaultHeaders(),
		]);
	}

	/**
	 * @return array
	 * @codeCoverageIgnore
	 */
	protected function getDefaultHeaders()
	{
		return [
			'Accept' => 'application/json',
			'User-Agent' => 'HitmeisterSDK/' . static::VERSION . ' ' . GuzzleHttp\default_user_agent(),
		];
	}
}