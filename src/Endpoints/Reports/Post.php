<?php

namespace Hitmeister\Component\Api\Endpoints\Reports;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Traits\EmptyParamWhiteList;
use Hitmeister\Component\Api\Endpoints\Traits\RequestPost;

/**
 * Class Post
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Reports
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
abstract class Post extends AbstractEndpoint
{
	use RequestPost;
	use EmptyParamWhiteList;
}