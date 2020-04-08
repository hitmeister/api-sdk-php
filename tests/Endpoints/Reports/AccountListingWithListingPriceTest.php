<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Reports;

use Hitmeister\Component\Api\Endpoints\Reports\AccountListingWithListingPrice;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class AccountListingWithListingPriceTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$post = new AccountListingWithListingPrice($this->transport);
		$this->assertEquals([], $post->getParamWhiteList());
		$this->assertEquals('POST', $post->getMethod());
		$this->assertEquals('reports/account-listing-with-listing-price/', $post->getURI());
	}
}
