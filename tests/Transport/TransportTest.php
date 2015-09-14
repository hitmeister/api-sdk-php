<?php

namespace Hitmeister\Component\Api\Tests\Transport;

use Hitmeister\Component\Api\Transport\Transport;

/**
 * Class TransportTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Transport
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class TransportTest extends \PHPUnit_Framework_TestCase
{
	/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transport\RequestBuilder */
	private $requestBuilder;

	/**
	 *
	 */
	protected function setUp()
	{
		$this->requestBuilder = \Mockery::mock('\Hitmeister\Component\Api\Transport\RequestBuilder');
		$this->requestBuilder->shouldReceive('build')->withArgs([
			'POST',
			'and_point',
			\Mockery::any(),
		])->andReturn([
			'http_method' => 'POST',
			'scheme' => 'https',
			'uri' => '/api/v1/and_point',
			'headers' => [
				'Host' => ['www.hitmeister.de'],
				'User-Agent' => ['User Agent'],
			],
			'client' => [
				'connect_timeout' => 30,
				'timeout' => 60,
			],
		]);
	}

	/**
	 * This method is called after a test is executed.
	 */
	public function tearDown()
	{
		\Mockery::close();

		$this->requestBuilder = null;
	}

	public function testPerformRequest()
	{
		// Fake handler
		$handler = function(array $request) {
			return $request;
		};

		$transport = new Transport($handler, $this->requestBuilder);
		$result = $transport->performRequest('POST', 'and_point', null, ['a' => 'b'], ['client' => ['ignore' => 500]]);

		$this->assertTrue(is_array($result));
		$this->assertArrayHasKey('body', $result);
		$this->assertJson($result['body']);
		$this->assertArrayHasKey('client', $result);
		$this->assertTrue(is_array($result['client']));
		$this->assertArrayHasKey('ignore', $result['client']);
		$this->assertEquals(500, $result['client']['ignore']);
	}

	public function testPerformRequestFuture()
	{
		/** @var \Mockery\Mock $future */
		$future = \Mockery::mock('\GuzzleHttp\Ring\Future\FutureArrayInterface');
		$future->shouldReceive('wait')->once()->andReturn('the_result');

		// Fake handler
		$handler = function(array $request) use($future) {
			return $future;
		};

		$transport = new Transport($handler, $this->requestBuilder);
		$result = $transport->performRequest('POST', 'and_point');
		$this->assertEquals('the_result', $result);
	}
}