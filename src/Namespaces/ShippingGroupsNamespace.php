<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Cursor;
use Hitmeister\Component\Api\Endpoints\ShippingGroups\Find;
use Hitmeister\Component\Api\FindBuilder;
use Hitmeister\Component\Api\Namespaces\Traits\PerformWithId;
use Hitmeister\Component\Api\Transfers\ShippingGroupTransfer;

/**
 * Class ShippingGroupsNamespace
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Namespaces
 * @author   Alex Litvinenko <alex.litvinenko@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ShippingGroupsNamespace extends AbstractNamespace
{
	use PerformWithId;

	/**
	 * @param int $limit
	 * @param int $offset
	 *
	 * @return Cursor|ShippingGroupTransfer[]
	 */
	public function find($limit = 20, $offset = 0) {
		return $this->buildFind()
			->setLimit($limit)
			->setOffset($offset)
			->find();
	}

	/**
	 * @return FindBuilder
	 */
	public function buildFind()
	{
		$endpoint = new Find($this->getTransport());
		return new FindBuilder($endpoint, '\Hitmeister\Component\Api\Transfers\ShippingGroupTransfer');
	}
}