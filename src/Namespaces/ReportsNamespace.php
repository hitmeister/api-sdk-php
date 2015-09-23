<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Cursor;
use Hitmeister\Component\Api\Endpoints\Reports\AccountListing;
use Hitmeister\Component\Api\Endpoints\Reports\Bookings;
use Hitmeister\Component\Api\Endpoints\Reports\Cancellations;
use Hitmeister\Component\Api\Endpoints\Reports\CompetitorsComparer;
use Hitmeister\Component\Api\Endpoints\Reports\Find;
use Hitmeister\Component\Api\Endpoints\Reports\Get;
use Hitmeister\Component\Api\Endpoints\Reports\ProductDataImportErrors;
use Hitmeister\Component\Api\Endpoints\Reports\Sales;
use Hitmeister\Component\Api\FindBuilder;
use Hitmeister\Component\Api\Helper\Request;
use Hitmeister\Component\Api\Helper\Response;
use Hitmeister\Component\Api\Namespaces\Traits\PerformWithId;
use Hitmeister\Component\Api\Transfers\ReportProductDataImportFileErrorsTransfer;
use Hitmeister\Component\Api\Transfers\ReportRequestBookingsTransfer;
use Hitmeister\Component\Api\Transfers\ReportRequestSalesTransfer;
use Hitmeister\Component\Api\Transfers\ReportTransfer;

/**
 * Class ReportsNamespace
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ReportsNamespace extends AbstractNamespace
{
	use PerformWithId;

	/**
	 * @param int    $limit
	 * @param int    $offset
	 * @param string $sort
	 * @return Cursor|ReportTransfer[]
	 */
	public function find($limit = 20, $offset = 0, $sort = 'id_report:asc')
	{
		return $this->buildFind()
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
		return new FindBuilder($endpoint, '\Hitmeister\Component\Api\Transfers\ReportTransfer');
	}

	/**
	 * @param int $id
	 * @return ReportTransfer|null
	 */
	public function get($id)
	{
		$endpoint = new Get($this->getTransport());
		$result = $this->performWithId($endpoint, $id);
		return $result ? ReportTransfer::make($result) : null;
	}

	/**
	 * @return int
	 */
	public function accountListing()
	{
		$endpoint = new AccountListing($this->getTransport());
		$resultRequest = $endpoint->performRequest();

		return Response::extractId($resultRequest, '/reports/%d/');
	}

	/**
	 * @return int
	 */
	public function cancellations()
	{
		$endpoint = new Cancellations($this->getTransport());
		$resultRequest = $endpoint->performRequest();

		return Response::extractId($resultRequest, '/reports/%d/');
	}

	/**
	 * @return int
	 */
	public function competitorsComparer()
	{
		$endpoint = new CompetitorsComparer($this->getTransport());
		$resultRequest = $endpoint->performRequest();

		return Response::extractId($resultRequest, '/reports/%d/');
	}

	/**
	 * @param \DateTime|int|string $dateFrom
	 * @param \DateTime|int|string $dateTo
	 * @return int
	 */
	public function bookings($dateFrom, $dateTo)
	{
		$data = new ReportRequestBookingsTransfer();
		$data->date_from = Request::formatDate($dateFrom);
		$data->date_to = Request::formatDate($dateTo);

		$endpoint = new Bookings($this->getTransport());
		$endpoint->setTransfer($data);

		$resultRequest = $endpoint->performRequest();

		return Response::extractId($resultRequest, '/reports/%d/');
	}

	/**
	 * @param int $importFileId
	 * @return int
	 */
	public function productDataImportErrors($importFileId)
	{
		$data = new ReportProductDataImportFileErrorsTransfer();
		$data->id_import_file = (int)$importFileId;

		$endpoint = new ProductDataImportErrors($this->getTransport());
		$endpoint->setTransfer($data);

		$resultRequest = $endpoint->performRequest();

		return Response::extractId($resultRequest, '/reports/%d/');
	}

	/**
	 * @param array                $statuses
	 * @param \DateTime|int|string $dateTimeFrom
	 * @param \DateTime|int|string $dateTimeTo
	 * @return int
	 * @throws \Hitmeister\Component\Api\Exceptions\ServerException
	 */
	public function sales(array $statuses, $dateTimeFrom, $dateTimeTo)
	{
		$data = new ReportRequestSalesTransfer();
		$data->status = $statuses;
		$data->ts_from = Request::formatDateTime($dateTimeFrom);
		$data->ts_to = Request::formatDateTime($dateTimeTo);

		$endpoint = new Sales($this->getTransport());
		$endpoint->setTransfer($data);

		$resultRequest = $endpoint->performRequest();

		return Response::extractId($resultRequest, '/reports/%d/');
	}
}