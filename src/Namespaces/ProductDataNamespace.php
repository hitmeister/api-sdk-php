<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Endpoints\ProductData\Get;
use Hitmeister\Component\Api\Endpoints\ProductData\Put;
use Hitmeister\Component\Api\Endpoints\ProductData\Update;
use Hitmeister\Component\Api\Endpoints\ProductData\Delete;
use Hitmeister\Component\Api\Exceptions\InvalidArgumentException;
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
	 * @param string   $ean
	 * @return ProductDataTransfer|null
	 */
	public function get($ean)
	{
		$endpoint = new Get($this->getTransport());

		$result = $this->performWithId($endpoint, $ean);
		return $result ? ProductDataTransfer::make($result) : null;
	}

	/**
	 * @param string $ean
	 * @param array|ProductDataTransfer $data
	 * @return bool
	 */
	public function put($ean, $data)
	{
		if (!$data instanceof ProductDataTransfer) {
			if (!is_array($data)) {
				throw new InvalidArgumentException('Data argument should be an array or instance of ProductDataTransfer');
			}
			$data = ProductDataTransfer::make($data);
		}

		$endpoint = new Put($this->getTransport());
		$endpoint->setId($ean);
		$endpoint->setTransfer($data);

		$result = $endpoint->performRequest();

		$dStatus = $result['status'];
		return $dStatus == 204 || $dStatus == 201;
	}

	/**
	 * @param string $ean
	 * @param array|ProductDataTransfer $data
	 * @return bool
	 */
	public function update($ean, $data)
	{
		if (!$data instanceof ProductDataTransfer) {
			if (!is_array($data)) {
				throw new InvalidArgumentException('Data argument should be an array or instance of ProductDataTransfer');
			}
			$data = ProductDataTransfer::make($data);
		}

		$endpoint = new Update($this->getTransport());
		$endpoint->setId($ean);
		$endpoint->setTransfer($data);

		$result = $endpoint->performRequest();
		
		return $result['status'] == 204;
	}

	/**
	 * @param string $ean
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