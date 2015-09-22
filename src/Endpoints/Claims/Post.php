<?php

namespace Hitmeister\Component\Api\Endpoints\Claims;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Transfers\ClaimAddTransfer;

/**
 * Class Post
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Claims
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Post extends AbstractEndpoint
{
	/** @var ClaimAddTransfer */
	private $transfer;

	/**
	 * @param ClaimAddTransfer $transfer
	 */
	public function setTransfer(ClaimAddTransfer $transfer)
	{
		$this->transfer = $transfer;
	}

	/**
	 * @return ClaimAddTransfer
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
		return 'claims/';
	}
}