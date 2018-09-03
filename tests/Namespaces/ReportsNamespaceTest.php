<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Helper\Request;
use Hitmeister\Component\Api\Namespaces\ReportsNamespace;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class ReportsNamespaceTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ReportsNamespaceTest extends TransportAwareTestCase
{
	public function testFind()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				\Mockery::any(),
				\Mockery::any(),
				[
					'sort' => 'id_report:asc',
					'limit' => 20,
					'offset' => 0,
				],
				\Mockery::any(),
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Hm-Collection-Range' => ['1-1/1'],
				],
				'json' => [
					[
						'id_report' => 460258,
						'date_requested' => '2015-09-22'
					]
				]
			]);

		$namespace = new ReportsNamespace($this->transport);
		$result = $namespace->find();

		$this->assertInstanceOf('\Iterator', $result);
		$result = iterator_to_array($result);

		/** @var \Hitmeister\Component\Api\Transfers\ReportTransfer[] $result */
		$this->assertEquals(1, count($result));
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ReportTransfer', $result[0]);
		$this->assertEquals(460258, $result[0]->id_report);
		$this->assertEquals('2015-09-22', $result[0]->date_requested);
	}

	public function testGet()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'json' => [
				'id_report' => 460258,
				'date_requested' => '2015-09-22'
			]
		]);

		$namespace = new ReportsNamespace($this->transport);
		$result = $namespace->get(460258);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ReportTransfer', $result);
		$this->assertEquals(460258, $result->id_report);
		$this->assertEquals('2015-09-22', $result->date_requested);
	}

	public function testGetNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new ReportsNamespace($this->transport);
		$result = $namespace->get(1);
		$this->assertNull($result);
	}

	public function testAccountListing()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				'POST',
				'reports/account-listing/',
				[], // no params
				null, // no body
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Location' => ['/reports/123456/'],
				],
			]);

		$namespace = new ReportsNamespace($this->transport);
		$result = $namespace->accountListing();
		$this->assertEquals(123456, $result);
	}

	public function testCancellations()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				'POST',
				'reports/cancellations/',
				[], // no params
				null, // no body
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Location' => ['/reports/123456/'],
				],
			]);

		$namespace = new ReportsNamespace($this->transport);
		$result = $namespace->cancellations();
		$this->assertEquals(123456, $result);
	}

	public function testCompetitorsComparer()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				'POST',
				'reports/competitors-comparer/',
				[], // no params
				null, // no body
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Location' => ['/reports/123456/'],
				],
			]);

		$namespace = new ReportsNamespace($this->transport);
		$result = $namespace->competitorsComparer();
		$this->assertEquals(123456, $result);
	}

	public function testBookings()
	{
		$from = time() - 100;
		$to = $from + 200;

		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				'POST',
				'reports/bookings/',
				[], // no params
				[
					'date_from' => Request::formatDate($from),
					'date_to' => Request::formatDate($to),
				],
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Location' => ['/reports/123456/'],
				],
			]);

		$namespace = new ReportsNamespace($this->transport);
		$result = $namespace->bookings($from, $to);
		$this->assertEquals(123456, $result);
	}

	public function testSales()
	{
		$from = time() - 100;
		$to = $from + 200;

		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				'POST',
				'reports/sales/',
				[], // no params
				[
					'status' => ['received'],
					'ts_from' => Request::formatDateTime($from),
					'ts_to' => Request::formatDateTime($to),
				],
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Location' => ['/reports/123456/'],
				],
			]);

		$namespace = new ReportsNamespace($this->transport);
		$result = $namespace->sales(['received'], $from, $to);
		$this->assertEquals(123456, $result);
	}

	public function testProductDataImportErrors()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				'POST',
				'reports/product-data-import-file-errors/',
				[], // no params
				[
					'id_import_file' => 10,
				],
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Location' => ['/reports/123456/'],
				],
			]);

		$namespace = new ReportsNamespace($this->transport);
		$result = $namespace->productDataImportErrors(10);
		$this->assertEquals(123456, $result);
	}

	public function testProductDataChanges()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				'POST',
				'reports/product-data-changes/',
				[], // no params
				null, // no body
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Location' => ['/reports/42/'],
				],
			]);

		$namespace = new ReportsNamespace($this->transport);
		$result = $namespace->productDataChanges();
		$this->assertEquals(42, $result);
	}

	public function testEansNotFound()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				'POST',
				'reports/eans-not-found/',
				[], // no params
				null, // no body
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Location' => ['/reports/42/'],
				],
			]);

		$namespace = new ReportsNamespace($this->transport);
		$result = $namespace->eansNotFound();
		$this->assertEquals(42, $result);
	}
}