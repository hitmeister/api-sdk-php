<?php

namespace Hitmeister\Component\Api\Endpoints\Traits;

/**
 * Class RequestPut
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Traits
 * @author   Julian Ecknig <julian.ecknig@hitmeister.de>
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