<?php

namespace Hitmeister\Component\Api\Endpoints\Reports;

class EansNotFound extends Post
{
	/**
	 * {@inheritdoc}
	 */
	public function getURI()
	{
		return 'reports/eans-not-found/';
	}
}