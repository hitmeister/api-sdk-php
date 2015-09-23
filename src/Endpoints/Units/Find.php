<?php

namespace Hitmeister\Component\Api\Endpoints\Units;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Traits\RequestGet;

/**
 * Class Find
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Units
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
		return ['id_offer', 'id_item', 'ean', 'embedded', 'limit', 'offset'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function getURI()
	{
		return 'units/seller/';
	}
}