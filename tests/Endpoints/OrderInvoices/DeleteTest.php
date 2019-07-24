<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\OrderInvoices;

use Hitmeister\Component\Api\Endpoints\OrderInvoices\Delete;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class DeleteTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$get = new Delete($this->transport);
		$get->setId(1);
		$this->assertSame(1, $get->getId());
		$this->assertSame([], $get->getParamWhiteList());
		$this->assertSame('DELETE', $get->getMethod());
		$this->assertSame('order-invoices/1/', $get->getURI());
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\RuntimeException
	 * @expectedExceptionMessage Required params id is not set
	 */
	public function testExceptionOnEmptyId()
	{
		$get = new Delete($this->transport);
		$get->getURI();
	}
}
