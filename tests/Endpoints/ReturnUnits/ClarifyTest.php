<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\ReturnUnits;

use Hitmeister\Component\Api\Endpoints\ReturnUnits\Clarify;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class ClarifyTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\ReturnUnits
 * @author   Oleksandr Dombrovskyi <oleksandr.dombrovskyi@real-digital.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ClarifyTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$repair = new Clarify($this->transport);
		$repair->setId(10);
		$this->assertEquals(10, $repair->getId());
		$this->assertEquals([], $repair->getParamWhiteList());
		$this->assertEquals('PATCH', $repair->getMethod());
		$this->assertEquals('return-units/10/clarify/', $repair->getURI());
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\RuntimeException
	 * @expectedExceptionMessage Required params id is not set
	 */
	public function testExceptionOnEmptyId()
	{
		$get = new Clarify($this->transport);
		$get->getURI();
	}
}
