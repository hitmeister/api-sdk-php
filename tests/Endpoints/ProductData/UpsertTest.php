<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\ProductData;

use Hitmeister\Component\Api\Endpoints\ProductData\Put;
use Hitmeister\Component\Api\Endpoints\ProductData\Upsert;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class UpsertTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\ProductData
 * @author   Julian Ecknig <julian.ecknig@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class UpsertTest extends TransportAwareTestCase
{
	/**
	 * @dataProvider eanDataProvider
	 *
	 * @param string $ean
	 */
	public function testInstance($ean)
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\ProductDataTransfer $transfer */
		$transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\ProductDataTransfer');
		$transfer->shouldReceive('toArray')->once()->andReturn(['condition' => 'new']);

		$update = new Upsert($this->transport);
		$update->setId($ean);
		$update->setTransfer($transfer);

		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ProductDataTransfer', $update->getTransfer());
		$this->assertEquals($ean, $update->getId());
		$this->assertEquals([], $update->getParamWhiteList());
		$this->assertEquals('PUT', $update->getMethod());
		$this->assertEquals(sprintf('product-data/%s/', $ean), $update->getURI());

		$body = $update->getBody();
		$this->assertArrayHasKey('condition', $body);
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\RuntimeException
	 * @expectedExceptionMessage Required params id is not set
	 */
	public function testExceptionOnEmptyId()
	{
		$update = new Upsert($this->transport);
		$update->getURI();
	}

	/**
	 * @return string[]
	 */
	public function eanDataProvider()
	{
		return [
			['1231231231232'],
			['0123123123123'],
		];
	}
}
