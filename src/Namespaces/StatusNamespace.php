<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Endpoints\Status\Ping;
use Hitmeister\Component\Api\Helper\Response;
use Hitmeister\Component\Api\Transfers\StatusPingTransfer;

/**
 * Class StatusNamespace
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class StatusNamespace extends AbstractNamespace
{
	/**
	 * @return StatusPingTransfer
	 */
	public function ping()
	{
		$endpoint = new Ping($this->getTransport());
		$result = $endpoint->performRequest();

		Response::checkBody($result);
		return StatusPingTransfer::make($result['json']);
	}
}