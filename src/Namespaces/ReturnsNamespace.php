<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Cursor;
use Hitmeister\Component\Api\Endpoints\Returns\Find;
use Hitmeister\Component\Api\Endpoints\Returns\Get;
use Hitmeister\Component\Api\Endpoints\Returns\Post;
use Hitmeister\Component\Api\FindBuilder;
use Hitmeister\Component\Api\Helper\Response;
use Hitmeister\Component\Api\Namespaces\Traits\PerformWithId;
use Hitmeister\Component\Api\Transfers\OrderUnitReturnTransfer;
use Hitmeister\Component\Api\Transfers\ReturnTransfer;
use Hitmeister\Component\Api\Transfers\ReturnWithEmbeddedTransfer;

/**
 * Class ReturnsNamespace
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ReturnsNamespace extends AbstractNamespace
{
	use PerformWithId;

	/**
	 * @param string[]             $status
	 * @param string               $trackingCode
	 * @param \DateTime|int|string $createdFrom
	 * @param \DateTime|int|string $updatedFrom
	 * @param string               $sort
	 * @param int                  $limit
	 * @param int                  $offset
	 * @return Cursor|ReturnTransfer[]
	 */
	public function find(
		$status = null,
		$trackingCode = null,
		$createdFrom = null,
		$updatedFrom = null,
		$sort = 'ts_created:desc',
		$limit = 30,
		$offset = 0
	) {
		return $this->buildFind()
			->addParam('status', $status)
			->addParam('tracking_code', $trackingCode)
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
		return new FindBuilder($endpoint, '\Hitmeister\Component\Api\Transfers\ReturnTransfer');
	}

	/**
	 * @param int   $id
	 * @param array $embedded
	 * @return ReturnWithEmbeddedTransfer|null
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
		return $result ? ReturnWithEmbeddedTransfer::make($result) : null;
	}

	/**
	 * @param integer[] $orderUnitIds
	 * @param string $reason
	 * @param string $note
	 * @throws \Hitmeister\Component\Api\Exceptions\ServerException
	 * @return array
	 */
	public function post(array $orderUnitIds, string $reason, string $note)
	{
		$data = new OrderUnitReturnTransfer();
		$data->id_order_unit = $orderUnitIds;
		$data->reason = $reason;
		$data->note = $note;

		$endpoint = new Post($this->getTransport());
		$endpoint->setTransfer($data);
		$resultRequest = $endpoint->performRequest();

		Response::checkBody($resultRequest);
		return $resultRequest['json'];
	}
}