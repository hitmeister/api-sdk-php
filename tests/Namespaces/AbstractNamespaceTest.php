<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class AbstractNamespaceTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class AbstractNamespaceTest extends TransportAwareTestCase
{
	public function testGetTransport()
	{
		/** @var \Hitmeister\Component\Api\Namespaces\AbstractNamespace $namespace */
		$namespace = \Mockery::mock('\Hitmeister\Component\Api\Namespaces\AbstractNamespace', [$this->transport])->makePartial();
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transport\Transport', $namespace->getTransport());
	}
}