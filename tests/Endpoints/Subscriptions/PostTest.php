<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Subscriptions;

use Hitmeister\Component\Api\Endpoints\Subscriptions\Post;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class PostTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\Subscriptions
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class PostTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\SubscriptionAddTransfer $transfer */
		$transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\SubscriptionAddTransfer');
		$transfer->shouldReceive('toArray')->once()->andReturn(['callback_url' => 'http://localhost']);

		$post = new Post($this->transport);
		$post->setTransfer($transfer);

		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\SubscriptionAddTransfer', $post->getTransfer());
		$this->assertEquals([], $post->getParamWhiteList());
		$this->assertEquals('POST', $post->getMethod());
		$this->assertEquals('subscriptions/', $post->getURI());

		$body = $post->getBody();
		$this->assertArrayHasKey('callback_url', $body);
	}
}