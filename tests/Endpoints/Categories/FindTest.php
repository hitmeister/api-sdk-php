<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Categories;

use Hitmeister\Component\Api\Endpoints\Categories\Find;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class FindTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$get = new Find($this->transport);
		$this->assertEquals(['q', 'id_parent', 'limit', 'offset'], $get->getParamWhiteList());
		$this->assertEquals('GET', $get->getMethod());
		$this->assertEquals('categories/', $get->getURI());
	}
}