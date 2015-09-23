<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Reports;

use Hitmeister\Component\Api\Endpoints\Reports\Cancellations;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class CancellationsTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$post = new Cancellations($this->transport);
		$this->assertEquals([], $post->getParamWhiteList());
		$this->assertEquals('POST', $post->getMethod());
		$this->assertEquals('reports/cancellations/', $post->getURI());
	}
}