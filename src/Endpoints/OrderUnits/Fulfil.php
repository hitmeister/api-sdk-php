<?php

namespace Hitmeister\Component\Api\Endpoints\OrderUnits;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Interfaces\IdAware;
use Hitmeister\Component\Api\Endpoints\Traits\EmptyParamWhiteList;
use Hitmeister\Component\Api\Endpoints\Traits\RequestPatch;
use Hitmeister\Component\Api\Endpoints\Traits\UriPatternId;

/**
 * Class Fulfil
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\OrderUnits
 * @author   Oleksandr Dombrovskyi <oleksandr.dombrovskyi@real-digital.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Fulfil extends AbstractEndpoint implements IdAware
{
	use RequestPatch;
	use UriPatternId;
	use EmptyParamWhiteList;

	/**
	 * {@inheritdoc}
	 */
	protected function getUriPattern()
	{
		return 'order-units/%d/fulfil/';
	}
}