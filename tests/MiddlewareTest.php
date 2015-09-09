<?php
/**
 * Created for Hitmeister Project.
 * User: Maksim Naumov <maksim.naumov@hitmeister.de>
 * Date: 09/09/15
 * Time: 12:55
 */

namespace Hitmeister\Component\Api\Tests;

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
}