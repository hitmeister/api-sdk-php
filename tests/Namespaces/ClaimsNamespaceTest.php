<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Helper\Request;
use Hitmeister\Component\Api\Namespaces\ClaimsNamespace;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class ClaimsNamespaceTest extends TransportAwareTestCase
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
					'status' => 'buyer_closed,seller_closed',
					'open_reason' => 'product_defect',
					'id_buyer' => 10,
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
					'Hm-Collection-Range' => ['1-30/41'],
				],
				'json' => [
					[
						'id_claim' => 2939276,
						'status' => 'buyer_closed',
					]
				]
			]);

		$namespace = new ClaimsNamespace($this->transport);
		$result = $namespace->find(['buyer_closed','seller_closed'], ['product_defect'], 10, $createdTime, $updatedTime);

		$this->assertInstanceOf('\Iterator', $result);
		$result = iterator_to_array($result);

		/** @var \Hitmeister\Component\Api\Transfers\ClaimTransfer[] $result */
		$this->assertEquals(1, count($result));
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ClaimTransfer', $result[0]);
		$this->assertEquals(2939276, $result[0]->id_claim);
		$this->assertEquals('buyer_closed', $result[0]->status);
	}

	public function testGetEmbedded()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'json' => [
				'id_claim' => 15777563,
				'messages' => [
					['id_claim' => 15777563,]
				],
			]
		]);

		$namespace = new ClaimsNamespace($this->transport);
		$result = $namespace->get(1, ['messages']);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ClaimWithEmbeddedTransfer', $result);
		$this->assertEquals(15777563, $result->id_claim);
		$this->assertTrue(is_array($result->messages));
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ClaimMessageTransfer', $result->messages[0]);
	}

	public function testGetNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new ClaimsNamespace($this->transport);
		$result = $namespace->get(10);
		$this->assertNull($result);
	}

	public function testClose()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'status' => 204,
		]);

		$namespace = new ClaimsNamespace($this->transport);
		$result = $namespace->close(10);
		$this->assertTrue($result);
	}

	public function testCloseNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new ClaimsNamespace($this->transport);
		$result = $namespace->close(10);
		$this->assertFalse($result);
	}
}
