<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Transport\Transport;

/**
 * Class AbstractNamespace
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
abstract class AbstractNamespace
{
	/** @var Transport */
	private $transport;

	/**
	 * @param Transport $transport
	 */
	public function __construct(Transport $transport)
	{
		$this->transport = $transport;
	}

	/**
	 * @return Transport
	 */
	public function getTransport()
	{
		return $this->transport;
	}
}