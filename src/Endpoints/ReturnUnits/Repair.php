<?php

namespace Hitmeister\Component\Api\Endpoints\ReturnUnits;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Interfaces\IdAware;
use Hitmeister\Component\Api\Endpoints\Traits\EmptyParamWhiteList;
use Hitmeister\Component\Api\Endpoints\Traits\RequestPatch;
use Hitmeister\Component\Api\Endpoints\Traits\UriPatternId;

/**
 * Class Repair
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\ReturnUnits
 * @author   Philipp Schreiber <philipp.schreiber@real-digital.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Repair extends AbstractEndpoint implements IdAware
{
    use RequestPatch;
    use UriPatternId;
    use EmptyParamWhiteList;

	/**
	 * {@inheritdoc}
	 */
	protected function getUriPattern()
	{
		return 'return-units/%d/repair/';
	}
}
