<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\ImportFiles;

use Hitmeister\Component\Api\Endpoints\ImportFiles\Post;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class PostTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\ImportFileAddTransfer $transfer */
		$transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\ImportFileAddTransfer');
		$transfer->shouldReceive('toArray')->once()->andReturn(['id_import_file' => 2716841, 'status' => 'IMPORTED']);

		$post = new Post($this->transport);
		$post->setTransfer($transfer);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ImportFileAddTransfer', $post->getTransfer());
		$this->assertEquals([], $post->getParamWhiteList());
		$this->assertEquals('POST', $post->getMethod());
		$this->assertEquals('import-files/', $post->getURI());

		$body = $post->getBody();
		$this->assertArrayHasKey('id_import_file', $body);
		$this->assertArrayHasKey('status', $body);
	}
}