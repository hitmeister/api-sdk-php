<?php

namespace Hitmeister\Component\Api\Endpoints\Reports;

/**
 * Class AccountListing
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Reports
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class AccountListing extends Post
{
	/**
	 * {@inheritdoc}
	 */
	public function getURI()
	{
		return 'reports/account-listing/';
	}
}