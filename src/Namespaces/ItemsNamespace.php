<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Cursor;
use Hitmeister\Component\Api\Endpoints\Items\Find;
use Hitmeister\Component\Api\Endpoints\Items\Get;
use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\FindBuilder;
use Hitmeister\Component\Api\Helper\Response;
use Hitmeister\Component\Api\Transfers\ItemWithEmbeddedTransfer;

/**
 * Class ItemsNamespace
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ItemsNamespace extends AbstractNamespace
{
	/**
	 * @param string $q
	 * @param array  $embedded
	 * @param int    $limit
	 * @param int    $offset
	 * @return Cursor|ItemWithEmbeddedTransfer[]
	 */
	public function find($q, $embedded = null, $limit = 30, $offset = 0)
	{
		return $this->buildFind()
			->addParam('q', $q)
			->addParam('embedded', $embedded)
			->setLimit($limit)
			->setOffset($offset)
			->find();
	}

	/**
	 * @param string $ean
	 * @param array  $embedded
	 * @param int    $limit
	 * @param int    $offset
	 * @return Cursor|ItemWithEmbeddedTransfer[]
	 */
	public function findByEan($ean, $embedded = null, $limit = 30, $offset = 0)
	{
		return $this->buildFind()
			->addParam('ean', $ean)
			->addParam('embedded', $embedded)
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
		return new FindBuilder($endpoint, '\Hitmeister\Component\Api\Transfers\ItemWithEmbeddedTransfer');
	}

	/**
	 * @param int   $id
	 * @param array $embedded
	 * @return ItemWithEmbeddedTransfer|null
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
		} catch (ResourceNotFoundException $e) {
			return null;
		}

		Response::checkBody($result);
		return ItemWithEmbeddedTransfer::make($result['json']);
	}
}