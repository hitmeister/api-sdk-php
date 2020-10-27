<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\ProductData;

use Hitmeister\Component\Api\Endpoints\ProductData\Get;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class GetTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\ProductData
 * @author   Julian Ecknig <julian.ecknig@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class GetTest extends TransportAwareTestCase
{
	/**
	 * @dataProvider eanDataProvider
	 *
	 * @param string $ean
	 */
	public function testInstance($ean)
	{
		$get = new Get($this->transport);
		$get->setId($ean);
		$this->assertEquals($ean, $get->getId());
		$this->assertEquals([], $get->getParamWhiteList());
		$this->assertEquals('GET', $get->getMethod());
		$this->assertEquals(sprintf('product-data/%s/', $ean), $get->getURI());
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\RuntimeException
	 * @expectedExceptionMessage Required params id is not set
	 */
	public function testExceptionOnEmptyId()
	{
		$get = new Get($this->transport);
		$get->getURI();
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
