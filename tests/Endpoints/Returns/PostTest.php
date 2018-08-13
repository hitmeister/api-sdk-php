<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Returns;

use Hitmeister\Component\Api\Endpoints\Returns\Post;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class PostTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\OrderUnitReturnTransfer $transfer */
		$transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\OrderUnitReturnTransfer');
		$transfer->shouldReceive('toArray')->once()->andReturn([
			'id_order_unit' => [
				1234567,
				1234568,
				1234569,
			],
			'reason' => 'defect',
			'note' => 'Note',
		]);

		$post = new Post($this->transport);
		$post->setTransfer($transfer);
		$this->assertInstanceOf(
			'\Hitmeister\Component\Api\Transfers\OrderUnitReturnTransfer',
			$post->getTransfer()
		);
		$this->assertEquals([], $post->getParamWhiteList());
		$this->assertEquals('POST', $post->getMethod());
		$this->assertEquals('returns/', $post->getURI());

		$body = $post->getBody();
		$this->assertArrayHasKey('id_order_unit', $body);
		$this->assertArrayHasKey('reason', $body);
		$this->assertArrayHasKey('note', $body);
	}
}
