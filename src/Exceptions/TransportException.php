<?php

namespace Hitmeister\Component\Api\Exceptions;

/**
 * Class TransportException
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Exceptions
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class TransportException extends \Exception implements ApiException
{
    /** @var  string */
    protected $requestId = '';

    /**
     * @return string
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @param string $requestId
     */
    public function setRequestId($requestId)
    {
        $this->requestId = $requestId;
    }
}