<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Claims;

use Hitmeister\Component\Api\Endpoints\Claims\Post;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class PostTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\Claims
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class PostTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\ClaimAddTransfer $transfer */
		$transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\ClaimAddTransfer');
		$transfer->shouldReceive('toArray')->once()->andReturn(['id_order_unit' => 2716841, 'text' => 'message']);

		$decide = new Post($this->transport);
		$decide->setTransfer($transfer);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ClaimAddTransfer', $decide->getTransfer());
		$this->assertEquals([], $decide->getParamWhiteList());
		$this->assertEquals('POST', $decide->getMethod());
		$this->assertEquals('claims/', $decide->getURI());

		$body = $decide->getBody();
		$this->assertArrayHasKey('id_order_unit', $body);
		$this->assertArrayHasKey('text', $body);
	}
}