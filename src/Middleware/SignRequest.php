<?php
/**
 * Created for Hitmeister Project.
 * User: Maksim Naumov <maksim.naumov@hitmeister.de>
 * Date: 09/09/15
 * Time: 11:53
 */

namespace Hitmeister\Component\Api\Middleware;

use GuzzleHttp\Promise\PromiseInterface;
use Hitmeister\Component\Api;
use Psr\Http\Message\RequestInterface;

class SignRequest
{
	/**
	 * Header with the value of your `Client Key`.
	 */
	const HEADER_CLIENT = 'HM-Client';

	/**
	 * Header which contains an HMAC signature of the request
	 */
	const HEADER_SIGNATURE = 'HM-Signature';

	/**
	 * Header with the current Unix Timestamp in seconds and must be current at the time the request is made.
	 */
	const HEADER_TIMESTAMP = 'HM-Timestamp';

	/**
	 * Next handler to invoke.
	 *
	 * @var callable
	 */
	private $nextHandler;

	/**
	 * Client key
	 *
	 * @var string
	 */
	private $client;

	/**
	 * Client secret key
	 *
	 * @var string
	 */
	private $clientSecret;

	/**
	 * @param callable $nextHandler Next handler to invoke.
	 * @param string   $client Client key
	 * @param string   $clientSecret Client secret key
	 */
	public function __construct(callable $nextHandler, $client, $clientSecret)
	{
		$this->nextHandler = $nextHandler;
		$this->client = $client;
		$this->clientSecret = $clientSecret;
	}

	/**
	 * @param RequestInterface $request Current request
	 * @param array            $options Request options
	 * @return PromiseInterface
	 */
	public function __invoke(RequestInterface $request, array $options)
	{
		$now = time();

		// Sign
		$signature = Api\Helper\Request::sign($this->clientSecret, $request->getMethod(), (string)$request->getUri(),
			$request->getBody()->getContents(), $now);

		// Add header to request
		$newRequest = $request
			->withHeader(static::HEADER_CLIENT, $this->client)
			->withHeader(static::HEADER_SIGNATURE, $signature)
			->withHeader(static::HEADER_TIMESTAMP, $now);

		// Invoke next middleware
		$fn = $this->nextHandler;
		return $fn($newRequest, $options);
	}

	/**
	 * @return string
	 */
	public function getClient()
	{
		return $this->client;
	}

	/**
	 * @return string
	 */
	public function getClientSecret()
	{
		return $this->clientSecret;
	}
}