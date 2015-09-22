<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Cursor;
use Hitmeister\Component\Api\Endpoints\ClaimMessages\Find;
use Hitmeister\Component\Api\Endpoints\ClaimMessages\Get;
use Hitmeister\Component\Api\Endpoints\ClaimMessages\Post;
use Hitmeister\Component\Api\FindBuilder;
use Hitmeister\Component\Api\Helper\Response;
use Hitmeister\Component\Api\Namespaces\Traits\PerformWithId;
use Hitmeister\Component\Api\Transfers\ClaimMessageAddTransfer;
use Hitmeister\Component\Api\Transfers\ClaimMessageTransfer;

/**
 * Class ClaimMessagesNamespace
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ClaimMessagesNamespace extends AbstractNamespace
{
	use PerformWithId;

	/**
	 * @param int    $claimId
	 * @param string $text
	 * @return int
	 */
	public function post($claimId, $text)
	{
		$data = new ClaimMessageAddTransfer();
		$data->id_claim = (int)$claimId;
		$data->text = $text;

		$endpoint = new Post($this->getTransport());
		$endpoint->setTransfer($data);

		$resultRequest = $endpoint->performRequest();

		return Response::extractId($resultRequest, '/claim-messages/%d/');
	}

	/**
	 * @param \DateTime|int|string $dateTimeFrom
	 * @param int                  $limit
	 * @param int                  $offset
	 * @return Cursor|ClaimMessageTransfer[]
	 */
	public function find($dateTimeFrom = null, $limit = 30, $offset = 0)
	{
		return $this->buildFind()
			->addDateTimeParam('timestamp_from', $dateTimeFrom)
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
		return new FindBuilder($endpoint, '\Hitmeister\Component\Api\Transfers\ClaimMessageTransfer');
	}

	/**
	 * @param int $id
	 * @return ClaimMessageTransfer|null
	 */
	public function get($id)
	{
		$endpoint = new Get($this->getTransport());
		$result = $this->performWithId($endpoint, $id);
		return $result ? ClaimMessageTransfer::make($result) : null;
	}
}