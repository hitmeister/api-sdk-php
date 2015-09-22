<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Claims;

use Hitmeister\Component\Api\Endpoints\Claims\Refund;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class RefundTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\Claims
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class RefundTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\ClaimRefundTransfer $transfer */
		$transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\ClaimRefundTransfer');
		$transfer->shouldReceive('toArray')->once()->andReturn(['amount' => 10000]);

		$refund = new Refund($this->transport);
		$refund->setTransfer($transfer);
		$refund->setId(10);
		$this->assertEquals(10, $refund->getId());
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ClaimRefundTransfer', $refund->getTransfer());
		$this->assertEquals([], $refund->getParamWhiteList());
		$this->assertEquals('PATCH', $refund->getMethod());
		$this->assertEquals('claims/10/refund/', $refund->getURI());
		$this->assertArrayHasKey('amount', $refund->getBody());
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\RuntimeException
	 * @expectedExceptionMessage Required params id is not set
	 */
	public function testExceptionOnEmptyId()
	{
		$get = new Refund($this->transport);
		$get->getURI();
	}
}