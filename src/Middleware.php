<?php

namespace Hitmeister\Component\Api;

use GuzzleHttp\Ring\Core;
use Hitmeister\Component\Api\Helper\Security;

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
	public static function signRequest(callable $handler, $clientKey, $clientSecret)
	{
		return function (array $request) use ($handler, $clientKey, $clientSecret) {
			$now = time();

			// Client and time stamp
			$request['headers']['HM-Client'] = $clientKey;
			$request['headers']['HM-Timestamp'] = $now;

			// Sign and add
			$signature =
				Security::signRequest($clientSecret, $request['http_method'], Core::url($request), $request['body'], $now);
			$request['headers']['HM-Signature'] = $signature;

			// Send the request using the handler and return the response.
			return $handler($request);
		};
	}
}