<?php

namespace Hitmeister\Component\Api\Endpoints\Reports;

class ProductDataChanges extends Post
{
	/**
	 * {@inheritdoc}
	 */
	public function getURI()
	{
		return 'reports/product-data-changes/';
	}
}