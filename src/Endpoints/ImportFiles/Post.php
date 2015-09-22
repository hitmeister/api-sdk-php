<?php

namespace Hitmeister\Component\Api\Endpoints\ImportFiles;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Transfers\ImportFileAddTransfer;

/**
 * Class Post
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\ImportFiles
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Post extends AbstractEndpoint
{
	/** @var ImportFileAddTransfer */
	private $transfer;

	/**
	 * @param ImportFileAddTransfer $transfer
	 */
	public function setTransfer(ImportFileAddTransfer $transfer)
	{
		$this->transfer = $transfer;
	}

	/**
	 * @return ImportFileAddTransfer
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
		return 'import-files/';
	}
}