<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\ReturnUnits;

use Hitmeister\Component\Api\Endpoints\ReturnUnits\Accept;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class AcceptTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\ReturnUnits
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class AcceptTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$accept = new Accept($this->transport);
		$accept->setId(10);
		$this->assertEquals(10, $accept->getId());
		$this->assertEquals([], $accept->getParamWhiteList());
		$this->assertEquals('PATCH', $accept->getMethod());
		$this->assertEquals('return-units/10/accept/', $accept->getURI());
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\RuntimeException
	 * @expectedExceptionMessage Required params id is not set
	 */
	public function testExceptionOnEmptyId()
	{
		$get = new Accept($this->transport);
		$get->getURI();
	}
}