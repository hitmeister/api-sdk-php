<?php

namespace Hitmeister\Component\Api\Endpoints\Tickets;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Traits\RequestGet;

class Find extends AbstractEndpoint
{
	use RequestGet;

	/**
	 * {@inheritdoc}
	 */
	public function getParamWhiteList()
	{
		return ['status', 'open_reason', 'topic', 'id_buyer', 'ts_created:from', 'ts_updated:from', 'sort', 'limit', 'offset'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function getURI()
	{
		return 'tickets/seller/';
	}
}