<?php

namespace Hitmeister\Component\Api\Tests;

use Hitmeister\Component\Api\Client;

/**
 * Class ClientTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * This method is called after a test is executed.
	 */
	public function tearDown()
	{
		\Mockery::close();
	}

	public function testTransportInstance()
	{
		/** @var \Hitmeister\Component\Api\Transport\Transport $mock */
		$mock = \Mockery::mock('\Hitmeister\Component\Api\Transport\Transport');
		$client = new Client($mock);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transport\Transport', $client->getTransport());
	}
}