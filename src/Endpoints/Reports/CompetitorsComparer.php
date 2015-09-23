<?php

namespace Hitmeister\Component\Api\Endpoints\Reports;

/**
 * Class CompetitorsComparer
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Reports
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class CompetitorsComparer extends Post
{
	/**
	 * {@inheritdoc}
	 */
	public function getURI()
	{
		return 'reports/competitors-comparer/';
	}
}