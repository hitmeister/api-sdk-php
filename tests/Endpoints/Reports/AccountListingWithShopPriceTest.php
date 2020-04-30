<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Reports;

use Hitmeister\Component\Api\Endpoints\Reports\AccountListingWithShopPrice;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class AccountListingWithShopPriceTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$post = new AccountListingWithShopPrice($this->transport);
		$this->assertEquals([], $post->getParamWhiteList());
		$this->assertEquals('POST', $post->getMethod());
		$this->assertEquals('reports/account-listing-with-shop-price/', $post->getURI());
	}
}
