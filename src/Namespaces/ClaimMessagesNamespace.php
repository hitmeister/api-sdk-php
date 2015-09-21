<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Cursor;
use Hitmeister\Component\Api\Endpoints\ClaimMessages\Find;
use Hitmeister\Component\Api\Endpoints\ClaimMessages\Get;
use Hitmeister\Component\Api\Endpoints\ClaimMessages\Post;
use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Helper\Request;
use Hitmeister\Component\Api\Helper\Response;
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
	public function find($dateTimeFrom = null, $limit = null, $offset = 0)
	{
		$params = [];

		if (null !== ($dateTimeFrom = Request::formatDateTime($dateTimeFrom))) {
			$params['timestamp_from'] = $dateTimeFrom;
		}
		if (null !== $limit) {
			$params['limit'] = $limit;
		}
		if (null !== $offset) {
			$params['offset'] = $offset;
		}

		$endpoint = new Find($this->getTransport());
		$endpoint->setParams($params);

		return new Cursor($endpoint, '\Hitmeister\Component\Api\Transfers\ClaimMessageTransfer');
	}

	/**
	 * @param int $id
	 * @return ClaimMessageTransfer|null
	 */
	public function get($id)
	{
		$endpoint = new Get($this->getTransport());
		$endpoint->setId($id);

		try {
			$result = $endpoint->performRequest();
		} catch (ResourceNotFoundException $e) {
			return null;
		}

		Response::checkBody($result);
		return ClaimMessageTransfer::make($result['json']);
	}
}