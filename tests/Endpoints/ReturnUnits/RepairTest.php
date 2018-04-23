<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\ReturnUnits;

use Hitmeister\Component\Api\Endpoints\ReturnUnits\Repair;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class RepairTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\ReturnUnits
 * @author   Philipp Schreiber <philipp.schreiber@real-digital.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class RepairTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$repair = new Repair($this->transport);
		$repair->setId(10);
		$this->assertEquals(10, $repair->getId());
		$this->assertEquals([], $repair->getParamWhiteList());
		$this->assertEquals('PATCH', $repair->getMethod());
		$this->assertEquals('return-units/10/repair/', $repair->getURI());
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\RuntimeException
	 * @expectedExceptionMessage Required params id is not set
	 */
	public function testExceptionOnEmptyId()
	{
		$get = new Repair($this->transport);
		$get->getURI();
	}
}
