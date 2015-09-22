<?php

namespace Hitmeister\Component\Api\Endpoints\Traits;

/**
 * Class RequestDelete
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Traits
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
trait RequestDelete
{
	/**
	 * @return string
	 */
	public function getMethod()
	{
		return 'DELETE';
	}
}