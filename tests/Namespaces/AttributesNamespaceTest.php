<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Namespaces\AttributesNamespace;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class AttributesNamespaceTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class AttributesNamespaceTest extends TransportAwareTestCase
{
	public function testGet()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'json' => [
				'id_attribute' => 1,
				'name' => 'ean',
				'title' => 'EAN',
				'is_multiple_allowed' => true,
				'type' => 'Ean',
			]
		]);

		$namespace = new AttributesNamespace($this->transport);
		$result = $namespace->get(1);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\AttributeTransfer', $result);
		$this->assertEquals(1, $result->id_attribute);
		$this->assertEquals('ean', $result->name);
		$this->assertEquals('EAN', $result->title);
		$this->assertTrue($result->is_multiple_allowed);
		$this->assertEquals('Ean', $result->type);
	}

	public function testGetNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new AttributesNamespace($this->transport);
		$result = $namespace->get(10);
		$this->assertNull($result);
	}
}