<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Cursor;
use Hitmeister\Component\Api\Endpoints\Claims\Close;
use Hitmeister\Component\Api\Endpoints\Claims\Find;
use Hitmeister\Component\Api\Endpoints\Claims\Get;
use Hitmeister\Component\Api\Endpoints\Claims\Post;
use Hitmeister\Component\Api\Endpoints\Claims\Refund;
use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\FindBuilder;
use Hitmeister\Component\Api\Helper\Response;
use Hitmeister\Component\Api\Namespaces\Traits\PerformWithId;
use Hitmeister\Component\Api\Transfers\ClaimAddTransfer;
use Hitmeister\Component\Api\Transfers\ClaimRefundTransfer;
use Hitmeister\Component\Api\Transfers\ClaimTransfer;
use Hitmeister\Component\Api\Transfers\ClaimWithEmbeddedTransfer;

/**
 * Class ClaimsNamespace
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ClaimsNamespace extends AbstractNamespace
{
	use PerformWithId;

	/**
	 * @param int    $orderUnitId
	 * @param string $text
	 * @return int
	 */
	public function post($orderUnitId, $text)
	{
		$data = new ClaimAddTransfer();
		$data->id_order_unit = (int)$orderUnitId;
		$data->text = $text;

		$endpoint = new Post($this->getTransport());
		$endpoint->setTransfer($data);

		$resultRequest = $endpoint->performRequest();

		return Response::extractId($resultRequest, '/claims/%d/');
	}

	/**
	 * @param string[]             $status
	 * @param string[]             $openReason
	 * @param int                  $buyerId
	 * @param \DateTime|int|string $createdFrom
	 * @param \DateTime|int|string $updatedFrom
	 * @param string               $sort
	 * @param int                  $limit
	 * @param int                  $offset
	 * @return Cursor|ClaimTransfer[]
	 */
	public function find(
		$status = null,
		$openReason = null,
		$buyerId = null,
		$createdFrom = null,
		$updatedFrom = null,
		$sort = 'ts_created:desc',
		$limit = 30,
		$offset = 0
	) {
		return $this->buildFind()
			->addParam('status', $status)
			->addParam('open_reason', $openReason)
			->addParam('id_buyer', (int)$buyerId)
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
		return new FindBuilder($endpoint, '\Hitmeister\Component\Api\Transfers\ClaimTransfer');
	}

	/**
	 * @param int   $id
	 * @param array $embedded
	 * @return ClaimWithEmbeddedTransfer|null
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
		return $result ? ClaimWithEmbeddedTransfer::make($result) : null;
	}

	/**
	 * @param int $id
	 * @return bool
	 */
	public function close($id)
	{
		$endpoint = new Close($this->getTransport());
		$endpoint->setId($id);

		try {
			$result = $endpoint->performRequest();
		} catch (ResourceNotFoundException $e) {
			return false;
		}

		return $result['status'] == 204;
	}

	/**
	 * @param int $id
	 * @param int $amount
	 * @return bool
	 */
	public function refund($id, $amount)
	{
		$data = new ClaimRefundTransfer();
		$data->amount = (int)$amount;

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
}