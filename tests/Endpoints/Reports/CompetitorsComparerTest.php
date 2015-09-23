<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Reports;

use Hitmeister\Component\Api\Endpoints\Reports\CompetitorsComparer;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class CompetitorsComparerTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$post = new CompetitorsComparer($this->transport);
		$this->assertEquals([], $post->getParamWhiteList());
		$this->assertEquals('POST', $post->getMethod());
		$this->assertEquals('reports/competitors-comparer/', $post->getURI());
	}
}