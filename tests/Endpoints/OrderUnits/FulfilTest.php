<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\OrderUnits;

use Hitmeister\Component\Api\Endpoints\OrderUnits\Fulfil;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class FulfilTest extends TransportAwareTestCase
{
    public function testInstance()
    {
        $endpoint = new Fulfil($this->transport);
        $endpoint->setId(10);
        $this->assertEquals(10, $endpoint->getId());
        $this->assertEquals([], $endpoint->getParamWhiteList());
        $this->assertEquals('PATCH', $endpoint->getMethod());
        $this->assertEquals('order-units/10/fulfil/', $endpoint->getURI());
    }

    /**
     * @expectedException \Hitmeister\Component\Api\Exceptions\RuntimeException
     * @expectedExceptionMessage Required params id is not set
     */
    public function testExceptionOnEmptyId()
    {
        $endpoint = new Fulfil($this->transport);
        $endpoint->getURI();
    }
}