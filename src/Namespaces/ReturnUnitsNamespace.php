<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Cursor;
use Hitmeister\Component\Api\Endpoints\ReturnUnits\Accept;
use Hitmeister\Component\Api\Endpoints\ReturnUnits\Find;
use Hitmeister\Component\Api\Endpoints\ReturnUnits\Get;
use Hitmeister\Component\Api\Endpoints\ReturnUnits\Reject;
use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\FindBuilder;
use Hitmeister\Component\Api\Namespaces\Traits\PerformWithId;
use Hitmeister\Component\Api\Transfers\ReturnUnitRejectTransfer;
use Hitmeister\Component\Api\Transfers\ReturnUnitTransfer;
use Hitmeister\Component\Api\Transfers\ReturnUnitWithEmbeddedTransfer;

/**
 * Class ReturnUnitsNamespace
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ReturnUnitsNamespace extends AbstractNamespace
{
	use PerformWithId;

	/**
	 * @param string[]             $status
	 * @param \DateTime|int|string $createdFrom
	 * @param string               $sort
	 * @param int                  $limit
	 * @param int                  $offset
	 * @return Cursor|ReturnUnitTransfer[]
	 */
	public function find(
		$status = null,
		$createdFrom = null,
		$sort = 'ts_created:desc',
		$limit = 30,
		$offset = 0
	) {
		return $this->buildFind()
			->addParam('status', $status)
			->addDateTimeParam('ts_created:from', $createdFrom)
			->setSort($sort)
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
		return new FindBuilder($endpoint, '\Hitmeister\Component\Api\Transfers\ReturnUnitTransfer');
	}

	/**
	 * @param int   $id
	 * @param array $embedded
	 * @return ReturnUnitWithEmbeddedTransfer|null
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
		return $result ? ReturnUnitWithEmbeddedTransfer::make($result) : null;
	}

	/**
	 * @param int $id
	 * @return bool
	 */
	public function accept($id)
	{
		$endpoint = new Accept($this->getTransport());
		$endpoint->setId($id);

		try {
			$result = $endpoint->performRequest();
		} catch (ResourceNotFoundException $e) {
			return false;
		}

		return $result['status'] == 204;
	}

	/**
	 * @param int    $id
	 * @param string $message
	 * @return bool
	 */
	public function reject($id, $message)
	{
		$data = new ReturnUnitRejectTransfer();
		$data->message = $message;

		$endpoint = new Reject($this->getTransport());
		$endpoint->setId($id);
		$endpoint->setTransfer($data);

		try {
			$result = $endpoint->performRequest();
		} catch (ResourceNotFoundException $e) {
			return false;
		}

		return $result['status'] == 204;
	}
}