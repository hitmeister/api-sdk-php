<?php

namespace Hitmeister\Component\Api\Endpoints\Returns;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Interfaces\IdAware;
use Hitmeister\Component\Api\Transfers\OrderUnitReturnTransfer;
use Hitmeister\Component\Api\Endpoints\Traits\UriPatternId;
use Hitmeister\Component\Api\Endpoints\Traits\RequestPut;
use Hitmeister\Component\Api\Endpoints\Traits\EmptyParamWhiteList;
use Hitmeister\Component\Api\Endpoints\Traits\BodyTransfer;

class Upsert extends AbstractEndpoint implements IdAware
{
	use UriPatternId;
	use RequestPut;
	use EmptyParamWhiteList;
	use BodyTransfer;

	public function setTransfer(OrderUnitReturnTransfer $transfer)
	{
		$this->transfer = $transfer;
	}
	/**
	 * {@inheritdoc}
	 */
	protected function getUriPattern()
	{
		return 'returns/%d/';
	}
}
