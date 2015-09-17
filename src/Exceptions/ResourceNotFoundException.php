<?php

namespace Hitmeister\Component\Api\Exceptions;

/**
 * Class ResourceNotFoundException
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Exceptions
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ResourceNotFoundException extends BadRequestException
{
	public function __construct($message = 'Resource not found', \Exception $previous = null)
	{
		parent::__construct($message, 404, $previous);
	}
}