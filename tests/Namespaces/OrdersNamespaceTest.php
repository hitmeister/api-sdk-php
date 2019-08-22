<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Helper\Request;
use Hitmeister\Component\Api\Namespaces\OrdersNamespace;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class OrdersNamespaceTest extends TransportAwareTestCase
{
	public function testFind()
	{
		$createdTime = time() - 100;
		$updatedTime = time() - 50;
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				\Mockery::any(),
				\Mockery::any(),
				[
					'ts_created:from' => date(Request::DATE_TIME_FORMAT, $createdTime),
					'ts_units_updated:from' => date(Request::DATE_TIME_FORMAT, $updatedTime),
					'limit' => 30,
					'offset' => 0,
				],
				\Mockery::any(),
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Hm-Collection-Range' => ['1-30/123'],
				],
				'json' => [
					[
						'id_order' => 'MT19L51',
						'seller_units_count' => 123,
					]
				]
			]);

		$namespace = new OrdersNamespace($this->transport);
		$result = $namespace->find($createdTime, $updatedTime);

		$this->assertInstanceOf('\Iterator', $result);
		$result = iterator_to_array($result);

		/** @var \Hitmeister\Component\Api\Transfers\OrderSellerTransfer[] $result */
		$this->assertEquals(1, count($result));
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\OrderSellerTransfer', $result[0]);
		$this->assertEquals('MT19L51', $result[0]->id_order);
		$this->assertEquals(123, $result[0]->seller_units_count);
	}

	public function testGetEmbedded()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'json' => [
				'id_order' => 'MT19L51',
				'buyer' => [
					'id_buyer' => 21031741,
				],
			]
		]);

		$namespace = new OrdersNamespace($this->transport);
		$result = $namespace->get(1, ['buyer']);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\OrderWithEmbeddedTransfer', $result);
		$this->assertEquals('MT19L51', $result->id_order);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\BuyerTransfer', $result->buyer);
	}

	public function testGetNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new OrdersNamespace($this->transport);
		$result = $namespace->get(10);
		$this->assertNull($result);
	}

	public function testGetEmbeddedOrderInvoices()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'json' => [
				'id_order' => 'MT19L51',
				'order_invoices' => [
					[
						'id_invoice' => 1,
						'id_order' => 'MT19L51',
						'ts_created' => '2019-06-07 12:11:10',
					],
				],
			]
		]);

		$namespace = new OrdersNamespace($this->transport);
		$result = $namespace->get(1, ['order_invoices']);

		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\OrderWithEmbeddedTransfer', $result);
		$this->assertEquals('MT19L51', $result->id_order);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\OrderInvoiceTransfer', $result->order_invoices[0]);
	}
}