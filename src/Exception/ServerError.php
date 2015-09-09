<?php
/**
 * Created for Hitmeister Project.
 * User: Maksim Naumov <maksim.naumov@hitmeister.de>
 * Date: 09/09/15
 * Time: 16:34
 */

namespace Hitmeister\Component\Api\Exception;

use GuzzleHttp\Exception\ServerException;
use Hitmeister\Component\Api\Exception;

class ServerError extends ServerException implements Exception
{

}