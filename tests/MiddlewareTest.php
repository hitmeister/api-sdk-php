<?php

namespace Hitmeister\Component\Api\Tests;

use Hitmeister\Component\Api\Middleware;

/**
 * Class MiddlewareTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class MiddlewareTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * This method is called after a test is executed.
	 */
	public function tearDown()
	{
		\Mockery::close();
	}

	public function testSignRequest()
	{
		/** @var \Mockery\Mock $securityHelper */
		$securityHelper = \Mockery::mock('alias:\Hitmeister\Component\Api\Helper\Security');
		$securityHelper->shouldReceive('signRequest')->withArgs([
			'client_secret',
			'POST',
			\Mockery::any(),
			'the_body',
			\Mockery::any(),
		])->andReturn('the_signature');

		/** @var \Mockery\Mock $coreHelper */
		$coreHelper = \Mockery::mock('alias:\GuzzleHttp\Ring\Core');
		$coreHelper->shouldReceive('url')->withArgs([
			\Mockery::type('array')
		]);

		// Fake handler
		$handler = function(array $request){
			return $request;
		};

		$middleware = Middleware::signRequest($handler, 'client_key', 'client_secret');
		$result = $middleware([
			'http_method' => 'POST',
			'body' => 'the_body',
			'headers' => [],
		]);

		$this->assertTrue(is_array($result));
		$this->assertArrayHasKey('headers', $result);
		$this->assertTrue(is_array($result['headers']));
		$this->assertArrayHasKey('HM-Client', $result['headers']);
		$this->assertArrayHasKey('HM-Timestamp', $result['headers']);
		$this->assertArrayHasKey('HM-Signature', $result['headers']);
		$this->assertEquals('the_signature', $result['headers']['HM-Signature'][0]);
		$this->assertEquals('client_key', $result['headers']['HM-Client'][0]);
	}
}