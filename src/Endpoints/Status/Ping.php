<?php

namespace Hitmeister\Component\Api\Endpoints\Status;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Traits\EmptyParamWhiteList;
use Hitmeister\Component\Api\Endpoints\Traits\RequestGet;

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
	use RequestGet;
	use EmptyParamWhiteList;

	/**
	 * {@inheritdoc}
	 */
	public function getURI()
	{
		return 'status/ping/';
	}
}