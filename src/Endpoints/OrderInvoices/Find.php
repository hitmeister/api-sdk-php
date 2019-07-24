<?php

namespace Hitmeister\Component\Api\Endpoints\OrderInvoices;

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
		return ['limit', 'offset'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function getURI()
	{
		return 'order-invoices/seller/';
	}
}
