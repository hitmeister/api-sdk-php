<?php

namespace Hitmeister\Component\Api\Endpoints\Traits;

/**
 * Class IdSetterGetter
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Traits
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
trait IdSetterGetter
{
	/** @var */
	protected $id;

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
}