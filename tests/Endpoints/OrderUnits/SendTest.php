<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\OrderUnits;

use Hitmeister\Component\Api\Endpoints\OrderUnits\Send;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class SendTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\OrderUnits
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class SendTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\OrderUnitSendTransfer $transfer */
		$transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\OrderUnitSendTransfer');
		$transfer->shouldReceive('toArray')->once()->andReturn(['tracking_number' => 'TX123456']);

		$send = new Send($this->transport);
		$send->setId(1);
		$send->setTransfer($transfer);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\OrderUnitSendTransfer', $send->getTransfer());
		$this->assertEquals([], $send->getParamWhiteList());
		$this->assertEquals('PATCH', $send->getMethod());
		$this->assertEquals('order-units/1/send/', $send->getURI());

		$body = $send->getBody();
		$this->assertArrayHasKey('tracking_number', $body);
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\RuntimeException
	 * @expectedExceptionMessage Required params id is not set
	 */
	public function testExceptionOnEmptyId()
	{
		$get = new Send($this->transport);
		$get->getURI();
	}
}