<?php

namespace Hitmeister\Component\Api\Tests\Helper;

use Hitmeister\Component\Api\Helper\Request;

/**
 * Class RequestTest

 *
*@category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Helper
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class RequestTest extends \PHPUnit_Framework_TestCase
{
	public function testDateTime()
	{
		$now = time();
		$dt = new \DateTime();
		$expected = date(Request::DATE_TIME_FORMAT);

		$this->assertNull(Request::formatDateTime(null));
		$this->assertEquals($dt->format(Request::DATE_TIME_FORMAT), Request::formatDateTime($dt));
		$this->assertEquals($expected, Request::formatDateTime($now));
		$this->assertEquals($expected, Request::formatDateTime($expected));
		$this->assertEquals(date(Request::DATE_FORMAT), Request::formatDate($now));
	}

}