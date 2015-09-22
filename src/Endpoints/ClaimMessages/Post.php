<?php

namespace Hitmeister\Component\Api\Endpoints\ClaimMessages;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Traits\BodyTransfer;
use Hitmeister\Component\Api\Endpoints\Traits\EmptyParamWhiteList;
use Hitmeister\Component\Api\Endpoints\Traits\RequestPost;
use Hitmeister\Component\Api\Transfers\ClaimMessageAddTransfer;

/**
 * Class Post
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\ClaimMessages
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
	 * @param ClaimMessageAddTransfer $transfer
	 */
	public function setTransfer(ClaimMessageAddTransfer $transfer)
	{
		$this->transfer = $transfer;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getURI()
	{
		return 'claim-messages/';
	}
}