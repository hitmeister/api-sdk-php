<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\ShippingGroups;

use Hitmeister\Component\Api\Endpoints\ShippingGroups\Find;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class FindTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\ShippingGroups
 * @author   Alex Litvinenko <alex.litvinenko@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class FindTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$find = new Find($this->transport);
		$this->assertEquals(['limit', 'offset'], $find->getParamWhiteList());
		$this->assertEquals('GET', $find->getMethod());
		$this->assertEquals('shipping-groups/seller/', $find->getURI());
	}
}