<?php

namespace Hitmeister\Component\Api\Endpoints\Categories;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Traits\RequestGet;

class Find extends AbstractEndpoint
{
	use RequestGet;

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
	public function getURI()
	{
		return 'categories/';
	}

	/**
	 * {@inheritdoc}
	 */
	public function getApiLimit()
	{
		return 1000;
	}
}