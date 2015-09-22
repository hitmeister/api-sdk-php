<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Cursor;
use Hitmeister\Component\Api\Endpoints\Categories\Decide;
use Hitmeister\Component\Api\Endpoints\Categories\Find;
use Hitmeister\Component\Api\Endpoints\Categories\Get;
use Hitmeister\Component\Api\Exceptions\InvalidArgumentException;
use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\FindBuilder;
use Hitmeister\Component\Api\Helper\Response;
use Hitmeister\Component\Api\Namespaces\Traits\PerformWithId;
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
	use PerformWithId;

	/**
	 * @param string $q
	 * @param int    $idParent
	 * @param int    $limit
	 * @param int    $offset
	 * @return Cursor|CategoryTransfer[]
	 */
	public function find($q = null, $idParent = null, $limit = 100, $offset = 0)
	{
		return $this->buildFind()
			->addParam('q', $q)
			->addParam('id_parent', $idParent)
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
		return new FindBuilder($endpoint, '\Hitmeister\Component\Api\Transfers\CategoryTransfer');
	}

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
		Response::checkBody($resultRequest);

		$result = [];
		foreach ($resultRequest['json'] as $item) {
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

		// Ask for embedded fields
		if (!empty($embedded)) {
			$endpoint->setParams([
				'embedded' => $embedded,
			]);
		}

		$result = $this->performWithId($endpoint, $id);
		return $result ? CategoryWithEmbeddedTransfer::make($result) : null;
	}
}