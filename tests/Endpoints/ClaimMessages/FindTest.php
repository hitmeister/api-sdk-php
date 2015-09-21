<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\ClaimMessages;

use Hitmeister\Component\Api\Endpoints\ClaimMessages\Find;
use Hitmeister\Component\Api\Tests\Endpoints\AbstractEndpointTest;

/**
 * Class FindTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\ClaimMessages
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class FindTest extends AbstractEndpointTest
{
	public function testInstance()
	{
		$get = new Find($this->transport);
		$this->assertEquals(['timestamp_from', 'limit', 'offset'], $get->getParamWhiteList());
		$this->assertEquals('GET', $get->getMethod());
		$this->assertEquals('claim-messages/seller/', $get->getURI());
	}
}