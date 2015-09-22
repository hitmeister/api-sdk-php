<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\ClaimMessages;

use Hitmeister\Component\Api\Endpoints\ClaimMessages\Post;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class PostTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\ClaimMessages
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class PostTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\ClaimMessageAddTransfer $transfer */
		$transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\ClaimMessageAddTransfer');
		$transfer->shouldReceive('toArray')->once()->andReturn(['id_claim' => 2716841, 'text' => 'message']);

		$post = new Post($this->transport);
		$post->setTransfer($transfer);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ClaimMessageAddTransfer', $post->getTransfer());
		$this->assertEquals([], $post->getParamWhiteList());
		$this->assertEquals('POST', $post->getMethod());
		$this->assertEquals('claim-messages/', $post->getURI());

		$body = $post->getBody();
		$this->assertArrayHasKey('id_claim', $body);
		$this->assertArrayHasKey('text', $body);
	}
}