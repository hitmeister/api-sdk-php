<?php

namespace Hitmeister\Component\Api\Endpoints\ReturnUnits;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Interfaces\IdAware;
use Hitmeister\Component\Api\Endpoints\Traits\BodyTransfer;
use Hitmeister\Component\Api\Endpoints\Traits\EmptyParamWhiteList;
use Hitmeister\Component\Api\Endpoints\Traits\RequestPatch;
use Hitmeister\Component\Api\Endpoints\Traits\UriPatternId;
use Hitmeister\Component\Api\Transfers\ReturnUnitRejectTransfer;

/**
 * Class Reject
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\ReturnUnits
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Reject extends AbstractEndpoint implements IdAware
{
	use RequestPatch;
	use UriPatternId;
	use EmptyParamWhiteList;
	use BodyTransfer;

	/**
	 * @param ReturnUnitRejectTransfer $transfer
	 */
	public function setTransfer(ReturnUnitRejectTransfer $transfer)
	{
		$this->transfer = $transfer;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getUriPattern()
	{
		return 'return-units/%d/reject/';
	}
}