<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Helper\Request;
use Hitmeister\Component\Api\Namespaces\TicketMessagesNamespace;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class TicketMessagesNamespaceTest extends TransportAwareTestCase
{
	public function testFind()
	{
		$now = time() - 86400;

		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				\Mockery::any(),
				\Mockery::any(),
				['timestamp_from' => date(Request::DATE_TIME_FORMAT, $now), 'limit' => 1, 'offset' => 10],
				\Mockery::any(),
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Hm-Collection-Range' => ['11-11/96'],
				],
				'json' => [
					[
						'id_ticket_message' => 15777563,
						'id_ticket' => 2939276,
					]
				]
			]);

		$namespace = new TicketMessagesNamespace($this->transport);
		$result = $namespace->find($now, 1, 10);

		$this->assertInstanceOf('\Iterator', $result);
		$result = iterator_to_array($result);

		/** @var \Hitmeister\Component\Api\Transfers\TicketMessageTransfer[] $result */
		$this->assertEquals(1, count($result));
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\TicketMessageTransfer', $result[0]);
		$this->assertEquals(2939276, $result[0]->id_ticket);
		$this->assertEquals(15777563, $result[0]->id_ticket_message);
	}

	public function testPost()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'headers' => [
				'Location' => ['/ticket-messages/15798348/'],
			],
		]);

		$namespace = new TicketMessagesNamespace($this->transport);
		$result = $namespace->post(2939276, 'message', true);
		$this->assertEquals(15798348, $result);
	}

	public function testGet()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'json' => [
				'id_ticket_message' => 15777563,
			]
		]);

		$namespace = new TicketMessagesNamespace($this->transport);
		$result = $namespace->get(1);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\TicketMessageTransfer', $result);
		$this->assertEquals(15777563, $result->id_ticket_message);
	}

	public function testGetNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new TicketMessagesNamespace($this->transport);
		$result = $namespace->get(10);
		$this->assertNull($result);
	}
}