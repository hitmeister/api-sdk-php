<?php

namespace Hitmeister\Component\Api\Helper;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Exceptions\ServerException;

/**
 * Class Response
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Helper
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Response
{
	/**
	 * @param array            $data
	 * @param AbstractEndpoint $endpoint
	 * @throws ServerException
	 */
	public static function checkBody(array &$data, AbstractEndpoint $endpoint)
	{
		if (!isset($data['json'])) {
			throw new ServerException(sprintf('Unexpected server response on %s %s, body is empty.',
				$endpoint->getMethod(), $endpoint->getURI()));
		}
	}
}