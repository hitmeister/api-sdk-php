<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Namespaces\ProductDataStatusNamespace;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;
use Hitmeister\Component\Api\Transfers\Constants;

/**
 * Class ProductDataStatusNamespaceTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Namespaces
 * @author   Julian Ecknig <julian.ecknig@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ProductDataStatusNamespaceTest extends TransportAwareTestCase
{
	public function testGet()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'json' => [
				'item_ready' => false,
				'update_status' => Constants::UPDATE_STATUS_PENDING,
				'item_not_ready_reason' => Constants::ITEM_NOT_READY_REASON_NOT_YET_PROCESSED
			]
		]);

		$namespace = new ProductDataStatusNamespace($this->transport);
		$result = $namespace->get('1231231231232');
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ProductDataStatusTransfer', $result);
		$this->assertFalse($result->item_ready);
		$this->assertEquals(Constants::UPDATE_STATUS_PENDING, $result->update_status);
		$this->assertEquals(Constants::ITEM_NOT_READY_REASON_NOT_YET_PROCESSED, $result->item_not_ready_reason);
	}

	public function testGetNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new ProductDataStatusNamespace($this->transport);
		$result = $namespace->get('1231231231232');
		$this->assertNull($result);
	}
}