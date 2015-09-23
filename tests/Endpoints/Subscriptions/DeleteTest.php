<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Subscriptions;

use Hitmeister\Component\Api\Endpoints\Subscriptions\Delete;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class DeleteTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\Subscriptions
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class DeleteTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$delete = new Delete($this->transport);
		$delete->setId(10);
		$this->assertEquals(10, $delete->getId());
		$this->assertEquals([], $delete->getParamWhiteList());
		$this->assertEquals('DELETE', $delete->getMethod());
		$this->assertEquals('subscriptions/10/', $delete->getURI());
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