<?php
/**
 * Created for Hitmeister Project.
 * User: Maksim Naumov <maksim.naumov@hitmeister.de>
 * Date: 09/09/15
 * Time: 13:08
 */

namespace Hitmeister\Component\Api\Tests\Middleware;

use GuzzleHttp\Psr7\Request;
use Hitmeister\Component\Api\Client;
use Hitmeister\Component\Api\Middleware\SignRequest;
use Psr\Http\Message\RequestInterface;

class SignRequestTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * This method is called after a test is executed.
	 */
	public function tearDown()
	{
		\Mockery::close();
	}

	/**
	 * @runInSeparateProcess
	 */
	public function testSign()
	{
		$testHandler = function (RequestInterface $request, array $options) {
			return $request;
		};

		/** @var \Mockery\Mock $signHelper */
		$signHelper = \Mockery::mock('alias:\Hitmeister\Component\Api\Helper\Request');
		$signHelper->shouldReceive('sign')->withArgs([
			'client_key',
			'POST',
			Client::API_URL.'categories/',
			'the_body',
			\Mockery::any(),
		])->andReturn('the_signature');

		// Create some request
		$request = new Request('POST', Client::API_URL.'categories/', [], 'the_body');
		$signRequest = new SignRequest($testHandler, 'client_name', 'client_key');

		/** @var Request $result */
		$result = $signRequest($request, []);
		$headers = $result->getHeaders();

		// Header keys
		$this->assertArrayHasKey(SignRequest::HEADER_CLIENT, $headers);
		$this->assertArrayHasKey(SignRequest::HEADER_SIGNATURE, $headers);
		$this->assertArrayHasKey(SignRequest::HEADER_TIMESTAMP, $headers);

		$client = reset($headers[SignRequest::HEADER_CLIENT]);
		$signature = reset($headers[SignRequest::HEADER_SIGNATURE]);

		// Header values
		$this->assertEquals('client_name', $client);
		$this->assertEquals('the_signature', $signature);
	}
}