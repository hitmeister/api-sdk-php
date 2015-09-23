<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Cursor;
use Hitmeister\Component\Api\Endpoints\Subscriptions\Delete;
use Hitmeister\Component\Api\Endpoints\Subscriptions\Find;
use Hitmeister\Component\Api\Endpoints\Subscriptions\Get;
use Hitmeister\Component\Api\Endpoints\Subscriptions\Post;
use Hitmeister\Component\Api\Endpoints\Subscriptions\Update;
use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\FindBuilder;
use Hitmeister\Component\Api\Helper\Response;
use Hitmeister\Component\Api\Namespaces\Traits\PerformWithId;
use Hitmeister\Component\Api\Transfers\SubscriptionAddTransfer;
use Hitmeister\Component\Api\Transfers\SubscriptionTransfer;
use Hitmeister\Component\Api\Transfers\SubscriptionUpdateTransfer;

/**
 * Class SubscriptionsNamespace
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class SubscriptionsNamespace extends AbstractNamespace
{
	use PerformWithId;

	/**
	 * @param string $eventName
	 * @param int    $limit
	 * @param int    $offset
	 * @return Cursor|SubscriptionTransfer[]
	 */
	public function find($eventName = null, $limit = 30, $offset = 0)
	{
		return $this->buildFind()
			->addParam('event_name', $eventName)
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
		return new FindBuilder($endpoint, '\Hitmeister\Component\Api\Transfers\SubscriptionTransfer');
	}

	/**
	 * @param int $id
	 * @return SubscriptionTransfer|null
	 */
	public function get($id)
	{
		$endpoint = new Get($this->getTransport());
		$result = $this->performWithId($endpoint, $id);
		return $result ? SubscriptionTransfer::make($result) : null;
	}

	/**
	 * @param string $eventName
	 * @param string $callbackUrl
	 * @param string $fallbackEmail
	 * @return int
	 */
	public function post($eventName, $callbackUrl, $fallbackEmail)
	{
		$data = new SubscriptionAddTransfer();
		$data->event_name = $eventName;
		$data->callback_url = $callbackUrl;
		$data->fallback_email = $fallbackEmail;

		$endpoint = new Post($this->getTransport());
		$endpoint->setTransfer($data);

		$resultRequest = $endpoint->performRequest();

		return Response::extractId($resultRequest, '/subscriptions/%d/');
	}

	/**
	 * @param int    $id
	 * @param string $eventName
	 * @param string $callbackUrl
	 * @param string $fallbackEmail
	 * @param bool   $isActive
	 * @return bool
	 */
	public function update($id, $eventName = null, $callbackUrl = null, $fallbackEmail = null, $isActive = null)
	{
		$data = new SubscriptionUpdateTransfer();
		if (null !== $eventName) {
			$data->event_name = $eventName;
		}
		if (null !== $callbackUrl) {
			$data->callback_url = $callbackUrl;
		}
		if (null !== $fallbackEmail) {
			$data->fallback_email = $fallbackEmail;
		}
		if (null !== $isActive) {
			$data->is_active = (bool)$isActive;
		}

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