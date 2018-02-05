<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Namespaces\ItemsNamespace;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class ItemsNamespaceTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ItemsNamespaceTest extends TransportAwareTestCase
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
					'q' => 'iphone',
					'embedded' => 'units',
					'limit' => 30,
					'offset' => 0,
				],
				\Mockery::any(),
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Hm-Collection-Range' => ['1-30/37233'],
				],
				'json' => [
					[
						'id_item' => 301583769,
						'eans' => ['0888462062947'],
						'units' => [
							['id_unit' => 335734641002]
						],
					]
				]
			]);

		$namespace = new ItemsNamespace($this->transport);
		$result = $namespace->find('iphone', ['units']);

		$this->assertInstanceOf('\Iterator', $result);
		$result = iterator_to_array($result);

		/** @var \Hitmeister\Component\Api\Transfers\ItemWithEmbeddedTransfer[] $result */
		$this->assertEquals(1, count($result));
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ItemWithEmbeddedTransfer', $result[0]);
		$this->assertEquals(301583769, $result[0]->id_item);
		$this->assertTrue(is_array($result[0]->eans));
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
					'embedded' => 'units',
					'limit' => 30,
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
						'id_item' => 301583769,
						'eans' => ['0888462062947'],
						'units' => [
							['id_unit' => 335734641002]
						],
					]
				]
			]);

		$namespace = new ItemsNamespace($this->transport);
		$result = $namespace->findByEan('0888462062947', ['units']);

		/** @var \Hitmeister\Component\Api\Transfers\ItemWithEmbeddedTransfer $result */
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ItemWithEmbeddedTransfer', $result);
		$this->assertEquals(301583769, $result->id_item);
		$this->assertInternalType('array', $result->eans);
	}

	public function testGetEmbedded()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'json' => [
				'id_item' => 301583769,
				'units' => [
					['id_unit' => 335734641002,]
				],
			]
		]);

		$namespace = new ItemsNamespace($this->transport);
		$result = $namespace->get(1, ['units']);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ItemWithEmbeddedTransfer', $result);
		$this->assertEquals(301583769, $result->id_item);
		$this->assertTrue(is_array($result->units));
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\UnitTransfer', $result->units[0]);
	}

	public function testGetNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new ItemsNamespace($this->transport);
		$result = $namespace->get(10);
		$this->assertNull($result);
	}
}