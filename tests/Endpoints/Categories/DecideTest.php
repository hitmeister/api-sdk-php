<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Categories;

use Hitmeister\Component\Api\Endpoints\Categories\Decide;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class DecideTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\CategoryDecideTransfer $transfer */
		$transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\CategoryDecideTransfer');
		$transfer->shouldReceive('toArray')->once()->andReturn(['item' => 'value']);

		$decide = new Decide($this->transport);
		$decide->setTransfer($transfer);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\CategoryDecideTransfer', $decide->getTransfer());
		$this->assertEquals([], $decide->getParamWhiteList());
		$this->assertEquals('POST', $decide->getMethod());
		$this->assertEquals('categories/decide/', $decide->getURI());
		$this->assertArrayHasKey('item', $decide->getBody());
	}
}