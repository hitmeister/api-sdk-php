<?php
/**
 * Created for Hitmeister Project.
 * User: Maksim Naumov <maksim.naumov@hitmeister.de>
 * Date: 09/09/15
 * Time: 11:53
 */

namespace Hitmeister\Component\Api\Helper;

class Request
{
	/**
	 * Makes signature
	 *
	 * @param string $clientSecret Client secret key
	 * @param string $method Request method
	 * @param string $url Request url
	 * @param string $body Request body
	 * @param int    $timestamp Current timestamp
	 * @return string
	 * @codeCoverageIgnore
	 */
	public static function sign($clientSecret, $method, $url, $body, $timestamp)
	{
		// Build string that need to be signed [ METHOD, URL, BODY, UNIX_TIMESTAMP ]
		$string = implode(PHP_EOL, [$method, $url, $body, $timestamp]);

		// Sign
		return hash_hmac('sha256', $string, $clientSecret);
	}
}
