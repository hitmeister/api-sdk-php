<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Units;

use Hitmeister\Component\Api\Endpoints\Units\Post;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class PostTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\Units
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class PostTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\UnitAddTransfer $transfer */
		$transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\UnitAddTransfer');
		$transfer->shouldReceive('toArray')->once()->andReturn(['id_item' => 123, 'ean' => 'ean']);

		$post = new Post($this->transport);
		$post->setTransfer($transfer);

		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\UnitAddTransfer', $post->getTransfer());
		$this->assertEquals([], $post->getParamWhiteList());
		$this->assertEquals('POST', $post->getMethod());
		$this->assertEquals('units/', $post->getURI());

		$body = $post->getBody();
		$this->assertArrayHasKey('id_item', $body);
		$this->assertArrayHasKey('ean', $body);
	}
}