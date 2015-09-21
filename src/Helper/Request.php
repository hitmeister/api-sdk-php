<?php

namespace Hitmeister\Component\Api\Helper;

/**
 * Class Request
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Helper
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Request
{
	const DATE_TIME_FORMAT = 'Y-m-d H:i:s';
	const DATE_FORMAT = 'Y-m-d';

	/**
	 * @param \DateTime|int|string|null $date
	 * @return string|null
	 */
	public static function formatDate($date)
	{
		return static::dateFormat($date, Request::DATE_FORMAT);
	}

	/**
	 * @param \DateTime|int|string|null $dateTime
	 * @return string|null
	 */
	public static function formatDateTime($dateTime)
	{
		return static::dateFormat($dateTime, Request::DATE_TIME_FORMAT);
	}

	/**
	 * @param \DateTime|int|string|null$date
	 * @param string $format
	 * @return null|string
	 */
	private static function dateFormat($date, $format)
	{
		if (null === $date) {
			return null;
		}

		if ($date instanceof \DateTime) {
			$date = $date->format($format);
		} elseif (is_int($date)) {
			$date = date($format, $date);
		} else {
			$date = (string)$date;
		}

		return $date;
	}
}