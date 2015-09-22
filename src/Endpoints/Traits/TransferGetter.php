<?php

namespace Hitmeister\Component\Api\Endpoints\Traits;

use Hitmeister\Component\Api\Transfers\AbstractTransfer;

/**
 * Class TransferGetter
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Traits
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
trait TransferGetter
{
	/** @var AbstractTransfer */
	protected $transfer;

	/**
	 * @return AbstractTransfer
	 */
	public function getTransfer()
	{
		return $this->transfer;
	}
}