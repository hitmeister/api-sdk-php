<?php

namespace Hitmeister\Component\Api\Endpoints\Status;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;

/**
 * Class Ping
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Status
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Ping extends AbstractEndpoint
{
	/**
	 * {@inheritdoc}
	 */
	public function getParamWhiteList()
	{
		return [];
	}

	/**
	 * {@inheritdoc}
	 */
	public function getMethod()
	{
		return 'GET';
	}

	/**
	 * {@inheritdoc}
	 */
	public function getURI()
	{
		return 'status/ping/';
	}
}