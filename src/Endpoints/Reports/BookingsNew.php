<?php

namespace Hitmeister\Component\Api\Endpoints\Reports;

use Hitmeister\Component\Api\Endpoints\Traits\BodyTransfer;
use Hitmeister\Component\Api\Transfers\ReportRequestBookingsNewTransfer;

class BookingsNew extends Post
{
	use BodyTransfer;

	/**
	 * @param ReportRequestBookingsNewTransfer $transfer
	 */
	public function setTransfer(ReportRequestBookingsNewTransfer $transfer)
	{
		$this->transfer = $transfer;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getURI()
	{
		return 'reports/bookings-new/';
	}
}