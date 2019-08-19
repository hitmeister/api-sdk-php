<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Endpoints\Shipments\Post;
use Hitmeister\Component\Api\Exceptions\ServerException;
use Hitmeister\Component\Api\Helper\Response;
use Hitmeister\Component\Api\Transfers\OrderUnitShipmentTransfer;
use Hitmeister\Component\Api\Transfers\ShipmentInformationTransfer;

/**
 * Class ShipmentsNamespace
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Namespaces
 * @author   Darius Brückers <darius.brueckers@real-digital.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ShipmentsNamespace extends AbstractNamespace
{
	/**
	 * @param string $orderUnitId
	 * @param string $carrierCode
	 * @param string $trackingNumber
	 * @return int
	 * @throws ServerException
	 */
	public function post($orderUnitId, $carrierCode, $trackingNumber)
	{
		$data = new OrderUnitShipmentTransfer();
		$data->id_order_unit = $orderUnitId;
		$shipmentInformation = new ShipmentInformationTransfer();
		$shipmentInformation->carrier_code = $carrierCode;
		$shipmentInformation->tracking_number = $trackingNumber;

		$endpoint = new Post($this->getTransport());
		$endpoint->setTransfer($data);
		$resultRequest = $endpoint->performRequest();

		return Response::extractId($resultRequest, '/shipments/%d/');
	}
}