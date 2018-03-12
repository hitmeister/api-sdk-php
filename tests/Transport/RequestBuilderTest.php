<?php

namespace Hitmeister\Component\Api\Tests\Transport;

use Hitmeister\Component\Api\Transport\RequestBuilder;

/**
 * Class RequestBuilderTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Transport
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class RequestBuilderTest extends \PHPUnit_Framework_TestCase
{
	public function testRequestDefaultApiUrl()
	{
		$builder = new RequestBuilder();
		$request = $builder->build('POST', 'and_point');
		$this->assertTrue(is_array($request));
		$this->assertArrayHasKey('scheme', $request);
		$this->assertEquals('https', $request['scheme']);
		$this->assertArrayHasKey('uri', $request);
		$this->assertEquals('/api/v1/and_point', $request['uri']);
		$this->assertArrayHasKey('headers', $request);
		$this->assertTrue(is_array($request['headers']));
		$this->assertArrayHasKey('Host', $request['headers']);
		$this->assertEquals(['www.real.de'], $request['headers']['Host']);
	}

	public function testRequest()
	{
		$builder = new RequestBuilder('http://localhost/api/');
		$this->assertStringStartsWith('HitSDK', $builder->getUserAgent());

		$requestOne = $builder->build('DELETE', 'and_point_1');
		$this->assertTrue(is_array($requestOne));
		$this->assertArrayHasKey('http_method', $requestOne);
		$this->assertEquals('DELETE', $requestOne['http_method']);
		$this->assertArrayHasKey('scheme', $requestOne);
		$this->assertEquals('http', $requestOne['scheme']);
		$this->assertArrayHasKey('uri', $requestOne);
		$this->assertEquals('/api/and_point_1', $requestOne['uri']);
		$this->assertArrayHasKey('headers', $requestOne);
		$this->assertTrue(is_array($requestOne['headers']));
		$this->assertArrayHasKey('Host', $requestOne['headers']);
		$this->assertEquals(['localhost'], $requestOne['headers']['Host']);
		$this->assertArrayHasKey('User-Agent', $requestOne['headers']);
		$this->assertTrue(is_array($requestOne['headers']['User-Agent']));
		$this->assertTrue((bool)count($requestOne['headers']['User-Agent']));
		$this->assertStringStartsWith('HitSDK', $requestOne['headers']['User-Agent'][0]);

		$requestTwo = $builder->build('PUT', 'and_point_2', ['a' => 'b']);
		$this->assertTrue(is_array($requestTwo));
		$this->assertArrayHasKey('query_string', $requestTwo);
		$this->assertEquals('a=b', $requestTwo['query_string']);
	}
}