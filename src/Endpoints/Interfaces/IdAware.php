<?php

namespace Hitmeister\Component\Api\Endpoints\Interfaces;

interface IdAware
{
	/**
	 * @param int $id
	 */
	public function setId($id);

	/**
	 * @return int
	 */
	public function getId();
}