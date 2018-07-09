<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Reports;

use Hitmeister\Component\Api\Endpoints\Reports\SalesNew;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class SalesNewTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\ReportRequestSalesNewTransfer $transfer */
		$transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\ReportRequestSalesNewTransfer');
		$transfer->shouldReceive('toArray')->once()->andReturn(['ts_from' => '2015-06-01 00:00:00', 'ts_to' => '2015-07-01 00:00:00']);

		$post = new SalesNew($this->transport);
		$post->setTransfer($transfer);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ReportRequestSalesNewTransfer', $post->getTransfer());
		$this->assertEquals([], $post->getParamWhiteList());
		$this->assertEquals('POST', $post->getMethod());
		$this->assertEquals('reports/sales-new/', $post->getURI());

		$body = $post->getBody();
		$this->assertArrayHasKey('ts_from', $body);
		$this->assertArrayHasKey('ts_to', $body);
	}
}