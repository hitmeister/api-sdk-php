<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Reports;

use Hitmeister\Component\Api\Endpoints\Reports\BookingsNew;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class BookingsNewTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\ReportRequestBookingsNewTransfer $transfer */
		$transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\ReportRequestBookingsNewTransfer');
		$transfer->shouldReceive('toArray')->once()->andReturn(['date_from' => '2015-06-01', 'date_to' => '2015-07-01']);

		$post = new BookingsNew($this->transport);
		$post->setTransfer($transfer);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ReportRequestBookingsNewTransfer', $post->getTransfer());
		$this->assertEquals([], $post->getParamWhiteList());
		$this->assertEquals('POST', $post->getMethod());
		$this->assertEquals('reports/bookings-new/', $post->getURI());

		$body = $post->getBody();
		$this->assertArrayHasKey('date_from', $body);
		$this->assertArrayHasKey('date_to', $body);
	}
}