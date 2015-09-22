<?php

namespace Hitmeister\Component\Api\Endpoints\Items;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;

/**
 * Class Find
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Items
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
		return ['q', 'ean', 'embedded', 'limit', 'offset'];
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
		return 'items/';
	}
}