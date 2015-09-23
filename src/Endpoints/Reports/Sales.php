<?php

namespace Hitmeister\Component\Api\Endpoints\Reports;

use Hitmeister\Component\Api\Endpoints\Traits\BodyTransfer;
use Hitmeister\Component\Api\Transfers\ReportRequestSalesTransfer;

/**
 * Class Sales
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Reports
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Sales extends Post
{
	use BodyTransfer;

	/**
	 * @param ReportRequestSalesTransfer $transfer
	 */
	public function setTransfer(ReportRequestSalesTransfer $transfer)
	{
		$this->transfer = $transfer;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getURI()
	{
		return 'reports/sales/';
	}
}