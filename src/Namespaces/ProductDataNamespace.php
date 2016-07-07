<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Endpoints\ProductData\Delete;
use Hitmeister\Component\Api\Endpoints\ProductData\Get;
use Hitmeister\Component\Api\Endpoints\ProductData\Upsert;
use Hitmeister\Component\Api\Endpoints\ProductData\Update;
use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Namespaces\Traits\PerformWithId;
use Hitmeister\Component\Api\Transfers\ProductDataTransfer;

/**
 * Class ProductDataNamespace
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Namespaces
 * @author   Julian Ecknig <julian.ecknig@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ProductDataNamespace extends AbstractNamespace
{
	use PerformWithId;

	/**
	 * @param string $ean
	 *
	 * @return ProductDataTransfer|null
	 */
	public function get($ean)
	{
		$endpoint = new Get($this->getTransport());
		$result = $this->performWithId($endpoint, $ean);
		
		return $result ? ProductDataTransfer::make($result) : null;
	}

	/**
	 * @param string              $ean
	 * @param ProductDataTransfer $data
	 *
	 * @return string
	 * @throws \Hitmeister\Component\Api\Exceptions\ServerException
	 */
	public function upsert($ean, ProductDataTransfer $data)
	{
		$endpoint = new Upsert($this->getTransport());
		$endpoint->setId($ean);
		$endpoint->setTransfer($data);

		$resultRequest = $endpoint->performRequest();

		return $resultRequest['status'] == 201;
	}

	/**
	 * @param string              $id
	 * @param ProductDataTransfer $data
	 *
	 * @return bool
	 */
	public function update($id, ProductDataTransfer $data)
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
	 * @param string $ean
	 * 
	 * @return bool
	 */
	public function delete($ean)
	{
		$endpoint = new Delete($this->getTransport());
		$endpoint->setId($ean);

		$result = $endpoint->performRequest();

		return $result['status'] == 204;
	}
}