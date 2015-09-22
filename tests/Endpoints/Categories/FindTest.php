<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Categories;

use Hitmeister\Component\Api\Endpoints\Categories\Find;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class FindTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$find = new Find($this->transport);
		$this->assertEquals(['q', 'id_parent', 'limit', 'offset'], $find->getParamWhiteList());
		$this->assertEquals('GET', $find->getMethod());
		$this->assertEquals('categories/', $find->getURI());
	}
}