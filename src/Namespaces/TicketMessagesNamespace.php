<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Cursor;
use Hitmeister\Component\Api\Endpoints\TicketMessages\Find;
use Hitmeister\Component\Api\Endpoints\TicketMessages\Get;
use Hitmeister\Component\Api\Endpoints\TicketMessages\Post;
use Hitmeister\Component\Api\FindBuilder;
use Hitmeister\Component\Api\Helper\Response;
use Hitmeister\Component\Api\Namespaces\Traits\PerformWithId;
use Hitmeister\Component\Api\Transfers\MessageClaimFileTransfer;
use Hitmeister\Component\Api\Transfers\TicketMessageAddTransfer;
use Hitmeister\Component\Api\Transfers\TicketMessageTransfer;

class TicketMessagesNamespace extends AbstractNamespace
{
	use PerformWithId;

	/**
	 * @param int    $ticketId
	 * @param string $text
	 * @param bool   $interimNotice
     * @param MessageClaimFileTransfer[] $claimMessageFiles

     *
	 * @return int
	 */
	public function post($ticketId, $text, $interimNotice = false, $claimMessageFiles = [])
	{
		$data = new TicketMessageAddTransfer();
		$data->id_ticket = (int)$ticketId;
		$data->text = $text;
		$data->interim_notice = $interimNotice;
		$data->claim_message_files = $claimMessageFiles;

		$endpoint = new Post($this->getTransport());
		$endpoint->setTransfer($data);

		$resultRequest = $endpoint->performRequest();

		return Response::extractId($resultRequest, '/ticket-messages/%d/');
	}

	/**
	 * @param \DateTime|int|string $dateTimeFrom
	 * @param int                  $limit
	 * @param int                  $offset
	 *
	 * @return Cursor|TicketMessageTransfer[]
	 */
	public function find($dateTimeFrom = null, $limit = 30, $offset = 0)
	{
		return $this->buildFind()
			->addDateTimeParam('timestamp_from', $dateTimeFrom)
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

		return new FindBuilder($endpoint, '\Hitmeister\Component\Api\Transfers\TicketMessageTransfer');
	}

	/**
	 * @param int $id
	 *
	 * @return TicketMessageTransfer|null
	 */
	public function get($id)
	{
		$endpoint = new Get($this->getTransport());
		$result = $this->performWithId($endpoint, $id);

		return $result ? TicketMessageTransfer::make($result) : null;
	}
}