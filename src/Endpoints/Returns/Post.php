<?php

namespace Hitmeister\Component\Api\Endpoints\Returns;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Traits\BodyTransfer;
use Hitmeister\Component\Api\Endpoints\Traits\EmptyParamWhiteList;
use Hitmeister\Component\Api\Endpoints\Traits\RequestPost;
use Hitmeister\Component\Api\Transfers\OrderUnitReturnTransfer;

class Post extends AbstractEndpoint
{
	use RequestPost;
	use EmptyParamWhiteList;
	use BodyTransfer;

	public function setTransfer(OrderUnitReturnTransfer $transfer)
	{
		$this->transfer = $transfer;
	}

	public function getURI()
	{
		return 'returns/';
	}
}
