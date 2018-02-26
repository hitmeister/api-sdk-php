<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Returns;

use Hitmeister\Component\Api\Endpoints\Returns\Find;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class FindTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\Returns
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.real.de/api/v1/
 */
class FindTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$find = new Find($this->transport);
		$this->assertEquals(['ts_created:from', 'ts_updated:from', 'tracking_code', 'status', 'sort', 'limit', 'offset'], $find->getParamWhiteList());
		$this->assertEquals('GET', $find->getMethod());
		$this->assertEquals('returns/seller/', $find->getURI());
	}
}