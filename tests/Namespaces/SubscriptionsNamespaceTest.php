<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Namespaces\SubscriptionsNamespace;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class SubscriptionsNamespaceTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class SubscriptionsNamespaceTest extends TransportAwareTestCase
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
					'event_name' => 'order_new',
					'limit' => 30,
					'offset' => 0,
				],
				\Mockery::any(),
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Hm-Collection-Range' => ['1-30/31'],
				],
				'json' => [
					[
						'id_subscription' => 45454,
						'event_name' => 'order_new'
					]
				]
			]);

		$namespace = new SubscriptionsNamespace($this->transport);
		$result = $namespace->find('order_new');

		$this->assertInstanceOf('\Iterator', $result);
		$result = iterator_to_array($result);

		/** @var \Hitmeister\Component\Api\Transfers\SubscriptionTransfer[] $result */
		$this->assertEquals(1, count($result));
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\SubscriptionTransfer', $result[0]);
		$this->assertEquals(45454, $result[0]->id_subscription);
		$this->assertEquals('order_new', $result[0]->event_name);
	}

	public function testGet()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'json' => [
				'id_subscription' => 45454,
			]
		]);

		$namespace = new SubscriptionsNamespace($this->transport);
		$result = $namespace->get(45454);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\SubscriptionTransfer', $result);
		$this->assertEquals(45454, $result->id_subscription);
	}

	public function testGetNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new SubscriptionsNamespace($this->transport);
		$result = $namespace->get(10);
		$this->assertNull($result);
	}

	public function testPost()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				'POST',
				'subscriptions/',
				[], // no params
				[
					'event_name' => 'order_new',
					'callback_url' => 'http://localhost/',
					'fallback_email' => 'root@localhost',
				],
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Location' => ['/subscriptions/123456/'],
				],
			]);

		$namespace = new SubscriptionsNamespace($this->transport);
		$result = $namespace->post('order_new', 'http://localhost/', 'root@localhost');
		$this->assertEquals(123456, $result);
	}

	public function testDelete()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'status' => 204,
		]);

		$namespace = new SubscriptionsNamespace($this->transport);
		$result = $namespace->delete(10);
		$this->assertTrue($result);
	}

	public function testDeleteNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new SubscriptionsNamespace($this->transport);
		$result = $namespace->delete(10);
		$this->assertFalse($result);
	}

	public function testUpdate()
	{
		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				'PATCH',
				'subscriptions/10/',
				[], // no params
				[
					'event_name' => 'order_unit_new',
					'callback_url' => 'http://localhost/v2',
					'fallback_email' => 'root@localhost.com',
					'is_active' => false,
				],
				\Mockery::any(),
			])
			->andReturn([
				'status' => 204,
			]);

		$namespace = new SubscriptionsNamespace($this->transport);
		$result = $namespace->update(10, 'order_unit_new', 'http://localhost/v2', 'root@localhost.com', false);
		$this->assertTrue($result);
	}

	public function testUpdateNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new SubscriptionsNamespace($this->transport);
		$result = $namespace->update(10, 'order_unit_new', 'http://localhost/v2', 'root@localhost.com', false);
		$this->assertFalse($result);
	}
}