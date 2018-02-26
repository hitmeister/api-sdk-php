<?php

namespace Hitmeister\Component\Api\Exceptions;

/**
 * Class UnexpectedParamException
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Exceptions
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.real.de/api/v1/
 */
class UnexpectedParamException extends \UnexpectedValueException implements ApiException
{

}