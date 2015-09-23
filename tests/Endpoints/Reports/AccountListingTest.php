<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Reports;

use Hitmeister\Component\Api\Endpoints\Reports\AccountListing;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

class AccountListingTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		$post = new AccountListing($this->transport);
		$this->assertEquals([], $post->getParamWhiteList());
		$this->assertEquals('POST', $post->getMethod());
		$this->assertEquals('reports/account-listing/', $post->getURI());
	}
}