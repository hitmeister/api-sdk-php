<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Cursor;
use Hitmeister\Component\Api\Endpoints\ImportFiles\Find;
use Hitmeister\Component\Api\Endpoints\ImportFiles\Get;
use Hitmeister\Component\Api\Endpoints\ImportFiles\Post;
use Hitmeister\Component\Api\FindBuilder;
use Hitmeister\Component\Api\Helper\Response;
use Hitmeister\Component\Api\Namespaces\Traits\PerformWithId;
use Hitmeister\Component\Api\Transfers\ImportFileAddTransfer;
use Hitmeister\Component\Api\Transfers\ImportFileTransfer;

/**
 * Class ImportFilesNamespace
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ImportFilesNamespace extends AbstractNamespace
{
	use PerformWithId;

	/**
	 * @param string $url
	 * @param string $type
	 * @return int
	 */
	public function post($url, $type = 'COMMAND')
	{
		$data = new ImportFileAddTransfer();
		$data->uri = $url;
		$data->type = $type;

		$endpoint = new Post($this->getTransport());
		$endpoint->setTransfer($data);

		$resultRequest = $endpoint->performRequest();

		return Response::extractId($resultRequest, '/import-files/%d/');
	}

	/**
	 * @param string[]             $status
	 * @param string[]             $type
	 * @param \DateTime|int|string $createdFrom
	 * @param \DateTime|int|string $updatedFrom
	 * @param string               $sort
	 * @param int                  $limit
	 * @param int                  $offset
	 * @return Cursor|ImportFileTransfer[]
	 */
	public function find(
		$status = null,
		$type = null,
		$createdFrom = null,
		$updatedFrom = null,
		$sort = 'ts_created:desc',
		$limit = 30,
		$offset = 0
	) {
		return $this->buildFind()
			->addParam('status', $status)
			->addParam('type', $type)
			->addDateTimeParam('ts_created:from', $createdFrom)
			->addDateTimeParam('ts_updated:from', $updatedFrom)
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
		return new FindBuilder($endpoint, '\Hitmeister\Component\Api\Transfers\ImportFileTransfer');
	}

	/**
	 * @param int $id
	 * @return ImportFileTransfer|null
	 */
	public function get($id)
	{
		$endpoint = new Get($this->getTransport());
		$result = $this->performWithId($endpoint, $id);
		return $result ? ImportFileTransfer::make($result) : null;
	}
}