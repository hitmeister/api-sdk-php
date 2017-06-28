<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\TicketMessages;

use Hitmeister\Component\Api\Endpoints\TicketMessages\Post;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class PostTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\TicketMessageAddTransfer $transfer */
		$transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\TicketMessageAddTransfer');
		$transfer->shouldReceive('toArray')->once()->andReturn([
			'id_ticket'      => 2716841,
			'text'           => 'message',
			'interim_notice' => true,
		]);

		$post = new Post($this->transport);
		$post->setTransfer($transfer);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\TicketMessageAddTransfer', $post->getTransfer());
		$this->assertEquals([], $post->getParamWhiteList());
		$this->assertEquals('POST', $post->getMethod());
		$this->assertEquals('ticket-messages/', $post->getURI());

		$body = $post->getBody();
		$this->assertArrayHasKey('id_ticket', $body);
		$this->assertArrayHasKey('text', $body);
		$this->assertArrayHasKey('interim_notice', $body);
	}
}