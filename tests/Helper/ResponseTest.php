<?php

namespace Hitmeister\Component\Api\Tests\Helper;

use Hitmeister\Component\Api\Exceptions\ServerException;
use Hitmeister\Component\Api\Helper\Response;

/**
 * Class ResponseTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Helper
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ResponseTest extends \PHPUnit_Framework_TestCase
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

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\ServerException
	 * @expectedExceptionMessage missing
	 */
	public function testExtractIdEmpty()
	{
		$body = [];
		Response::extractId($body, '%d');
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\ServerException
	 * @expectedExceptionMessage wrong format
	 */
	public function testExtractIdWrongFormat()
	{
		$body = [
			'headers' => [
				'Location' => [
					'something unexpected'
				]
			]
		];
		Response::extractId($body, '/claim-messages/%d/');
	}

	public function testExtractId()
	{
		$body = [
			'headers' => [
				'Location' => [
					'/claim-messages/15/'
				]
			]
		];
		$id = Response::extractId($body, '/claim-messages/%d/');
		$this->assertEquals(15, $id);
	}
}