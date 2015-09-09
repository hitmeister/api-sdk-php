<?php
/**
 * Created for Hitmeister Project.
 * User: Maksim Naumov <maksim.naumov@hitmeister.de>
 * Date: 09/09/15
 * Time: 12:05
 */

namespace Hitmeister\Component\Api;

final class Middleware
{
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