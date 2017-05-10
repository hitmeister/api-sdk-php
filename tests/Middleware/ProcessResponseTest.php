<?php

namespace Hitmeister\Component\Api\Tests\Middleware;

use GuzzleHttp\Ring\Future\CompletedFutureArray;
use GuzzleHttp\Ring\Future\FutureArray;
use Hitmeister\Component\Api\Exceptions\TransportException;
use Hitmeister\Component\Api\Middleware;

/**
 * Class ProcessResponseTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ProcessResponseTest extends \PHPUnit_Framework_TestCase
{
	/** @var \Mockery\Mock|\Psr\Log\LoggerInterface */
	private $logger;

	/** @var callable */
	private $futureFunc;

	/** @var array */
	private $response;

	/**
	 *
	 */
	protected function setUp()
	{
		$this->logger = \Mockery::mock('\Psr\Log\LoggerInterface');
		$this->logger->shouldReceive('log')->withAnyArgs();

		// helper function
		$this->futureFunc = function(array $response) {
			return function (array $request) use ($response) {
				return new CompletedFutureArray($response);
			};
		};

		// basic response
		$this->response = [
			'status' => 200,
			'effective_url' => 'http://localhost',
			'transfer_stats' => [
				'total_time' => 0,
			],
		];
	}

	/**
	 * This method is called after a test is executed.
	 */
	public function tearDown()
	{
		\Mockery::close();

		$this->logger = null;
		$this->futureFunc = null;
		$this->response = null;
	}

	public function testBasic()
	{
		$request = [
			'http_method' => 'PUT',
			'headers' => [],
		];

		$ff = $this->futureFunc;
		$handler = $ff($this->response);

		$middleware = Middleware::processResponse($handler, $this->logger);
		/** @var FutureArray $future */
		$future = $middleware($request);
		$result = $future->wait();

		$this->assertTrue(is_array($result));
		$this->assertArrayHasKey('status', $result);
		$this->assertArrayHasKey('effective_url', $result);
		$this->assertArrayHasKey('transfer_stats', $result);
		$this->assertArrayHasKey('json', $result);
		$this->assertTrue(is_null($result['json']));
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\TransportException
	 */
	public function testFatalError()
	{
		$this->response['error'] = new \Exception('test');

		$request = [
			'http_method' => 'PUT',
			'headers' => [],
		];

		$ff = $this->futureFunc;
		$handler = $ff($this->response);

		$middleware = Middleware::processResponse($handler, $this->logger);
		/** @var FutureArray $future */
		$future = $middleware($request);
		$future->wait();
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\BadRequestException
	 * @expectedExceptionCode 403
	 */
	public function testBadRequest()
	{
		$this->response['status'] = 403;

		$request = [
			'http_method' => 'PUT',
			'headers' => [],
		];

		$ff = $this->futureFunc;
		$handler = $ff($this->response);

		$middleware = Middleware::processResponse($handler, $this->logger);
		/** @var FutureArray $future */
		$future = $middleware($request);
		$future->wait();
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\ResourceNotFoundException
	 */
	public function testResourceNotFound()
	{
		$this->response['status'] = 404;

		$request = [
			'http_method' => 'PUT',
			'headers' => [],
		];

		$ff = $this->futureFunc;
		$handler = $ff($this->response);

		$middleware = Middleware::processResponse($handler, $this->logger);
		/** @var FutureArray $future */
		$future = $middleware($request);
		$future->wait();
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\ServerException
	 * @expectedExceptionCode 500
	 */
	public function testServerError()
	{
		$this->response['status'] = 500;

		$request = [
			'http_method' => 'PUT',
			'headers' => [],
		];

		$ff = $this->futureFunc;
		$handler = $ff($this->response);

		$middleware = Middleware::processResponse($handler, $this->logger);
		/** @var FutureArray $future */
		$future = $middleware($request);
		$future->wait();
	}

	public function testIgnoreError()
	{
		$this->response['status'] = 500;

		$request = [
			'http_method' => 'PUT',
			'headers' => [],
			'client' => [
				'ignore' => 500,
			],
		];

		$ff = $this->futureFunc;
		$handler = $ff($this->response);

		$middleware = Middleware::processResponse($handler, $this->logger);
		/** @var FutureArray $future */
		$future = $middleware($request);
		$result = $future->wait();

		$this->assertTrue(is_array($result));
		$this->assertArrayHasKey('status', $result);
		$this->assertEquals(500, $result['status']);
	}

	public function testIgnoreMultiErrors()
	{
		$this->response['status'] = 403;

		$request = [
			'http_method' => 'PUT',
			'headers' => [],
			'client' => [
				'ignore' => [500, 403],
			],
		];

		$ff = $this->futureFunc;
		$handler = $ff($this->response);

		$middleware = Middleware::processResponse($handler, $this->logger);
		/** @var FutureArray $future */
		$future = $middleware($request);
		$result = $future->wait();

		$this->assertTrue(is_array($result));
		$this->assertArrayHasKey('status', $result);
		$this->assertEquals(403, $result['status']);
	}

	public function testBodyReadyNoJson()
	{
		$stream = fopen('php://memory', 'r+');
		fwrite($stream, 'the_body');
		rewind($stream);

		$this->response['body'] = $stream;

		$request = [
			'http_method' => 'PUT',
			'headers' => [],
		];

		$ff = $this->futureFunc;
		$handler = $ff($this->response);

		$middleware = Middleware::processResponse($handler, $this->logger);
		/** @var FutureArray $future */
		$future = $middleware($request);
		$result = $future->wait();

		$this->assertTrue(is_array($result));
		$this->assertArrayHasKey('body', $result);
		$this->assertEquals('the_body', $result['body']);
		$this->assertArrayHasKey('json', $result);
		$this->assertTrue(is_null($result['json']));
	}

	public function testBodyReadyJson()
	{
		$body = '["foo", {"bar":["baz", null, 1.0, 2]}]';
		$stream = fopen('php://memory', 'r+');
		fwrite($stream, $body);
		rewind($stream);

		$this->response['body'] = $stream;

		$request = [
			'http_method' => 'PUT',
			'headers' => [],
		];

		$ff = $this->futureFunc;
		$handler = $ff($this->response);

		$middleware = Middleware::processResponse($handler, $this->logger);
		/** @var FutureArray $future */
		$future = $middleware($request);
		$result = $future->wait();

		$this->assertTrue(is_array($result));
		$this->assertArrayHasKey('body', $result);
		$this->assertJson($result['body']);
		$this->assertArrayHasKey('json', $result);
		$this->assertNotNull($result['json']);
	}

	public function testRequestIdInException()
	{
		$requestId = 'ololo';
		$this->response['status'] = 444;
		$this->response['headers'] = [
			'X-Request-ID' => [
				$requestId
			],
		];

		$request = [
			'http_method' => 'PUT',
			'headers'     => [],
		];

		$ff = $this->futureFunc;
		$handler = $ff($this->response);
		$middleware = Middleware::processResponse($handler, $this->logger);

		try {
			/** @var FutureArray $future */
			$future = $middleware($request);
			$result = $future->wait();
		} catch (TransportException $e) {
			$this->assertEquals($requestId, $e->getRequestId());
		}
	}
}