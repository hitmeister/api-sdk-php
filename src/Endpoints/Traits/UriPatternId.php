<?php

namespace Hitmeister\Component\Api\Endpoints\Traits;

use Hitmeister\Component\Api\Exceptions\RuntimeException;

/**
 * Class UriPatternId
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\Traits
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
trait UriPatternId
{
	use IdSetterGetter;

	/**
	 * @return string
	 */
	public function getURI()
	{
		if (empty($this->id)) {
			throw new RuntimeException('Required params id is not set');
		}
		return sprintf($this->getUriPattern(), $this->id);
	}

	/**
	 * @return string
	 */
	abstract protected function getUriPattern();
}