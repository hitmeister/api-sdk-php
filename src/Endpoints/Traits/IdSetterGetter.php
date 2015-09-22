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
	/** @var int|string */
	protected $id;

	/**
	 * @param int|string $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return int|string
	 */
	public function getId()
	{
		return $this->id;
	}
}