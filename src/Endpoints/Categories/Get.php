<?php

namespace Hitmeister\Component\Api\Endpoints\Categories;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Interfaces\IdAware;
use Hitmeister\Component\Api\Endpoints\Traits\EmbeddedParamWhiteList;
use Hitmeister\Component\Api\Endpoints\Traits\RequestGet;
use Hitmeister\Component\Api\Endpoints\Traits\UriPatternId;

/**
 * Class Get
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Categories
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.real.de/api/v1/
 */
class Get extends AbstractEndpoint implements IdAware
{
	use RequestGet;
	use UriPatternId;
	use EmbeddedParamWhiteList;

	/**
	 * {@inheritdoc}
	 */
	protected function getUriPattern()
	{
		return 'categories/%d/';
	}
}