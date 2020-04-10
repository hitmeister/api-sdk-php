<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Namespaces\UnitsNamespace;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;
use Hitmeister\Component\Api\Transfers\UnitAddTransfer;
use Hitmeister\Component\Api\Transfers\UnitUpdateTransfer;

/**
 * Class UnitsNamespaceTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class UnitsNamespaceTest extends TransportAwareTestCase
{
	public function testFindByIdItem()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				\Mockery::any(),
				\Mockery::any(),
				[
					'id_item' => 216221301,
					'id_offer' => '136',
					'embedded' => 'item',
					'limit' => 30,
					'offset' => 0,
				],
				\Mockery::any(),
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Hm-Collection-Range' => ['1-2/2'],
				],
				'json' => [
					[
						'id_unit' => 350822415008,
						'id_item' => 216221301,
						'condition' => 'new'
					]
				]
			]);

		$namespace = new UnitsNamespace($this->transport);
		$result = $namespace->findByIdItem(216221301, '136', ['item']);

		$this->assertInstanceOf('\Iterator', $result);
		$result = iterator_to_array($result);

		/** @var \Hitmeister\Component\Api\Transfers\UnitSellerTransfer[] $result */
		$this->assertEquals(1, count($result));
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\UnitSellerTransfer', $result[0]);
		$this->assertEquals(350822415008, $result[0]->id_unit);
		$this->assertEquals(216221301, $result[0]->id_item);
		$this->assertEquals('new', $result[0]->condition);
	}

	public function testFindByEan()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				\Mockery::any(),
				\Mockery::any(),
				[
					'ean' => '0888462062947',
					'id_offer' => '136',
					'embedded' => 'item',
					'limit' => 30,
					'offset' => 0,
				],
				\Mockery::any(),
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Hm-Collection-Range' => ['1-2/2'],
				],
				'json' => [
					[
						'id_unit' => 350822415008,
						'condition' => 'new'
					]
				]
			]);

		$namespace = new UnitsNamespace($this->transport);
		$result = $namespace->findByEan('0888462062947', '136', ['item']);

		$this->assertInstanceOf('\Iterator', $result);
		$result = iterator_to_array($result);

		/** @var \Hitmeister\Component\Api\Transfers\UnitSellerTransfer[] $result */
		$this->assertEquals(1, count($result));
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\UnitSellerTransfer', $result[0]);
		$this->assertEquals(350822415008, $result[0]->id_unit);
		$this->assertEquals('new', $result[0]->condition);
    }
    
    public function testFind()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				\Mockery::any(),
				\Mockery::any(),
				[
					'id_offer' => '136',
					'embedded' => 'item',
					'limit' => 30,
					'offset' => 0,
				],
				\Mockery::any(),
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Hm-Collection-Range' => ['1-2/2'],
				],
				'json' => [
					[
						'id_unit' => 350822415008,
						'condition' => 'new'
					]
				]
			]);

		$namespace = new UnitsNamespace($this->transport);
		$result = $namespace->find('136', ['item']);

		$this->assertInstanceOf('\Iterator', $result);
		$result = iterator_to_array($result);

		/** @var \Hitmeister\Component\Api\Transfers\UnitSellerTransfer[] $result */
		$this->assertEquals(1, count($result));
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\UnitSellerTransfer', $result[0]);
		$this->assertEquals(350822415008, $result[0]->id_unit);
		$this->assertEquals('new', $result[0]->condition);
	}

	public function testGetEmbedded()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'json' => [
				'id_unit' => 45454,
				'item' => [
					'id_item' => 216221301
				],
			]
		]);

		$namespace = new UnitsNamespace($this->transport);
		$result = $namespace->get(45454, ['item']);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\UnitWithEmbeddedTransfer', $result);
		$this->assertEquals(45454, $result->id_unit);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ItemTransfer', $result->item);
	}

	public function testGetNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new UnitsNamespace($this->transport);
		$result = $namespace->get(10);
		$this->assertNull($result);
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\InvalidArgumentException
	 */
	public function testPostInvalidParam()
	{
		$namespace = new UnitsNamespace($this->transport);
		$namespace->post('hello');
	}

	public function testPostArrayParam()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				'POST',
				'units/',
				[], // no params
				[
					'id_item' => 216221301,
					'id_offer' => 'Supa offer'
				],
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Location' => ['/units/123456/'],
				],
			]);

		$namespace = new UnitsNamespace($this->transport);
		$result = $namespace->post([
			'id_item' => 216221301,
			'id_offer' => 'Supa offer'
		]);

		$this->assertEquals(123456, $result);
	}

	public function testPost()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				'POST',
				'units/',
				[], // no params
				[
					'id_item' => 216221301,
					'id_offer' => 'Supa offer'
				],
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Location' => ['/units/123456/'],
				],
			]);

		$namespace = new UnitsNamespace($this->transport);
		$result = $namespace->post(UnitAddTransfer::make([
			'id_item' => 216221301,
			'id_offer' => 'Supa offer'
		]));

		$this->assertEquals(123456, $result);
	}

	public function testDelete()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'status' => 204,
		]);

		$namespace = new UnitsNamespace($this->transport);
		$result = $namespace->delete(10);
		$this->assertTrue($result);
	}

	public function testDeleteNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new UnitsNamespace($this->transport);
		$result = $namespace->delete(10);
		$this->assertFalse($result);
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\InvalidArgumentException
	 */
	public function testUpdateInvalidParam()
	{
		$namespace = new UnitsNamespace($this->transport);
		$namespace->update(10, 'hello');
	}

	public function testUpdateArrayParam()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				'PATCH',
				'units/10/',
				[], // no params
				[
					'condition' => 'new',
				],
				\Mockery::any(),
			])
			->andReturn([
				'status' => 204,
			]);

		$namespace = new UnitsNamespace($this->transport);
		$result = $namespace->update(10, [
			'condition' => 'new',
		]);
		$this->assertTrue($result);
	}

	public function testUpdate()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				'PATCH',
				'units/10/',
				[], // no params
				[
					'condition' => 'new',
				],
				\Mockery::any(),
			])
			->andReturn([
				'status' => 204,
			]);

		$namespace = new UnitsNamespace($this->transport);
		$result = $namespace->update(10, UnitUpdateTransfer::make([
			'condition' => 'new',
		]));
		$this->assertTrue($result);
	}

	public function testUpdateNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new UnitsNamespace($this->transport);
		$result = $namespace->update(10, [
			'condition' => 'new',
		]);
		$this->assertFalse($result);
	}
}