<?php

namespace Hitmeister\Component\Api\Tests\Helper;

use Hitmeister\Component\Api\Helper\Security;

/**
 * Class SecurityTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Helper
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class SecurityTest extends \PHPUnit_Framework_TestCase
{
	public function testSignRequest()
	{
		$time = 1441955581;
		$expected = 'a2f5a5d56660a648f1c8f3b5f92c746a014cd02e82b28a9891e8c4d4f7998b32';
		$signature = Security::signRequest('client_secret', 'PUT', 'http://localhost/', '{}', $time);
		$this->assertEquals($expected, $signature);
	}
}