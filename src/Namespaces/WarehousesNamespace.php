<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Cursor;
use Hitmeister\Component\Api\Endpoints\Warehouses\Delete;
use Hitmeister\Component\Api\Endpoints\Warehouses\Find;
use Hitmeister\Component\Api\Endpoints\Warehouses\Get;
use Hitmeister\Component\Api\Endpoints\Warehouses\Post;
use Hitmeister\Component\Api\Endpoints\Warehouses\Update;
use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\FindBuilder;
use Hitmeister\Component\Api\Helper\Response;
use Hitmeister\Component\Api\Namespaces\Traits\PerformWithId;
use Hitmeister\Component\Api\Transfers\WarehouseAddTransfer;
use Hitmeister\Component\Api\Transfers\WarehouseTransfer;
use Hitmeister\Component\Api\Transfers\WarehouseUpdateTransfer;

/**
 * Class WarehousesNamespace
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Namespaces
 * @author   Alex Litvinenko <alex.litvinenko@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class WarehousesNamespace extends AbstractNamespace
{
	use PerformWithId;

	/**
	 * @param int $limit
	 * @param int $offset
	 *
	 * @return Cursor|WarehouseTransfer[]
	 */
	public function find($limit = 20, $offset = 0)
	{
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
		return new FindBuilder($endpoint, '\Hitmeister\Component\Api\Transfers\WarehouseTransfer');
	}

	/**
	 * @param int $id
	 * @return WarehouseTransfer|null
	 */
	public function get($id)
	{
		$endpoint = new Get($this->getTransport());
		$result = $this->performWithId($endpoint, $id);
		return $result ? WarehouseTransfer::make($result) : null;
	}

	/**
	 * @param WarehouseAddTransfer $data
	 *
	 * @return int
	 * @throws \Hitmeister\Component\Api\Exceptions\ServerException
	 *
	 */
	public function post(WarehouseAddTransfer $data)
	{
		$endpoint = new Post($this->getTransport());
		$endpoint->setTransfer($data);

		$resultRequest = $endpoint->performRequest();

		return Response::extractId($resultRequest, '/warehouses/%d/');
	}

	/**
	 * @param int                     $id
	 * @param WarehouseUpdateTransfer $data
	 *
	 * @return bool
	 */
	public function update($id, WarehouseUpdateTransfer $data)
	{
		$endpoint = new Update($this->getTransport());
		$endpoint->setId($id);
		$endpoint->setTransfer($data);

		try {
			$result = $endpoint->performRequest();
		} catch (ResourceNotFoundException $e) {
			return false;
		}

		return $result['status'] == 204;
	}

	/**
	 * @param int $id
	 * @return bool
	 */
	public function delete($id)
	{
		$endpoint = new Delete($this->getTransport());
		$endpoint->setId($id);

		try {
			$result = $endpoint->performRequest();
		} catch (ResourceNotFoundException $e) {
			return false;
		}

		return $result['status'] == 204;
	}
}