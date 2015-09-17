<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Endpoints\Categories\Get;
use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Helper\Response;
use Hitmeister\Component\Api\Transfers\CategoryWithEmbeddedTransfer;

/**
 * Class CategoriesNamespace

 *
*@category PHP-SDK
 * @package  Hitmeister\Component\Api\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class CategoriesNamespace extends AbstractNamespace
{
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

		$transfer = new CategoryWithEmbeddedTransfer();
		$transfer->fromArray($result['json']);

		return $transfer;
	}
}