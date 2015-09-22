<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Helper\Request;
use Hitmeister\Component\Api\Namespaces\ClaimMessagesNamespace;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class ClaimMessagesNamespaceTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ClaimMessagesNamespaceTest extends TransportAwareTestCase
{
	public function testFind()
	{
		$now = time() - 86400;

		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				\Mockery::any(),
				\Mockery::any(),
				['timestamp_from' => date(Request::DATE_TIME_FORMAT, $now), 'limit' => 1, 'offset' => 10],
				\Mockery::any(),
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Hm-Collection-Range' => ['11-11/96'],
				],
				'json' => [
					[
						'id_claim_message' => 15777563,
						'id_claim' => 2939276,
					]
				]
			]);

		$namespace = new ClaimMessagesNamespace($this->transport);
		$result = $namespace->find($now, 1, 10);

		$this->assertInstanceOf('\Iterator', $result);
		$result = iterator_to_array($result);

		/** @var \Hitmeister\Component\Api\Transfers\ClaimMessageTransfer[] $result */
		$this->assertEquals(1, count($result));
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ClaimMessageTransfer', $result[0]);
		$this->assertEquals(2939276, $result[0]->id_claim);
		$this->assertEquals(15777563, $result[0]->id_claim_message);
	}

	public function testPost()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'headers' => [
				'Location' => ['/claim-messages/15798348/'],
			],
		]);

		$namespace = new ClaimMessagesNamespace($this->transport);
		$result = $namespace->post(2939276, 'message');
		$this->assertEquals(15798348, $result);
	}

	public function testGet()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'json' => [
				'id_claim_message' => 15777563,
			]
		]);

		$namespace = new ClaimMessagesNamespace($this->transport);
		$result = $namespace->get(1);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ClaimMessageTransfer', $result);
		$this->assertEquals(15777563, $result->id_claim_message);
	}

	public function testGetNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new ClaimMessagesNamespace($this->transport);
		$result = $namespace->get(10);
		$this->assertNull($result);
	}
}