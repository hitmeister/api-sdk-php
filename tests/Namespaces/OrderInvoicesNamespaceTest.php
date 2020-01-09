<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Namespaces\OrderInvoicesNamespace;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;
use Hitmeister\Component\Api\Transfers\OrderInvoiceTransfer;

class OrderInvoicesNamespaceTest extends TransportAwareTestCase
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
					'limit' => 5,
					'offset' => 10,
				],
				\Mockery::any(),
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Hm-Collection-Range' => ['10-15/20'],
				],
				'json' => [
					[
						'id_invoice' => 1,
						'id_order' => 'MX12AB',
						'ts_created' => 123123123,
					],
					[
						'id_invoice' => 2,
						'id_order' => 'MX12AC',
						'ts_created' => 123123124,
					]
				]
			]);

		$namespace = new OrderInvoicesNamespace($this->transport);
		/** @var OrderInvoiceTransfer[] $result */
		$result = iterator_to_array($namespace->find(5, 10));

		$this->assertCount(2, $result);
		$this->assertSame(1, $result[0]->id_invoice);
		$this->assertSame('MX12AB', $result[0]->id_order);
		$this->assertSame(123123123, $result[0]->ts_created);
		$this->assertSame(2, $result[1]->id_invoice);
		$this->assertSame('MX12AC', $result[1]->id_order);
		$this->assertSame(123123124, $result[1]->ts_created);
	}

	public function testGet()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				'GET',
				'order-invoices/1/',
				[],
				[],
				\Mockery::any(),
			])
			->andReturn([
				'json' => [
					'id_invoice' => 1,
					'id_order' => 'MX12AB',
					'original_name' => 'invoice123.pdf',
					'mime_type' => 'application/pdf',
					'url' => 'some_url',
					'ts_created' => 123123123,
				]
			]);

		$namespace = new OrderInvoicesNamespace($this->transport);
		$result = $namespace->get(1);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\OrderInvoiceTransfer', $result);
		$this->assertSame(1, $result->id_invoice);
		$this->assertSame('MX12AB', $result->id_order);
		$this->assertSame('invoice123.pdf', $result->original_name);
		$this->assertSame('some_url', $result->url);
		$this->assertSame('application/pdf', $result->mime_type);
		$this->assertSame(123123123, $result->ts_created);
	}

	public function testGetNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new OrderInvoicesNamespace($this->transport);
		$result = $namespace->get(10);
		$this->assertNull($result);
	}

	public function testPost()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				'POST',
				'order-invoices/',
				[],
				[
					'id_order' => 'MX12FS',
					'original_name' => 'invoice123.pdf',
                    'mime_type' => 'application/pdf',
                    'data' => 'real.digital'
				],
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Location' => ['/order-invoices/1/'],
				],
			]);

		$namespace = new OrderInvoicesNamespace($this->transport);
		$result = $namespace->post('MX12FS', 'invoice123.pdf', 'application/pdf', 'real.digital');
		$this->assertSame(1, $result);
	}

	public function testDelete()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'status' => 204,
		]);

		$namespace = new OrderInvoicesNamespace($this->transport);
		$result = $namespace->delete(10);
		$this->assertTrue($result);
	}

	public function testDeleteNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new OrderInvoicesNamespace($this->transport);
		$result = $namespace->delete(10);
		$this->assertFalse($result);
	}
}
