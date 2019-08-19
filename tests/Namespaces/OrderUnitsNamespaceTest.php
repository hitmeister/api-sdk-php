<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Helper\Request;
use Hitmeister\Component\Api\Namespaces\OrderUnitsNamespace;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class OrderUnitsNamespaceTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class OrderUnitsNamespaceTest extends TransportAwareTestCase
{
	public function testFind()
	{
		$createdTime = time() - 100;
		$updatedTime = time() - 200;

		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				\Mockery::any(),
				\Mockery::any(),
				[
					'status' => 'received',
					'id_offer' => '401740',
					'ts_created:from' => date(Request::DATE_TIME_FORMAT, $createdTime),
					'ts_updated:from' => date(Request::DATE_TIME_FORMAT, $updatedTime),
					'sort' => 'ts_created:desc',
					'limit' => 30,
					'offset' => 0,
				],
				\Mockery::any(),
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Hm-Collection-Range' => ['1-30/1801'],
				],
				'json' => [
					[
						'id_order_unit' => 314567841434126,
						'status' => 'received',
					]
				]
			]);

		$namespace = new OrderUnitsNamespace($this->transport);
		$result = $namespace->find(['received'], '401740', $createdTime, $updatedTime);

		$this->assertInstanceOf('\Iterator', $result);
		$result = iterator_to_array($result);

		/** @var \Hitmeister\Component\Api\Transfers\OrderUnitTransfer[] $result */
		$this->assertEquals(1, count($result));
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\OrderUnitTransfer', $result[0]);
		$this->assertEquals(314567841434126, $result[0]->id_order_unit);
		$this->assertEquals('received', $result[0]->status);
	}

	public function testCancel()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'status' => 204,
		]);

		$namespace = new OrderUnitsNamespace($this->transport);
		$result = $namespace->cancel(10, 'no reason');
		$this->assertTrue($result);
	}

	public function testCancelNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new OrderUnitsNamespace($this->transport);
		$result = $namespace->cancel(10);
		$this->assertFalse($result);
	}

	public function testSend()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'status' => 204,
		]);

		$namespace = new OrderUnitsNamespace($this->transport);
		$result = $namespace->send(10, 'UPS', 'the_code');
		$this->assertTrue($result);
	}

	public function testCreateShipments()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'status' => 204,
		]);

		$namespace = new OrderUnitsNamespace($this->transport);
		$result = $namespace->createShipments(10, [
			[
				'carrier_code'=> 'DHL',
				'tracking_number' => '012345678'
			],
			[
				'carrier_code'=> 'DPD',
				'tracking_number' => '987654321'
			],
		]);
		$this->assertTrue($result);
	}

	public function testSendNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new OrderUnitsNamespace($this->transport);
		$result = $namespace->send(10);
		$this->assertFalse($result);
	}

	public function testGet()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'json' => [
				'id_order_unit' => 314567841520018,
			]
		]);

		$namespace = new OrderUnitsNamespace($this->transport);
		$result = $namespace->get(1);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\OrderUnitWithEmbeddedTransfer', $result);
		$this->assertEquals(314567841520018, $result->id_order_unit);
	}

	public function testGetNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new OrderUnitsNamespace($this->transport);
		$result = $namespace->get(10);
		$this->assertNull($result);
	}

	public function testRefund()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'status' => 204,
		]);

		$namespace = new OrderUnitsNamespace($this->transport);
		$result = $namespace->refund(10, 42, 'Something went wrong');
		$this->assertTrue($result);
	}

	public function testFulfil()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'status' => 204,
		]);

		$namespace = new OrderUnitsNamespace($this->transport);
		$result = $namespace->fulfil(10);
		$this->assertTrue($result);
	}

	public function testFulfilNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new OrderUnitsNamespace($this->transport);
		$result = $namespace->fulfil(10);
		$this->assertFalse($result);
	}

}