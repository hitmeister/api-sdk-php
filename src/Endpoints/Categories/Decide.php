<?php

namespace Hitmeister\Component\Api\Endpoints\Categories;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Transfers\CategoryDecideTransfer;

class Decide extends AbstractEndpoint
{
	/** @var CategoryDecideTransfer */
	private $transfer;

	/**
	 * @param CategoryDecideTransfer $transfer
	 */
	public function setTransfer(CategoryDecideTransfer $transfer)
	{
		$this->transfer = $transfer;
	}

	/**
	 * @return CategoryDecideTransfer
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
		return 'categories/decide/';
	}
}