<?php

namespace Hitmeister\Component\Api\Endpoints\Reports;

use Hitmeister\Component\Api\Endpoints\Traits\BodyTransfer;
use Hitmeister\Component\Api\Transfers\ReportRequestSalesNewTransfer;

class SalesNew extends Post
{
	use BodyTransfer;

	/**
	 * @param ReportRequestSalesNewTransfer $transfer
	 */
	public function setTransfer(ReportRequestSalesNewTransfer $transfer)
	{
		$this->transfer = $transfer;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getURI()
	{
		return 'reports/sales-new/';
	}
}