<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Tickets;

use Hitmeister\Component\Api\Endpoints\Tickets\Post;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class PostTest extends TransportAwareTestCase
{
    public function testInstance()
    {
        /** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\TicketOpenTransfer $transfer */
        $transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\TicketOpenTransfer');
        $transfer->shouldReceive('toArray')->once()->andReturn([
            'id_order_unit' => [
                1234567,
                1234568,
                1234569,
            ],
            'reason' => 'contact_other',
            'message' => 'I have a problem',
        ]);

        $post = new Post($this->transport);
        $post->setTransfer($transfer);
        $this->assertInstanceOf(
            '\Hitmeister\Component\Api\Transfers\TicketOpenTransfer',
            $post->getTransfer()
        );
        $this->assertEquals([], $post->getParamWhiteList());
        $this->assertEquals('POST', $post->getMethod());
        $this->assertEquals('tickets/', $post->getURI());

        $body = $post->getBody();
        $this->assertArrayHasKey('id_order_unit', $body);
        $this->assertArrayHasKey('reason', $body);
        $this->assertArrayHasKey('message', $body);
    }
}