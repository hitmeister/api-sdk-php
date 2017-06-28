<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\TicketMessages;

use Hitmeister\Component\Api\Endpoints\TicketMessages\Find;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class FindTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$find = new Find($this->transport);
		$this->assertEquals(['timestamp_from', 'limit', 'offset'], $find->getParamWhiteList());
		$this->assertEquals('GET', $find->getMethod());
		$this->assertEquals('ticket-messages/seller/', $find->getURI());
	}
}