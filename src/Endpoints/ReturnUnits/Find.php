<?php

namespace Hitmeister\Component\Api\Endpoints\ReturnUnits;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Traits\RequestGet;

/**
 * Class Find
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\ReturnUnits
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Find extends AbstractEndpoint
{
	use RequestGet;

	/**
	 * {@inheritdoc}
	 */
	public function getParamWhiteList()
	{
		return ['ts_created:from', 'status', 'sort', 'limit', 'offset'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function getURI()
	{
		return 'return-units/seller/';
	}
}