<?php

namespace Hitmeister\Component\Api\Endpoints\OrderUnits;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Interfaces\IdAware;
use Hitmeister\Component\Api\Endpoints\Traits\BodyTransfer;
use Hitmeister\Component\Api\Endpoints\Traits\EmptyParamWhiteList;
use Hitmeister\Component\Api\Endpoints\Traits\RequestPatch;
use Hitmeister\Component\Api\Endpoints\Traits\UriPatternId;
use Hitmeister\Component\Api\Transfers\OrderUnitCancelTransfer;

/**
 * Class Cancel
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\OrderUnits
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Cancel extends AbstractEndpoint implements IdAware
{
	use RequestPatch;
	use UriPatternId;
	use EmptyParamWhiteList;
	use BodyTransfer;

	/**
	 * @param OrderUnitCancelTransfer $transfer
	 */
	public function setTransfer(OrderUnitCancelTransfer $transfer)
	{
		$this->transfer = $transfer;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getUriPattern()
	{
		return 'order-units/%d/cancel/';
	}
}