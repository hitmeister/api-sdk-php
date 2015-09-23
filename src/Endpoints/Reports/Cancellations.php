<?php

namespace Hitmeister\Component\Api\Endpoints\Reports;

/**
 * Class Cancellations
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Reports
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Cancellations extends Post
{
	/**
	 * {@inheritdoc}
	 */
	public function getURI()
	{
		return 'reports/cancellations/';
	}
}