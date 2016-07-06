<?php

namespace Hitmeister\Component\Api\Endpoints\Traits;

/**
 * Class RequestPatch
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Traits
 * @author   Alex Litvinenko <alex.litvinenko@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
trait RequestPut
{
	/**
	 * @return string
	 */
	public function getMethod()
	{
		return 'PUT';
	}
}