<?php

namespace Hitmeister\Component\Api\Tests\Helper;

use Hitmeister\Component\Api\Exceptions\ServerException;
use Hitmeister\Component\Api\Helper\Response;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class ResponseTest extends TransportAwareTestCase
{
	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\ServerException
	 * @expectedExceptionMessage POST some_endpoint
	 */
	public function testCheckBodyError()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Endpoints\AbstractEndpoint $endpoint */
		$endpoint =
			\Mockery::mock('\Hitmeister\Component\Api\Endpoints\AbstractEndpoint[getParamWhiteList,getMethod,getURI]',
				[$this->transport]);
		$endpoint->shouldReceive('getMethod')->andReturn('POST');
		$endpoint->shouldReceive('getURI')->andReturn('some_endpoint');

		$body = [];
		Response::checkBody($body, $endpoint);
	}

	public function testCheckBody()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Endpoints\AbstractEndpoint $endpoint */
		$endpoint =
			\Mockery::mock('\Hitmeister\Component\Api\Endpoints\AbstractEndpoint[getParamWhiteList,getMethod,getURI]',
				[$this->transport]);

		$body = ['json' => []];

		try {
			Response::checkBody($body, $endpoint);
		} catch (ServerException $e) {
			$this->fail('Exception thrown');
		}
	}
}