<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Helper\Request;
use Hitmeister\Component\Api\Namespaces\ShippingGroupsNamespace;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class ShippingGroupsNamespaceTest extends TransportAwareTestCase
{
	public function testFind()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				'GET',
				'shipping-groups/seller/',
				\Mockery::any(),
				\Mockery::any(),
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Hm-Collection-Range' => ['11-11/96'],
				],
				'json'    => [
					[
						'name' => "Hello World",
					]
				]
			]);

		$namespace = new ShippingGroupsNamespace($this->transport);
		$result = $namespace->find();

		$this->assertInstanceOf('\Iterator', $result);
		$result = iterator_to_array($result);

		/** @var \Hitmeister\Component\Api\Transfers\ShippingGroupTransfer[] $result */
		$this->assertEquals(1, count($result));
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ShippingGroupTransfer', $result[0]);
		$this->assertEquals('Hello World', $result[0]->name);
	}
}