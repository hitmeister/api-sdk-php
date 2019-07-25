<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\OrderInvoices;

use Hitmeister\Component\Api\Endpoints\OrderInvoices\Post;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;
use Hitmeister\Component\Api\Transfers\OrderInvoiceAddTransfer;

class PostTest extends TransportAwareTestCase
{
	public function testInstance()
	{
	    $transfer = new OrderInvoiceAddTransfer();
	    $transfer->id_order = 'MX12FS';
	    $transfer->original_name = 'invoice123.pdf';
	    $transfer->data = 'cmVhbC5kaWdpdGFs';
	    $transfer->mime_type = 'application/pdf';

		$post = new Post($this->transport);
		$post->setTransfer($transfer);
		$this->assertSame($transfer, $post->getTransfer());
		$this->assertSame([], $post->getParamWhiteList());
		$this->assertSame('POST', $post->getMethod());
		$this->assertSame('order-invoices/', $post->getURI());

		$this->assertSame($transfer->toArray(), $post->getBody());
	}
}
