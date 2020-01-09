<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Namespaces\ShipmentsNamespace;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class ShipmentsNamespaceTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Namespaces
 * @author   Darius Brückers <darius.brueckers@real-digital.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ShipmentsNamespaceTest extends TransportAwareTestCase
{
	public function testPost()
	{
		$this->transport->shouldReceive('performRequest')->once()
			->andReturn([
				'headers' => [
					'Location' => ['/shipments/123456/'],
				],
			]);

		$namespace = new ShipmentsNamespace($this->transport);
		$result = $namespace->post(10, 'DHL', '012345678');
		$this->assertEquals(123456, $result);
	}
}