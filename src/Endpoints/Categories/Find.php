<?php

namespace Hitmeister\Component\Api\Endpoints\Categories;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;

class Find extends AbstractEndpoint
{
	/**
	 * {@inheritdoc}
	 */
	public function getParamWhiteList()
	{
		return ['q', 'id_parent', 'limit', 'offset'];
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
		return 'categories/';
	}
}