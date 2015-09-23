<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Helper\Request;
use Hitmeister\Component\Api\Namespaces\ReturnsNamespace;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class ReturnsNamespaceTest extends TransportAwareTestCase
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
					'status' => 'package_sent',
					'tracking_code' => '00340433836904994340',
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
					'Hm-Collection-Range' => ['1-30/98'],
				],
				'json' => [
					[
						'id_return' => 460258,
						'tracking_provider' => 'DHL'
					]
				]
			]);

		$namespace = new ReturnsNamespace($this->transport);
		$result = $namespace->find(['package_sent'], '00340433836904994340', $createdTime, $updatedTime);

		$this->assertInstanceOf('\Iterator', $result);
		$result = iterator_to_array($result);

		/** @var \Hitmeister\Component\Api\Transfers\ReturnTransfer[] $result */
		$this->assertEquals(1, count($result));
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ReturnTransfer', $result[0]);
		$this->assertEquals(460258, $result[0]->id_return);
		$this->assertEquals('DHL', $result[0]->tracking_provider);
	}

	public function testGetEmbedded()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'json' => [
				'id_return' => 179730,
				'buyer' => [
					'id_buyer' => 20979711,
				],
			]
		]);

		$namespace = new ReturnsNamespace($this->transport);
		$result = $namespace->get(179730, ['buyer']);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ReturnWithEmbeddedTransfer', $result);
		$this->assertEquals(179730, $result->id_return);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\BuyerTransfer', $result->buyer);
	}

	public function testGetNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new ReturnsNamespace($this->transport);
		$result = $namespace->get(10);
		$this->assertNull($result);
	}
}