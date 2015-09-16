<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Status;

use Hitmeister\Component\Api\Endpoints\Status\Ping;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class PingTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$ping = new Ping($this->transport);
		$this->assertEquals([], $ping->getParamWhiteList());
		$this->assertEquals('GET', $ping->getMethod());
		$this->assertEquals('status/ping/', $ping->getURI());
	}
}