<?php

namespace Hitmeister\Component\Api\Endpoints\Reports;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Traits\RequestPost;

/**
 * Class PostVersion
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Reports
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
abstract class PostVersion extends AbstractEndpoint
{
	use RequestPost;

	/**
	 * @return array
	 */
	public function getParamWhiteList()
	{
		return ['version'];
	}
}