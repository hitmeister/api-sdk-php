<?php

namespace Hitmeister\Component\Api\Endpoints\OrderUnits;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Interfaces\IdAware;
use Hitmeister\Component\Api\Endpoints\Traits\BodyTransfer;
use Hitmeister\Component\Api\Endpoints\Traits\EmptyParamWhiteList;
use Hitmeister\Component\Api\Endpoints\Traits\RequestPatch;
use Hitmeister\Component\Api\Endpoints\Traits\UriPatternId;
use Hitmeister\Component\Api\Transfers\OrderUnitShipmentTransfer;

/**
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\OrderUnits
 * @author   Darius Brückers <darius.brueckers@real-digital.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class CreateShipments extends AbstractEndpoint implements IdAware
{
	use RequestPatch;
	use UriPatternId;
	use EmptyParamWhiteList;
	use BodyTransfer;

	/**
	 * @param OrderUnitShipmentTransfer $transfer
	 */
	public function setTransfer(OrderUnitShipmentTransfer $transfer)
	{
		$this->transfer = $transfer;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getUriPattern()
	{
		return 'order-units/%d/shipments/';
	}
}