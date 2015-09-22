<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\OrderUnits;

use Hitmeister\Component\Api\Endpoints\OrderUnits\Cancel;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class CancelTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\OrderUnits
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class CancelTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\OrderUnitCancelTransfer $transfer */
		$transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\OrderUnitCancelTransfer');
		$transfer->shouldReceive('toArray')->once()->andReturn(['reason' => 'wrong item']);

		$cancel = new Cancel($this->transport);
		$cancel->setId(1);
		$cancel->setTransfer($transfer);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\OrderUnitCancelTransfer', $cancel->getTransfer());
		$this->assertEquals([], $cancel->getParamWhiteList());
		$this->assertEquals('PATCH', $cancel->getMethod());
		$this->assertEquals('order-units/1/cancel/', $cancel->getURI());

		$body = $cancel->getBody();
		$this->assertArrayHasKey('reason', $body);
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\RuntimeException
	 * @expectedExceptionMessage Required params id is not set
	 */
	public function testExceptionOnEmptyId()
	{
		$get = new Cancel($this->transport);
		$get->getURI();
	}
}