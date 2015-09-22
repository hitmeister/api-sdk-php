<?php

namespace Hitmeister\Component\Api\Endpoints\Claims;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Exceptions\RuntimeException;

/**
 * Class Close
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Claims
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Close extends AbstractEndpoint
{
	/** @var  */
	private $id;

	/**
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = (int)$id;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
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
		return 'PATCH';
	}

	/**
	 * {@inheritdoc}
	 */
	public function getURI()
	{
		if (empty($this->id)) {
			throw new RuntimeException('Required params id is not set');
		}
		return sprintf('claims/%d/close/', $this->id);
	}
}