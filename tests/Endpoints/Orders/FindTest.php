<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Orders;

use Hitmeister\Component\Api\Endpoints\Orders\Find;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class FindTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$find = new Find($this->transport);
		$this->assertEquals(['ts_created:from', 'ts_units_updated:from', 'limit', 'offset'], $find->getParamWhiteList());
		$this->assertEquals('GET', $find->getMethod());
		$this->assertEquals('orders/seller/', $find->getURI());
	}
}