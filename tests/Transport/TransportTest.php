<?php

namespace Hitmeister\Component\Api\Tests\Transport;

use Hitmeister\Component\Api\Transport\Transport;

class TransportTest extends \PHPUnit_Framework_TestCase
{
	public function testPerformRequest()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transport\RequestBuilder $builder */
		$builder = \Mockery::mock('\Hitmeister\Component\Api\Transport\RequestBuilder');
		$builder->shouldReceive('build')->withArgs([
			'POST',
			'and_point',
			\Mockery::any(),
		])->andReturn([
			'client' => [
				'timeout' => 30,
			]
		]);

		// Fake handler
		$handler = function(array $request) {
			return $request;
		};

		$transport = new Transport($handler, $builder);
		$result = $transport->performRequest('POST', 'and_point', null, ['a' => 'b'], ['client' => ['ignore' => 500]]);

		$this->assertArrayHasKey('body', $result);
		$this->assertJson($result['body']);
		$this->assertArrayHasKey('client', $result);
		$this->assertTrue(is_array($result['client']));
		$this->assertArrayHasKey('ignore', $result['client']);
		$this->assertEquals(500, $result['client']['ignore']);
	}
}