<?php


namespace Hitmeister\Component\Api\Tests\Exceptions;

use Hitmeister\Component\Api\Exceptions\TransportException;

class TransportExceptionTest extends \PHPUnit_Framework_TestCase
{
	public function testRequestIdProperty()
	{
		$e = new TransportException('Test');
		$this->assertEmpty($e->getRequestId());

		$e->setRequestId('foo');
		$this->assertEquals('foo', $e->getRequestId());

		$e->setRequestId('bar');
		$this->assertNotEquals('foo', $e->getRequestId());
	}
}
