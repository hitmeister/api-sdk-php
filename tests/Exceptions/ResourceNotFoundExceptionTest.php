<?php

namespace Hitmeister\Component\Api\Tests\Exceptions;

use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;

class ResourceNotFoundExceptionTest extends \PHPUnit_Framework_TestCase
{
	public function testInstance()
	{
		$e1 = new ResourceNotFoundException('Hello');
		$this->assertEquals(404, $e1->getCode());
		$this->assertEquals('Hello', $e1->getMessage());

		// Default message
		$e2 = new ResourceNotFoundException();
		$this->assertEquals('Resource not found', $e2->getMessage());
	}
}