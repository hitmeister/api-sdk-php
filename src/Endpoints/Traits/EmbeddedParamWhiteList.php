<?php

namespace Hitmeister\Component\Api\Endpoints\Traits;

/**
 * Class EmbeddedParamWhiteList
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Traits
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
trait EmbeddedParamWhiteList
{
	/**
	 * @return array
	 */
	public function getParamWhiteList()
	{
		return ['embedded'];
	}
}