<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Cursor;
use Hitmeister\Component\Api\Endpoints\Tickets\Close;
use Hitmeister\Component\Api\Endpoints\Tickets\Find;
use Hitmeister\Component\Api\Endpoints\Tickets\Get;
use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\FindBuilder;
use Hitmeister\Component\Api\Namespaces\Traits\PerformWithId;
use Hitmeister\Component\Api\Transfers\TicketTransfer;
use Hitmeister\Component\Api\Transfers\TicketWithEmbeddedTransfer;

class TicketsNamespace extends AbstractNamespace
{
	use PerformWithId;

	/**
	 * @param string[]             $status
	 * @param string[]             $openReason
	 * @param int                  $buyerId
	 * @param \DateTime|int|string $createdFrom
	 * @param \DateTime|int|string $updatedFrom
	 * @param string               $sort
	 * @param int                  $limit
	 * @param int                  $offset
	 *
	 * @return Cursor|TicketTransfer[]
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
	)
	{
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

		return new FindBuilder($endpoint, '\Hitmeister\Component\Api\Transfers\TicketTransfer');
	}

	/**
	 * @param int   $id
	 * @param array $embedded
	 *
	 * @return TicketWithEmbeddedTransfer|null
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

		return $result ? TicketWithEmbeddedTransfer::make($result) : null;
	}

	/**
	 * @param int $id
	 *
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
}