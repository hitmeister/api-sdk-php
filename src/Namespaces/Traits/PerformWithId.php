<?php

namespace Hitmeister\Component\Api\Namespaces\Traits;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Interfaces\IdAware;
use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Helper\Response;

/**
 * Class PerformWithId
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Namespaces\Traits
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
trait PerformWithId
{
	/**
	 * @param AbstractEndpoint $endpoint
	 * @param int              $id
	 * @return array|null
	 */
	protected function performWithId(AbstractEndpoint $endpoint, $id)
	{
		if ($endpoint instanceof IdAware) {
			$endpoint->setId($id);
		}

		try {
			$result = $endpoint->performRequest();
		} catch (ResourceNotFoundException $e) {
			return null;
		}

		Response::checkBody($result);
		return $result['json'];
	}
}