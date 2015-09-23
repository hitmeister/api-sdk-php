<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Units;

use Hitmeister\Component\Api\Endpoints\Units\Update;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class UpdateTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\Units
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class UpdateTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\UnitUpdateTransfer $transfer */
		$transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\UnitUpdateTransfer');
		$transfer->shouldReceive('toArray')->once()->andReturn(['condition' => 'new']);

		$update = new Update($this->transport);
		$update->setId(10);
		$update->setTransfer($transfer);

		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\UnitUpdateTransfer', $update->getTransfer());
		$this->assertEquals(10, $update->getId());
		$this->assertEquals([], $update->getParamWhiteList());
		$this->assertEquals('PATCH', $update->getMethod());
		$this->assertEquals('units/10/', $update->getURI());

		$body = $update->getBody();
		$this->assertArrayHasKey('condition', $body);
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\RuntimeException
	 * @expectedExceptionMessage Required params id is not set
	 */
	public function testExceptionOnEmptyId()
	{
		$update = new Update($this->transport);
		$update->getURI();
	}
}