<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Endpoints\Categories\Decide;
use Hitmeister\Component\Api\Endpoints\Categories\Get;
use Hitmeister\Component\Api\Exceptions\InvalidArgumentException;
use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Helper\Response;
use Hitmeister\Component\Api\Transfers\CategoryDecideTransfer;
use Hitmeister\Component\Api\Transfers\CategoryTransfer;
use Hitmeister\Component\Api\Transfers\CategoryWithEmbeddedTransfer;

/**
 * Class CategoriesNamespace
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class CategoriesNamespace extends AbstractNamespace
{
	/**
	 * @param array|CategoryDecideTransfer $data
	 * @return array|CategoryTransfer[]
	 */
	public function decide($data)
	{
		if (!$data instanceof CategoryDecideTransfer) {
			if (!is_array($data)) {
				throw new InvalidArgumentException('Data argument should be an array of instance of CategoryDecideTransfer');
			}
			$data = CategoryDecideTransfer::make($data);
		}

		$endpoint = new Decide($this->getTransport());
		$endpoint->setTransfer($data);

		$resultRequest = $endpoint->performRequest();
		Response::checkBody($resultRequest, $endpoint);

		$result = [];
		foreach($resultRequest['json'] as $item) {
			$result[] = CategoryTransfer::make($item);
		}

		return $result;
	}

	/**
	 * @param int   $id
	 * @param array $embedded
	 * @return CategoryWithEmbeddedTransfer|null
	 */
	public function get($id, array $embedded = [])
	{
		$endpoint = new Get($this->getTransport());
		$endpoint->setId($id);

		// Ask for embedded fields
		if (!empty($embedded)) {
			$endpoint->setParams([
				'embedded' => $embedded,
			]);
		}

		try {
			$result = $endpoint->performRequest();
		} catch(ResourceNotFoundException $e) {
			return null;
		}

		Response::checkBody($result, $endpoint);
		return CategoryWithEmbeddedTransfer::make($result['json']);
	}
}