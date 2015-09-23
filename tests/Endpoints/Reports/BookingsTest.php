<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Reports;

use Hitmeister\Component\Api\Endpoints\Reports\Bookings;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class BookingsTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\Reports
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class BookingsTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\ReportRequestBookingsTransfer $transfer */
		$transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\ReportRequestBookingsTransfer');
		$transfer->shouldReceive('toArray')->once()->andReturn(['date_from' => '2015-06-01', 'date_to' => '2015-07-01']);

		$post = new Bookings($this->transport);
		$post->setTransfer($transfer);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ReportRequestBookingsTransfer', $post->getTransfer());
		$this->assertEquals([], $post->getParamWhiteList());
		$this->assertEquals('POST', $post->getMethod());
		$this->assertEquals('reports/bookings/', $post->getURI());

		$body = $post->getBody();
		$this->assertArrayHasKey('date_from', $body);
		$this->assertArrayHasKey('date_to', $body);
	}
}