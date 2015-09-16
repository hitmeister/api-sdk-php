<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Namespaces\StatusNamespace;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class StatusNamespaceTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class StatusNamespaceTest extends TransportAwareTestCase
{
	public function testPing()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'json' => [
				'message' => 'Hello world',
			]
		]);

		$namespace = new StatusNamespace($this->transport);
		$result = $namespace->ping();
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\StatusPingTransfer', $result);
		$this->assertEquals('Hello world', $result->message);
	}
}