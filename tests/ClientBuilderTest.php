<?php

namespace Hitmeister\Component\Api\Tests;

use Hitmeister\Component\Api\ClientBuilder;

/**
 * Class ClientBuilderTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ClientBuilderTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * This method is called after a test is executed.
	 */
	public function tearDown()
	{
		\Mockery::close();
	}

	public function testInstance()
	{
		$builder = ClientBuilder::create();
		$this->assertInstanceOf('\Hitmeister\Component\Api\ClientBuilder', $builder);
	}

	public function testDefaultHandlerCurl()
	{
		if (version_compare(PHP_VERSION, '5.5.0', '<')) {
			$this->markTestSkipped('Could be tested only on PHP >= 5.5.0');
		}
		$builder = ClientBuilder::defaultHandler();
		$this->assertInstanceOf('\GuzzleHttp\Ring\Client\CurlHandler', $builder);
	}

	public function testDefaultHandlerCurlMulti()
	{
		if (version_compare(PHP_VERSION, '5.5.0', '>=')) {
			$this->markTestSkipped('Could be tested only on PHP < 5.5.0');
		}
		$builder = ClientBuilder::defaultHandler();
		$this->assertInstanceOf('\GuzzleHttp\Ring\Client\CurlMultiHandler', $builder);
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\RuntimeException
	 */
	public function testValidateFailed()
	{
		ClientBuilder::create()->build();
	}

	public function testSetters()
	{
		/** @var \Psr\Log\LoggerInterface $logger */
		$logger = \Mockery::mock('\Psr\Log\LoggerInterface');

		$handler1 = function(array $request){};
		$handler2 = function(array $request){};

		/** @var \Hitmeister\Component\Api\Transport\Transport $transport */
		$transport = \Mockery::mock('\Hitmeister\Component\Api\Transport\Transport');

		/** @var \Mockery\Mock $middleware */
		$middleware = \Mockery::mock('alias:\Hitmeister\Component\Api\Middleware');
		$middleware->shouldReceive('signRequest')->withArgs([$handler1, 'client_key', 'client_secret'])->andReturn($handler2);
		$middleware->shouldReceive('processResponse')->withArgs([$handler2, $logger]);

		$builder = ClientBuilder::create()
			->setLogger($logger)
			->setHandler($handler1)
			->setTransport($transport)
			->setClientKey('client_key')
			->setClientSecret('client_secret')
			->setBaseUrl('https://www.hm.de/api/v20/');

		$client = $builder->build();
		$this->assertEquals($transport, $client->getTransport());
	}
}