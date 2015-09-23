<?php

namespace Hitmeister\Component\Api\Tests;

use Hitmeister\Component\Api\Client;

/**
 * Class ClientTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ClientTest extends TransportAwareTestCase
{
	public function testNamespaceInstances()
	{
		$client = new Client($this->transport);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transport\Transport', $client->getTransport());
		$this->assertInstanceOf('\Hitmeister\Component\Api\Namespaces\AttributesNamespace', $client->attributes());
		$this->assertInstanceOf('\Hitmeister\Component\Api\Namespaces\CategoriesNamespace', $client->categories());
		$this->assertInstanceOf('\Hitmeister\Component\Api\Namespaces\ClaimMessagesNamespace', $client->claimMessages());
		$this->assertInstanceOf('\Hitmeister\Component\Api\Namespaces\ClaimsNamespace', $client->claims());
		$this->assertInstanceOf('\Hitmeister\Component\Api\Namespaces\ImportFilesNamespace', $client->importFiles());
		$this->assertInstanceOf('\Hitmeister\Component\Api\Namespaces\ItemsNamespace', $client->items());
		$this->assertInstanceOf('\Hitmeister\Component\Api\Namespaces\OrdersNamespace', $client->orders());
		$this->assertInstanceOf('\Hitmeister\Component\Api\Namespaces\OrderUnitsNamespace', $client->orderUnits());
		$this->assertInstanceOf('\Hitmeister\Component\Api\Namespaces\ReportsNamespace', $client->reports());
		$this->assertInstanceOf('\Hitmeister\Component\Api\Namespaces\ReturnsNamespace', $client->returns());
		$this->assertInstanceOf('\Hitmeister\Component\Api\Namespaces\ReturnUnitsNamespace', $client->returnUnits());
		$this->assertInstanceOf('\Hitmeister\Component\Api\Namespaces\StatusNamespace', $client->status());
	}
}