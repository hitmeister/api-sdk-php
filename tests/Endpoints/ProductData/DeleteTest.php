<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\ProductData;

use Hitmeister\Component\Api\Endpoints\ProductData\Delete;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class DeleteTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\Units
 * @author   Julian Ecknig <julian.ecknig@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class DeleteTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$delete = new Delete($this->transport);
		$delete->setId("1231231231232");
		$this->assertEquals("1231231231232", $delete->getId());
		$this->assertEquals([], $delete->getParamWhiteList());
		$this->assertEquals('DELETE', $delete->getMethod());
		$this->assertEquals('product-data/1231231231232/', $delete->getURI());
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\RuntimeException
	 * @expectedExceptionMessage Required params id is not set
	 */
	public function testExceptionOnEmptyId()
	{
		$delete = new Delete($this->transport);
		$delete->getURI();
	}
}