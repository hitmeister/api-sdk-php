<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Namespaces\CategoriesNamespace;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;
use Hitmeister\Component\Api\Transfers\CategoryDecideTransfer;

/**
 * Class CategoriesNamespaceTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class CategoriesNamespaceTest extends TransportAwareTestCase
{
	public function testFind()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				\Mockery::any(),
				\Mockery::any(),
				['q' => 'handy', 'id_parent' => 38441, 'limit' => 1, 'offset' => 2],
				\Mockery::any(),
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Hm-Collection-Range' => ['3-3/10'],
				],
				'json' => [
					[
						'id_category' => 30511,
						'id_parent_category' => 38441,
						'name' => 'schutzfolien-handys'
					]
				]
			]);

		$namespace = new CategoriesNamespace($this->transport);
		$result = $namespace->find('handy', 38441, 1, 2);

		$this->assertInstanceOf('\Iterator', $result);
		$result = iterator_to_array($result);

		/** @var \Hitmeister\Component\Api\Transfers\CategoryTransfer[] $result */
		$this->assertEquals(1, count($result));
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\CategoryTransfer', $result[0]);
		$this->assertEquals(30511, $result[0]->id_category);
		$this->assertEquals(38441, $result[0]->id_parent_category);
		$this->assertEquals('schutzfolien-handys', $result[0]->name);
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\InvalidArgumentException
	 */
	public function testDecideInvalidParam()
	{
		$namespace = new CategoriesNamespace($this->transport);
		$namespace->decide('hello');
	}

	public function testDecideArrayParam()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'json' => []
		]);

		$namespace = new CategoriesNamespace($this->transport);
		$result = $namespace->decide([
			'item' => [
				'title' => 'iphone',
				'description' => 'iphone 5'
			],
			'price' => 500000,
		]);

		$this->assertTrue(is_array($result));
	}

	public function testDecide()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'json' => [
				[
					'id_category' => 12,
					'name' => 'Category Name'
				]
			]
		]);

		$namespace = new CategoriesNamespace($this->transport);
		$result = $namespace->decide(CategoryDecideTransfer::make([
			'item' => [
				'title' => 'iphone',
				'description' => 'iphone 5'
			],
			'price' => 500000,
		]));

		$this->assertTrue(is_array($result));
		$this->assertEquals(1, count($result));
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\CategoryTransfer', $result[0]);
	}

	public function testGetEmbedded()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'json' => [
				'id_category' => 1,
				'name' => 'root',
				'optional_attributes' => [
					[
						'id_attribute' => 41,
						'name' => 'description',
					]
				],
			]
		]);

		$namespace = new CategoriesNamespace($this->transport);
		$result = $namespace->get(1, ['optional_attributes']);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\CategoryWithEmbeddedTransfer', $result);
		$this->assertTrue(is_array($result->optional_attributes));
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\AttributeTransfer', $result->optional_attributes[0]);
	}

	public function testGetNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new CategoriesNamespace($this->transport);
		$result = $namespace->get(10);
		$this->assertNull($result);
	}
}