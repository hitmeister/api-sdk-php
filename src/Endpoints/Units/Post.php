<?php

namespace Hitmeister\Component\Api\Endpoints\Units;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Traits\BodyTransfer;
use Hitmeister\Component\Api\Endpoints\Traits\EmptyParamWhiteList;
use Hitmeister\Component\Api\Endpoints\Traits\RequestPost;
use Hitmeister\Component\Api\Transfers\UnitAddTransfer;

/**
 * Class Post
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Units
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Post extends AbstractEndpoint
{
	use RequestPost;
	use EmptyParamWhiteList;
	use BodyTransfer;

	/**
	 * @param UnitAddTransfer $transfer
	 */
	public function setTransfer(UnitAddTransfer $transfer)
	{
		$this->transfer = $transfer;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getURI()
	{
		return 'units/';
	}
}