<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Items;

use Hitmeister\Component\Api\Endpoints\Items\Find;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class FindTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$find = new Find($this->transport);
		$this->assertEquals(['q', 'ean', 'embedded', 'limit', 'offset'], $find->getParamWhiteList());
		$this->assertEquals('GET', $find->getMethod());
		$this->assertEquals('items/', $find->getURI());
	}
}