<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Reports;

use Hitmeister\Component\Api\Endpoints\Reports\Sales;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class SalesTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\Reports
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class SalesTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\ReportRequestSalesTransfer $transfer */
		$transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\ReportRequestSalesTransfer');
		$transfer->shouldReceive('toArray')->once()->andReturn(['ts_from' => '2015-06-01 00:00:00', 'ts_to' => '2015-07-01 00:00:00']);

		$post = new Sales($this->transport);
		$post->setTransfer($transfer);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ReportRequestSalesTransfer', $post->getTransfer());
		$this->assertEquals([], $post->getParamWhiteList());
		$this->assertEquals('POST', $post->getMethod());
		$this->assertEquals('reports/sales/', $post->getURI());

		$body = $post->getBody();
		$this->assertArrayHasKey('ts_from', $body);
		$this->assertArrayHasKey('ts_to', $body);
	}
}