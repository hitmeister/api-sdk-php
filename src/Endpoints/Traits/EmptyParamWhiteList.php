<?php

namespace Hitmeister\Component\Api\Endpoints\Traits;

/**
 * Class EmptyParamWhiteList
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Traits
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.real.de/api/v1/
 */
trait EmptyParamWhiteList
{
	/**
	 * @return array
	 */
	public function getParamWhiteList()
	{
		return [];
	}
}