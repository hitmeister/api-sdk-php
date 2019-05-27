<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Tickets;

use Hitmeister\Component\Api\Endpoints\Tickets\Find;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class FindTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$find = new Find($this->transport);
		$this->assertEquals([
			'status', 'open_reason', 'topic', 'id_buyer', 'ts_created:from', 'ts_updated:from', 'sort', 'limit', 'offset',
		], $find->getParamWhiteList());
		$this->assertEquals('GET', $find->getMethod());
		$this->assertEquals('tickets/seller/', $find->getURI());
	}
}