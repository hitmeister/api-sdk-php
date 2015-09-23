<?php

namespace Hitmeister\Component\Api\Endpoints\Reports;

use Hitmeister\Component\Api\Endpoints\Traits\BodyTransfer;
use Hitmeister\Component\Api\Transfers\ReportProductDataImportFileErrorsTransfer;

/**
 * Class ProductDataImportErrors
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Reports
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ProductDataImportErrors extends Post
{
	use BodyTransfer;

	/**
	 * @param ReportProductDataImportFileErrorsTransfer $transfer
	 */
	public function setTransfer(ReportProductDataImportFileErrorsTransfer $transfer)
	{
		$this->transfer = $transfer;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getURI()
	{
		return 'reports/product-data-import-file-errors/';
	}
}