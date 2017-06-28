<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\OrderUnits;

use Hitmeister\Component\Api\Endpoints\OrderUnits\Refund;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class RefundTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\OrderUnitRefundTransfer $transfer */
		$transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\OrderUnitRefundTransfer');
		$transfer->shouldReceive('toArray')->once()->andReturn(['amount' => 100500]);

		$send = new Refund($this->transport);
		$send->setId(1);
		$send->setTransfer($transfer);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\OrderUnitRefundTransfer', $send->getTransfer());
		$this->assertEquals([], $send->getParamWhiteList());
		$this->assertEquals('PATCH', $send->getMethod());
		$this->assertEquals('order-units/1/refund/', $send->getURI());

		$body = $send->getBody();
		$this->assertArrayHasKey('amount', $body);
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\RuntimeException
	 * @expectedExceptionMessage Required params id is not set
	 */
	public function testExceptionOnEmptyId()
	{
		$get = new Refund($this->transport);
		$get->getURI();
	}
}