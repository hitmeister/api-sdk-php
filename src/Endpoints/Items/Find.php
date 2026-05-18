<?php

namespace Hitmeister\Component\Api\Endpoints\Items;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Interfaces\IdAware;
use Hitmeister\Component\Api\Endpoints\Traits\RequestGet;
use Hitmeister\Component\Api\Endpoints\Traits\UriPatternId;

/**
 * Class Find
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Items
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Find extends AbstractEndpoint implements IdAware
{
	use RequestGet, UriPatternId;

	/**
	 * {@inheritdoc}
	 */
	public function getParamWhiteList()
	{
		return ['storefront', 'q', 'embedded', 'limit', 'offset'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function getURIPattern()
	{
		return 'products/ean/%s';
	}
}