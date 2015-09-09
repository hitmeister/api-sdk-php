<?php
/**
 * Created for Hitmeister Project.
 * User: Maksim Naumov <maksim.naumov@hitmeister.de>
 * Date: 09/09/15
 * Time: 12:55
 */

namespace Hitmeister\Component\Api\Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Hitmeister\Component\Api\Client;
use Hitmeister\Component\Api\Middleware;

class MiddlewareTest extends \PHPUnit_Framework_TestCase
{
	public function testSignRequestInstance()
	{
		$middleware = Middleware::signRequest('client_name', 'client_key');

		// Should return callable
		$this->assertTrue(is_callable($middleware));

		/** @var Middleware\SignRequest $signRequest */
		$signRequest = $middleware(function() {});

		// Should be instance of SignRequest
		$this->assertInstanceOf(Middleware\SignRequest::class, $signRequest);

		// Should has passed params
		$this->assertEquals('client_name', $signRequest->getClient());
		$this->assertEquals('client_key', $signRequest->getClientSecret());
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exception\NotFound
	 */
	public function testThrowsNotFoundException()
	{
		$middleware = Middleware::httpErrors();
		$handler = new MockHandler([new Response(404)]);
		$httpErrorsFunc = $middleware($handler);

		/** @var PromiseInterface $promise */
		$promise = $httpErrorsFunc(new Request('GET', Client::API_URL.'nothing_is_here/'), []);
		$this->assertEquals('pending', $promise->getState());
		$promise->wait();
		$this->assertEquals('rejected', $promise->getState());
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exception\ServerError
	 */
	public function testThrowsServerErrorException()
	{
		$middleware = Middleware::httpErrors();
		$handler = new MockHandler([new Response(500)]);
		$httpErrorsFunc = $middleware($handler);

		/** @var PromiseInterface $promise */
		$promise = $httpErrorsFunc(new Request('GET', Client::API_URL.'server_error/'), []);
		$this->assertEquals(PromiseInterface::PENDING, $promise->getState());
		$promise->wait();
		$this->assertEquals(PromiseInterface::REJECTED, $promise->getState());
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exception\BadResponse
	 */
	public function testThrowsBadResponseException()
	{
		$middleware = Middleware::httpErrors();
		$handler = new MockHandler([new Response(401)]);
		$httpErrorsFunc = $middleware($handler);

		/** @var PromiseInterface $promise */
		$promise = $httpErrorsFunc(new Request('GET', Client::API_URL.'server_error/'), []);
		$this->assertEquals(PromiseInterface::PENDING, $promise->getState());
		$promise->wait();
		$this->assertEquals(PromiseInterface::REJECTED, $promise->getState());
	}

	public function testNotThrowsException()
	{
		$middleware = Middleware::httpErrors();
		$handler = new MockHandler([new Response(200)]);
		$httpErrorsFunc = $middleware($handler);

		/** @var PromiseInterface $promise */
		$promise = $httpErrorsFunc(new Request('GET', Client::API_URL.'server_error/'), []);
		$this->assertEquals(PromiseInterface::PENDING, $promise->getState());
		$promise->wait();
		$this->assertEquals(PromiseInterface::FULFILLED, $promise->getState());
	}
}