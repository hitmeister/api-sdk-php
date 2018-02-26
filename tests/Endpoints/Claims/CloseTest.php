<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Claims;

use Hitmeister\Component\Api\Endpoints\Claims\Close;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class CloseTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\Claims
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.real.de/api/v1/
 */
class CloseTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$get = new Close($this->transport);
		$get->setId(10);
		$this->assertEquals(10, $get->getId());
		$this->assertEquals([], $get->getParamWhiteList());
		$this->assertEquals('PATCH', $get->getMethod());
		$this->assertEquals('claims/10/close/', $get->getURI());
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\RuntimeException
	 * @expectedExceptionMessage Required params id is not set
	 */
	public function testExceptionOnEmptyId()
	{
		$get = new Close($this->transport);
		$get->getURI();
	}
}