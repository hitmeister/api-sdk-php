<?php

namespace Hitmeister\Component\Api\Endpoints\Items;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Exceptions\RuntimeException;

/**
 * Class Get
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Items
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Get extends AbstractEndpoint
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
		return ['embedded'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function getMethod()
	{
		return 'GET';
	}

	/**
	 * {@inheritdoc}
	 */
	public function getURI()
	{
		if (empty($this->id)) {
			throw new RuntimeException('Required params id is not set');
		}
		return sprintf('items/%d/', $this->id);
	}
}