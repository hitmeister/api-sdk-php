<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Namespaces\CategoriesNamespace;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;
use Hitmeister\Component\Api\Transfers\CategoryDecideTransfer;

class CategoriesNamespaceTest extends TransportAwareTestCase
{
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