<?php

namespace Hitmeister\Component\Api\Helper;

/**
 * Class Security
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Helper
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.real.de/api/v1/
 */
class Security
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
	 */
	public static function signRequest($clientSecret, $method, $url, $body, $timestamp)
	{
		$separator = "\n";
		// Build string that need to be signed [ METHOD, URL, BODY, UNIX_TIMESTAMP ]
		$string = implode($separator, [$method, $url, $body, $timestamp]);

		// Sign
		return hash_hmac('sha256', $string, $clientSecret);
	}
}
