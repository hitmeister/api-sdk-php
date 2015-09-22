<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Cursor;
use Hitmeister\Component\Api\Endpoints\Orders\Find;
use Hitmeister\Component\Api\Endpoints\Orders\Get;
use Hitmeister\Component\Api\FindBuilder;
use Hitmeister\Component\Api\Namespaces\Traits\PerformWithId;
use Hitmeister\Component\Api\Transfers\OrderSellerTransfer;
use Hitmeister\Component\Api\Transfers\OrderWithEmbeddedTransfer;

/**
 * Class OrdersNamespace
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class OrdersNamespace extends AbstractNamespace
{
	use PerformWithId;

	/**
	 * @param \DateTime|int|string $dateTimeFrom
	 * @param int                  $limit
	 * @param int                  $offset
	 * @return Cursor|OrderSellerTransfer[]
	 */
	public function find($dateTimeFrom = null, $limit = 30, $offset = 0)
	{
		return $this->buildFind()
			->addDateTimeParam('ts_created:from', $dateTimeFrom)
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
		return new FindBuilder($endpoint, '\Hitmeister\Component\Api\Transfers\OrderSellerTransfer');
	}

	/**
	 * @param int   $id
	 * @param array $embedded
	 * @return OrderWithEmbeddedTransfer|null
	 */
	public function get($id, array $embedded = [])
	{
		$endpoint = new Get($this->getTransport());

		// Ask for embedded fields
		if (!empty($embedded)) {
			$endpoint->setParams([
				'embedded' => $embedded,
			]);
		}

		$result = $this->performWithId($endpoint, $id);
		return $result ? OrderWithEmbeddedTransfer::make($result) : null;
	}
}