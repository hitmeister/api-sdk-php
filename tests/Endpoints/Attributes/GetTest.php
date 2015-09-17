<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Attributes;

use Hitmeister\Component\Api\Endpoints\Attributes\Get;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class GetTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\Attributes
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class GetTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$get = new Get($this->transport);
		$get->setId(10);
		$this->assertEquals(10, $get->getId());
		$this->assertEquals([], $get->getParamWhiteList());
		$this->assertEquals('GET', $get->getMethod());
		$this->assertEquals('attributes/10/', $get->getURI());
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\RuntimeException
	 * @expectedExceptionMessage Required params id is not set
	 */
	public function testExceptionOnEmptyId()
	{
		$get = new Get($this->transport);
		$get->getURI();
	}
}