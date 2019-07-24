<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\OrderInvoices;

use Hitmeister\Component\Api\Endpoints\OrderInvoices\Find;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class FindTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$find = new Find($this->transport);
		$this->assertSame(['limit', 'offset'], $find->getParamWhiteList());
		$this->assertSame('GET', $find->getMethod());
		$this->assertSame('order-invoices/seller/', $find->getURI());
	}
}
