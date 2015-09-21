<?php

namespace Hitmeister\Component\Api\Endpoints\ClaimMessages;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
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
	/** @var ClaimMessageAddTransfer */
	private $transfer;

	/**
	 * @param ClaimMessageAddTransfer $transfer
	 */
	public function setTransfer(ClaimMessageAddTransfer $transfer)
	{
		$this->transfer = $transfer;
	}

	/**
	 * @return ClaimMessageAddTransfer
	 */
	public function getTransfer()
	{
		return $this->transfer;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getBody()
	{
		return $this->transfer->toArray();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getParamWhiteList()
	{
		return [];
	}

	/**
	 * {@inheritdoc}
	 */
	public function getMethod()
	{
		return 'POST';
	}

	/**
	 * {@inheritdoc}
	 */
	public function getURI()
	{
		return 'claim-messages/';
	}
}