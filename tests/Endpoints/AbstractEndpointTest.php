<?php

namespace Hitmeister\Component\Api\Tests\Endpoints;

use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class AbstractEndpointTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class AbstractEndpointTest extends TransportAwareTestCase
{
	/** @var \Mockery\Mock|\Hitmeister\Component\Api\Endpoints\AbstractEndpoint */
	private $endpoint;

	/**
	 *
	 */
	public function setUp()
	{
		parent::setUp();

		// Partial mock of abstract class
		$this->endpoint =
			\Mockery::mock('\Hitmeister\Component\Api\Endpoints\AbstractEndpoint[getParamWhiteList,getMethod,getURI]',
				[$this->transport]);
		$this->endpoint->shouldReceive('getMethod')->andReturn('POST');
		$this->endpoint->shouldReceive('getURI')->andReturn('some_endpoint');
	}

	/**
	 * This method is called after a test is executed.
	 */
	public function tearDown()
	{
		$this->endpoint = null;
		parent::tearDown();
	}

	public function testGetTransport()
	{
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transport\Transport', $this->endpoint->getTransport());
	}

	public function testPerformRequest()
	{
		$this->transport->shouldReceive('performRequest')->withArgs(['POST', 'some_endpoint', [], null, []]);
		$this->endpoint->performRequest();
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\UnexpectedParamException
	 */
	public function testSetParamsNotValid()
	{
		$this->transport->shouldNotReceive('performRequest');

		$this->endpoint->shouldReceive('getParamWhiteList')->andReturn([]);

		$this->endpoint->setParams(['param1' => 'value1']);
		$this->endpoint->performRequest();
	}

	public function testSetParamsExtractOptions()
	{
		$expectedOptions = ['client' => [
			'hello' => 'world',
		]];

		$this->transport->shouldReceive('performRequest')->withArgs(['POST', 'some_endpoint', [], null, $expectedOptions]);

		$this->endpoint->shouldReceive('getParamWhiteList')->andReturn([]);

		$this->endpoint->setParams($expectedOptions);
		$this->endpoint->performRequest();
	}

	public function testSetParamsExtractOptionsIgnore()
	{
		$expectedOptions = ['client' => [
			'ignore' => ['404', '500'],
		]];

		$this->transport->shouldReceive('performRequest')->withArgs(['POST', 'some_endpoint', [], null, $expectedOptions]);

		$this->endpoint->shouldReceive('getParamWhiteList')->andReturn([]);

		$this->endpoint->setParams(['client' => [
			'ignore' => '404,500',
		]]);
		$this->endpoint->performRequest();
	}

	public function testSetParamsExtractOptionsIgnoreNonString()
	{
		$expectedOptions = ['client' => [
			'ignore' => [500],
		]];

		$this->transport->shouldReceive('performRequest')->withArgs(['POST', 'some_endpoint', [], null, $expectedOptions]);

		$this->endpoint->shouldReceive('getParamWhiteList')->andReturn([]);

		$this->endpoint->setParams(['client' => [
			'ignore' => 500,
		]]);
		$this->endpoint->performRequest();
	}

	public function testSetParamsConvertToString()
	{
		$expectedParams = [
			'status' => 'new,very_new,super_new',
			'statuses' => [[1,2,3],[4,5,6]],
		];

		$this->transport->shouldReceive('performRequest')->withArgs(['POST', 'some_endpoint', $expectedParams, null, []]);

		$this->endpoint->shouldReceive('getParamWhiteList')->andReturn(['status', 'statuses']);

		$this->endpoint->setParams([
			'status' => ['new', 'very_new', 'super_new'],
			'statuses' => [[1,2,3],[4,5,6]],
		]);
		$this->endpoint->performRequest();
	}

	public function testGetParams()
	{
		$params = [
			'status' => 'new',
		];
		$this->endpoint->shouldReceive('getParamWhiteList')->andReturn(['status']);
		$this->endpoint->setParams($params);
		$this->assertEquals($params, $this->endpoint->getParams());
	}

	public function testGetParamsWithOptions()
	{
		$params = [
			'status' => 'new',
			'client' => [
				'test_me' => 'hard',
			]
		];
		$this->endpoint->shouldReceive('getParamWhiteList')->andReturn(['status']);
		$this->endpoint->setParams($params);
		$this->assertEquals($params, $this->endpoint->getParams());
	}
}