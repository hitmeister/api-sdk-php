<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\ProductData;

use Hitmeister\Component\Api\Endpoints\ProductData\Put;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class UpdateTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\ProductData
 * @author   Julian Ecknig <julian.ecknig@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class PutTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\ProductDataTransfer $transfer */
		$transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\ProductDataTransfer');
		$transfer->shouldReceive('toArray')->once()->andReturn(['condition' => 'new']);

		$update = new Put($this->transport);
		$update->setId('1231231231232');
		$update->setTransfer($transfer);

		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ProductDataTransfer', $update->getTransfer());
		$this->assertEquals('1231231231232', $update->getId());
		$this->assertEquals([], $update->getParamWhiteList());
		$this->assertEquals('PUT', $update->getMethod());
		$this->assertEquals('product-data/1231231231232/', $update->getURI());

		$body = $update->getBody();
		$this->assertArrayHasKey('condition', $body);
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\RuntimeException
	 * @expectedExceptionMessage Required params id is not set
	 */
	public function testExceptionOnEmptyId()
	{
		$update = new Put($this->transport);
		$update->getURI();
	}
}