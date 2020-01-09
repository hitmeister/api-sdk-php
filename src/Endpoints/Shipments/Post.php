<?php

namespace Hitmeister\Component\Api\Endpoints\Shipments;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Traits\BodyTransfer;
use Hitmeister\Component\Api\Endpoints\Traits\EmptyParamWhiteList;
use Hitmeister\Component\Api\Endpoints\Traits\RequestPost;
use Hitmeister\Component\Api\Transfers\OrderUnitShipmentTransfer;

/**
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Shipments
 * @author   Darius Brückers <darius.brueckers@real-digital.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Post extends AbstractEndpoint
{
	use RequestPost;
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
	public function getURI()
	{
		return 'shipments/';
	}
}