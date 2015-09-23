<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\ReturnUnits;

use Hitmeister\Component\Api\Endpoints\ReturnUnits\Find;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class FindTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\ReturnUnits
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class FindTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$find = new Find($this->transport);
		$this->assertEquals(['ts_created:from', 'status', 'sort', 'limit', 'offset'], $find->getParamWhiteList());
		$this->assertEquals('GET', $find->getMethod());
		$this->assertEquals('return-units/seller/', $find->getURI());
	}
}