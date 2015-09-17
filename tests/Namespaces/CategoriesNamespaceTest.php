<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Namespaces\CategoriesNamespace;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class CategoriesNamespaceTest extends TransportAwareTestCase
{
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