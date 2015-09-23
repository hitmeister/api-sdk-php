<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Units;

use Hitmeister\Component\Api\Endpoints\Units\Find;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class FindTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\Units
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class FindTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$find = new Find($this->transport);
		$this->assertEquals(['id_offer', 'id_item', 'ean', 'embedded', 'limit', 'offset'], $find->getParamWhiteList());
		$this->assertEquals('GET', $find->getMethod());
		$this->assertEquals('units/seller/', $find->getURI());
	}
}