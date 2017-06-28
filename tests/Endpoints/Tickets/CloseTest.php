<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Tickets;

use Hitmeister\Component\Api\Endpoints\Tickets\Close;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class CloseTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$get = new Close($this->transport);
		$get->setId(10);
		$this->assertEquals(10, $get->getId());
		$this->assertEquals([], $get->getParamWhiteList());
		$this->assertEquals('PATCH', $get->getMethod());
		$this->assertEquals('tickets/10/close/', $get->getURI());
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\RuntimeException
	 * @expectedExceptionMessage Required params id is not set
	 */
	public function testExceptionOnEmptyId()
	{
		$get = new Close($this->transport);
		$get->getURI();
	}
}