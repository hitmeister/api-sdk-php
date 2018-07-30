<?php

namespace Hitmeister\Component\Api\Endpoints\ProductData;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Interfaces\IdAware;
use Hitmeister\Component\Api\Endpoints\Traits\BodyTransfer;
use Hitmeister\Component\Api\Endpoints\Traits\EmptyParamWhiteList;
use Hitmeister\Component\Api\Endpoints\Traits\RequestPatch;
use Hitmeister\Component\Api\Endpoints\Traits\RequestPut;
use Hitmeister\Component\Api\Endpoints\Traits\UriPatternId;
use Hitmeister\Component\Api\Transfers\ProductDataTransfer;

/**
 * Class Upsert
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\ProductData
 * @author   Alex Litvinenko <alex.litvinenko@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Upsert extends AbstractEndpoint implements IdAware
{
	use RequestPut;
	use UriPatternId;
	use EmptyParamWhiteList;
	use BodyTransfer;

	/**
	 * @param ProductDataTransfer $transfer
	 */
	public function setTransfer(ProductDataTransfer $transfer)
	{
		$this->transfer = $transfer;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getUriPattern()
	{
		return 'product-data/%s/';
	}
}
