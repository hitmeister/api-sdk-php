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
	public function testTransportInstance()
	{
		$client = new Client($this->transport);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transport\Transport', $client->getTransport());
	}

	public function testAttributesNamespace()
	{
		$client = new Client($this->transport);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Namespaces\AttributesNamespace', $client->attributes());
	}

	public function testCategoriesNamespace()
	{
		$client = new Client($this->transport);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Namespaces\CategoriesNamespace', $client->categories());
	}

	public function testClaimMessages()
	{
		$client = new Client($this->transport);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Namespaces\ClaimMessagesNamespace',
			$client->claimMessages());
	}

	public function testStatusNamespace()
	{
		$client = new Client($this->transport);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Namespaces\StatusNamespace', $client->status());
	}
}