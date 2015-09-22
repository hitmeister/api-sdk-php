<?php

namespace Hitmeister\Component\Api\Endpoints\Claims;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;

/**
 * Class Find
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Claims
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Find extends AbstractEndpoint
{
	/**
	 * {@inheritdoc}
	 */
	public function getParamWhiteList()
	{
		return ['status', 'open_reason', 'id_buyer', 'ts_created:from', 'ts_updated:from', 'sort', 'limit', 'offset'];
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
		return 'claims/seller/';
	}
}