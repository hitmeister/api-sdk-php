<?php
/**
 * Created for Hitmeister Project.
 * User: Maksim Naumov <maksim.naumov@hitmeister.de>
 * Date: 09/09/15
 * Time: 12:05
 */

namespace Hitmeister\Component\Api;

use Hitmeister\Component\Api\Exception\BadResponse;
use Hitmeister\Component\Api\Exception\NotFound;
use Hitmeister\Component\Api\Exception\ServerError;
use Psr\Http\Message\ResponseInterface;

final class Middleware
{
	/**
	 * @return \Closure
	 */
	public static function httpErrors()
	{
		return function (callable $handler) {
			return function ($request, array $options) use ($handler) {
				return $handler($request, $options)->then(
					function (ResponseInterface $response) use ($request, $handler) {
						$code = $response->getStatusCode();
						if ($code < 400) {
							return $response;
						}
						// Special case for not found status code
						if (404 === $code) {
							throw new NotFound('Not Found', $request, $response);
						}
						throw $code > 499
							? new ServerError("Server error: $code", $request, $response)
							: new BadResponse("Client error: $code", $request, $response);
					}
				);
			};
		};
	}

	/**
	 * Creates sign request middleware
	 *
	 * @param string $client Client key
	 * @param string $clientSecret Client secret key
	 * @return \Closure
	 */
	public static function signRequest($client, $clientSecret)
	{
		return function (callable $handler) use ($client, $clientSecret) {
			return new Middleware\SignRequest($handler, $client, $clientSecret);
		};
	}
}