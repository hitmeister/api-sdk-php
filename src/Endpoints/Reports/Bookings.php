<?php

namespace Hitmeister\Component\Api\Endpoints\Reports;

use Hitmeister\Component\Api\Endpoints\Traits\BodyTransfer;
use Hitmeister\Component\Api\Transfers\ReportRequestBookingsTransfer;

/**
 * Class Bookings
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Reports
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Bookings extends Post
{
	use BodyTransfer;

	/**
	 * @param ReportRequestBookingsTransfer $transfer
	 */
	public function setTransfer(ReportRequestBookingsTransfer $transfer)
	{
		$this->transfer = $transfer;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getURI()
	{
		return 'reports/bookings/';
	}
}