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
	public function testInstance()
	{
		$get = new Get($this->transport);
		$get->setId('1231231231232');
		$this->assertEquals('1231231231232', $get->getId());
		$this->assertEquals([], $get->getParamWhiteList());
		$this->assertEquals('GET', $get->getMethod());
		$this->assertEquals('product-data/1231231231232/', $get->getURI());
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
}