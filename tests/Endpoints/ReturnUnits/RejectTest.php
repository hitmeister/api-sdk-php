<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\ReturnUnits;

use Hitmeister\Component\Api\Endpoints\ReturnUnits\Reject;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class RejectTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\ReturnUnits
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class RejectTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\ReturnUnitRejectTransfer $transfer */
		$transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\ReturnUnitRejectTransfer');
		$transfer->shouldReceive('toArray')->once()->andReturn(['message' => 'some message']);

		$reject = new Reject($this->transport);
		$reject->setId(10);
		$reject->setTransfer($transfer);

		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ReturnUnitRejectTransfer', $reject->getTransfer());
		$this->assertEquals(10, $reject->getId());
		$this->assertEquals([], $reject->getParamWhiteList());
		$this->assertEquals('PATCH', $reject->getMethod());
		$this->assertEquals('return-units/10/reject/', $reject->getURI());

		$body = $reject->getBody();
		$this->assertArrayHasKey('message', $body);
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\RuntimeException
	 * @expectedExceptionMessage Required params id is not set
	 */
	public function testExceptionOnEmptyId()
	{
		$get = new Reject($this->transport);
		$get->getURI();
	}
}