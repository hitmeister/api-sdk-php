<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\OrderUnits;

use Hitmeister\Component\Api\Endpoints\OrderUnits\Find;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class FindTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\OrderUnits
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class FindTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$find = new Find($this->transport);
		$this->assertEquals(['id_offer', 'status', 'ts_created:from', 'ts_updated:from', 'sort', 'limit', 'offset'], $find->getParamWhiteList());
		$this->assertEquals('GET', $find->getMethod());
		$this->assertEquals('order-units/seller/', $find->getURI());
	}
}