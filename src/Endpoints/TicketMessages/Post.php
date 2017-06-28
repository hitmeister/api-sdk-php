<?php

namespace Hitmeister\Component\Api\Endpoints\TicketMessages;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Traits\BodyTransfer;
use Hitmeister\Component\Api\Endpoints\Traits\EmptyParamWhiteList;
use Hitmeister\Component\Api\Endpoints\Traits\RequestPost;
use Hitmeister\Component\Api\Transfers\TicketMessageAddTransfer;

class Post extends AbstractEndpoint
{
	use RequestPost;
	use EmptyParamWhiteList;
	use BodyTransfer;

	/**
	 * @param TicketMessageAddTransfer $transfer
	 */
	public function setTransfer(TicketMessageAddTransfer $transfer)
	{
		$this->transfer = $transfer;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getURI()
	{
		return 'ticket-messages/';
	}
}