<?php

namespace Hitmeister\Component\Api\Endpoints\Units;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Interfaces\IdAware;
use Hitmeister\Component\Api\Endpoints\Traits\EmptyParamWhiteList;
use Hitmeister\Component\Api\Endpoints\Traits\RequestDelete;
use Hitmeister\Component\Api\Endpoints\Traits\UriPatternId;

/**
 * Class Delete
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Units
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Delete extends AbstractEndpoint implements IdAware
{
	use RequestDelete;
	use UriPatternId;
	use EmptyParamWhiteList;

	/**
	 * {@inheritdoc}
	 */
	protected function getUriPattern()
	{
		return 'units/%d/';
	}
}