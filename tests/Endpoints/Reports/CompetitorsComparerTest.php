<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Reports;

use Hitmeister\Component\Api\Endpoints\Reports\CompetitorsComparer;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class CompetitorsComparerTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\Reports
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class CompetitorsComparerTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$post = new CompetitorsComparer($this->transport);
		$this->assertEquals([], $post->getParamWhiteList());
		$this->assertEquals('POST', $post->getMethod());
		$this->assertEquals('reports/competitors-comparer/', $post->getURI());
	}
}