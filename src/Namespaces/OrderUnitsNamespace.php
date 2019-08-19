<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Cursor;
use Hitmeister\Component\Api\Endpoints\OrderUnits\Cancel;
use Hitmeister\Component\Api\Endpoints\OrderUnits\CreateShipments;
use Hitmeister\Component\Api\Endpoints\OrderUnits\Find;
use Hitmeister\Component\Api\Endpoints\OrderUnits\Fulfil;
use Hitmeister\Component\Api\Endpoints\OrderUnits\Get;
use Hitmeister\Component\Api\Endpoints\OrderUnits\Refund;
use Hitmeister\Component\Api\Endpoints\OrderUnits\Send;
use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\FindBuilder;
use Hitmeister\Component\Api\Namespaces\Traits\PerformWithId;
use Hitmeister\Component\Api\Transfers\OrderUnitCancelTransfer;
use Hitmeister\Component\Api\Transfers\OrderUnitRefundTransfer;
use Hitmeister\Component\Api\Transfers\OrderUnitSendTransfer;
use Hitmeister\Component\Api\Transfers\OrderUnitShipmentTransfer;
use Hitmeister\Component\Api\Transfers\OrderUnitTransfer;
use Hitmeister\Component\Api\Transfers\OrderUnitWithEmbeddedTransfer;

/**
 * Class OrderUnitsNamespace
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class OrderUnitsNamespace extends AbstractNamespace
{
	use PerformWithId;

	/**
	 * @param string[]             $status
	 * @param string               $idOffer
	 * @param \DateTime|int|string $createdFrom
	 * @param \DateTime|int|string $updatedFrom
	 * @param string               $sort
	 * @param int                  $limit
	 * @param int                  $offset
	 * @return Cursor|OrderUnitTransfer[]
	 */
	public function find(
		$status = null,
		$idOffer = null,
		$createdFrom = null,
		$updatedFrom = null,
		$sort = 'ts_created:desc',
		$limit = 30,
		$offset = 0
	) {
		return $this->buildFind()
			->addParam('status', $status)
			->addParam('id_offer', $idOffer)
			->addDateTimeParam('ts_created:from', $createdFrom)
			->addDateTimeParam('ts_updated:from', $updatedFrom)
			->setSort($sort)
			->setLimit($limit)
			->setOffset($offset)
			->find();
	}

	/**
	 * @return FindBuilder
	 */
	public function buildFind()
	{
		$endpoint = new Find($this->getTransport());
		return new FindBuilder($endpoint, '\Hitmeister\Component\Api\Transfers\OrderUnitTransfer');
	}

	/**
	 * @param int   $id
	 * @param array $embedded
	 * @return OrderUnitWithEmbeddedTransfer|null
	 */
	public function get($id, array $embedded = [])
	{
		$endpoint = new Get($this->getTransport());

		// Ask for embedded fields
		if (!empty($embedded)) {
			$endpoint->setParams([
				'embedded' => $embedded,
			]);
		}

		$result = $this->performWithId($endpoint, $id);
		return $result ? OrderUnitWithEmbeddedTransfer::make($result) : null;
	}

	/**
	 * @param int         $id
	 * @param string|null $reason
	 * @return bool
	 */
	public function cancel($id, $reason = null)
	{
		$data = new OrderUnitCancelTransfer();
		if (null !== $reason) {
			$data->reason = $reason;
		}

		$endpoint = new Cancel($this->getTransport());
		$endpoint->setId($id);
		$endpoint->setTransfer($data);

		try {
			$result = $endpoint->performRequest();
		} catch (ResourceNotFoundException $e) {
			return false;
		}

		return $result['status'] == 204;
	}

	/**
	 * @param int         $id
	 * @param string|null $carrierCode
	 * @param string|null $trackingNumber
	 * @return bool
	 */
	public function send($id, $carrierCode = null, $trackingNumber = null)
	{
		$data = new OrderUnitSendTransfer();
		if (null !== $carrierCode) {
			$data->carrier_code = $carrierCode;
		}
		if (null !== $trackingNumber) {
			$data->tracking_number = $trackingNumber;
		}

		$endpoint = new Send($this->getTransport());
		$endpoint->setId($id);
		$endpoint->setTransfer($data);

		try {
			$result = $endpoint->performRequest();
		} catch (ResourceNotFoundException $e) {
			return false;
		}

		return $result['status'] == 204;
	}

	/**
	 * @param int $id
	 * @param array $shipments
	 * @return bool
	 */
	public function createShipments($id, array $shipments)
	{
		$data = new OrderUnitShipmentTransfer();
		$dataArr = [];
		foreach($shipments as $shipment) {
			$dataArr[] = [
				'carrier_code' => $shipment['carrier_code'],
				'tracking_number' => $shipment['tracking_number'],
			];
		}
		$data->fromArray($dataArr);

		$endpoint = new CreateShipments($this->getTransport());
		$endpoint->setId($id);
		$endpoint->setTransfer($data);

		try {
			$result = $endpoint->performRequest();
		} catch (ResourceNotFoundException $e) {
			return false;
		}

		return $result['status'] == 204;
	}

	/**
	 * @param int    $id
	 * @param int    $amount
	 * @param string $reason
	 *
	 * @return bool
	 */
	public function refund($id, $amount, $reason = null)
	{
		$data = new OrderUnitRefundTransfer();
		$data->amount = $amount;
		if (null !== $reason) {
			$data->reason = $reason;
		}

		$endpoint = new Refund($this->getTransport());
		$endpoint->setId($id);
		$endpoint->setTransfer($data);

		try {
			$result = $endpoint->performRequest();
		} catch (ResourceNotFoundException $e) {
			return false;
		}

		return $result['status'] == 204;
	}

	/**
	 * @param int $id
	 *
	 * @return bool
	 */
	public function fulfil($id)
	{
		$endpoint = new Fulfil($this->getTransport());
		$endpoint->setId($id);

		try {
			$result = $endpoint->performRequest();
		} catch (ResourceNotFoundException $e) {
			return false;
		}

		return $result['status'] == 204;
	}
}
