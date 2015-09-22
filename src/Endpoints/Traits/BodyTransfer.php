<?php

namespace Hitmeister\Component\Api\Endpoints\Traits;

/**
 * Class BodyTransfer
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Traits
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
trait BodyTransfer
{
	use TransferGetter;

	/**
	 * @return array
	 */
	public function getBody()
	{
		return $this->transfer->toArray();
	}
}