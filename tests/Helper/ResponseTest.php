<?php

namespace Hitmeister\Component\Api\Tests\Helper;

use Hitmeister\Component\Api\Exceptions\ServerException;
use Hitmeister\Component\Api\Helper\Response;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class ResponseTest extends TransportAwareTestCase
{
	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\ServerException
	 * @expectedExceptionMessage Unexpected server response
	 */
	public function testCheckBodyError()
	{
		$body = [];
		Response::checkBody($body);
	}

	public function testCheckBody()
	{
		$body = ['json' => []];

		try {
			Response::checkBody($body);
		} catch (ServerException $e) {
			$this->fail('Exception thrown');
		}
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\ServerException
	 * @expectedExceptionMessage missing
	 */
	public function testExtractCursorEmpty()
	{
		$body = [];
		Response::extractCursorPosition($body);
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\ServerException
	 * @expectedExceptionMessage wrong format
	 */
	public function testExtractCursorWrongFormat()
	{
		$body = [
			'headers' => [
				'Hm-Collection-Range' => [
					'something unexpected'
				]
			]
		];
		Response::extractCursorPosition($body);
	}

	public function testExtractCursor()
	{
		$body = [
			'headers' => [
				'Hm-Collection-Range' => [
					'6-10/5575'
				]
			]
		];
		$result = Response::extractCursorPosition($body);
		$this->assertEquals(6, $result['start']);
		$this->assertEquals(10, $result['end']);
		$this->assertEquals(5575, $result['total']);
	}
}