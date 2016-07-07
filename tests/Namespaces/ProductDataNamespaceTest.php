<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Namespaces\ProductDataNamespace;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;
use Hitmeister\Component\Api\Transfers\ProductDataTransfer;

/**
 * Class ProductDataNamespaceTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Namespaces
 * @author   Julian Ecknig <julian.ecknig@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ProductDataNamespaceTest extends TransportAwareTestCase
{

	public function testGet()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'json' => [
				'ean' => ['1231231231232']
			]
		]);

		$namespace = new ProductDataNamespace($this->transport);
		$result = $namespace->get('1231231231232');
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ProductDataTransfer', $result);
		$this->assertEquals(['1231231231232'], $result->ean);
	}

	public function testGetNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new ProductDataNamespace($this->transport);
		$result = $namespace->get('1231231231232');
		$this->assertNull($result);
	}

	public function testUpsert()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				'PUT',
				'product-data/1231231231232/',
				[], // no params
				[
					'category' => ['alpin-skier']
				],
				\Mockery::any(),
			])
			->andReturn([
				'status' => 201,
			]);

		$namespace = new ProductDataNamespace($this->transport);
		$result = $namespace->upsert("1231231231232", ProductDataTransfer::make([
			'category' => ['alpin-skier'],
		]));
		$this->assertTrue($result);
	}

	public function testUpdateArrayParam()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				'PATCH',
				'product-data/1231231231232/',
				[], // no params
				[
					'category' => ['alpin-skier'],
				],
				\Mockery::any(),
			])
			->andReturn([
				'status' => 204,
			]);

		$namespace = new ProductDataNamespace($this->transport);
		$result = $namespace->update("1231231231232", ProductDataTransfer::make([
			'category' => ['alpin-skier']
		]));
		$this->assertTrue($result);
	}

	public function testUpdate()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				'PATCH',
				'product-data/1231231231232/',
				[], // no params
				[
					'category' => ['alpin-skier'],
				],
				\Mockery::any(),
			])
			->andReturn([
				'status' => 204,
			]);

		$namespace = new ProductDataNamespace($this->transport);
		$result = $namespace->update("1231231231232", ProductDataTransfer::make([
			'category' => ['alpin-skier'],
		]));
		$this->assertTrue($result);
	}

	public function testDelete()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'status' => 204,
		]);

		$namespace = new ProductDataNamespace($this->transport);
		$result = $namespace->delete("1231231231232");
		$this->assertTrue($result);
	}
}