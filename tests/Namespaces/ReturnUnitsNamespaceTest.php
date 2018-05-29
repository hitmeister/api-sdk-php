<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Helper\Request;
use Hitmeister\Component\Api\Namespaces\ReturnUnitsNamespace;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class ReturnUnitsNamespaceTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ReturnUnitsNamespaceTest extends TransportAwareTestCase
{
	public function testFind()
	{
		$createdTime = time() - 100;

		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				\Mockery::any(),
				\Mockery::any(),
				[
					'status' => 'return_accepted',
					'ts_created:from' => date(Request::DATE_TIME_FORMAT, $createdTime),
					'sort' => 'ts_created:desc',
					'limit' => 30,
					'offset' => 0,
				],
				\Mockery::any(),
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Hm-Collection-Range' => ['1-30/86'],
				],
				'json' => [
					[
						'id_return_unit' => 208633,
						'status' => 'return_accepted'
					]
				]
			]);

		$namespace = new ReturnUnitsNamespace($this->transport);
		$result = $namespace->find(['return_accepted'], $createdTime);

		$this->assertInstanceOf('\Iterator', $result);
		$result = iterator_to_array($result);

		/** @var \Hitmeister\Component\Api\Transfers\ReturnUnitTransfer[] $result */
		$this->assertEquals(1, count($result));
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ReturnUnitTransfer', $result[0]);
		$this->assertEquals(208633, $result[0]->id_return_unit);
		$this->assertEquals('return_accepted', $result[0]->status);
	}

	public function testGetEmbedded()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'json' => [
				'id_return_unit' => 208633,
				'return' => [
					'id_return' => 179074,
				],
			]
		]);

		$namespace = new ReturnUnitsNamespace($this->transport);
		$result = $namespace->get(208633, ['return']);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ReturnUnitWithEmbeddedTransfer', $result);
		$this->assertEquals(208633, $result->id_return_unit);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ReturnTransfer', $result->return);
	}

	public function testGetNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new ReturnUnitsNamespace($this->transport);
		$result = $namespace->get(10);
		$this->assertNull($result);
	}

	public function testAccept()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'status' => 204,
		]);

		$namespace = new ReturnUnitsNamespace($this->transport);
		$result = $namespace->accept(10);
		$this->assertTrue($result);
	}

	public function testAcceptNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new ReturnUnitsNamespace($this->transport);
		$result = $namespace->accept(10);
		$this->assertFalse($result);
	}

	public function testReject()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'status' => 204,
		]);

		$namespace = new ReturnUnitsNamespace($this->transport);
		$result = $namespace->reject(10, 'message');
		$this->assertTrue($result);
	}

	public function testRejectNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new ReturnUnitsNamespace($this->transport);
		$result = $namespace->reject(10, 'message');
		$this->assertFalse($result);
	}

	public function testRepair()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'status' => 204,
		]);

		$namespace = new ReturnUnitsNamespace($this->transport);
		$result = $namespace->repair(10);
		$this->assertTrue($result);
	}

	public function testRepairNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new ReturnUnitsNamespace($this->transport);
		$result = $namespace->repair(10);
		$this->assertFalse($result);
	}

	public function testClarify()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'status' => 204,
		]);

		$namespace = new ReturnUnitsNamespace($this->transport);
		$result = $namespace->clarify(10, 'message');
		$this->assertTrue($result);
	}

	public function testClarifyNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new ReturnUnitsNamespace($this->transport);
        $result = $namespace->clarify(10, 'message');
		$this->assertFalse($result);
	}
}