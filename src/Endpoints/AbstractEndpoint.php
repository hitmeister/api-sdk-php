<?php

namespace Hitmeister\Component\Api\Endpoints;

use Hitmeister\Component\Api\Exceptions\UnexpectedParamException;
use Hitmeister\Component\Api\Transport\Transport;

/**
 * Class AbstractEndpoint
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
abstract class AbstractEndpoint
{
	/**
	 * @var array
	 */
	protected $params = [];

	/** @var mixed */
	protected $body = null;

	/** @var Transport */
	private $transport;

	/** @var array */
	private $options = [];

	/**
	 * @return string[]
	 */
	abstract public function getParamWhiteList();

	/**
	 * @return string
	 */
	abstract public function getMethod();

	/**
	 * @return string
	 */
	abstract public function getURI();

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

	/**
	 * @return int
	 */
	public function getApiLimit()
	{
		return 30;
	}

	/**
	 * @return array
	 */
	public function performRequest()
	{
		$result = $this->transport->performRequest(
			$this->getMethod(),
			$this->getURI(),
			$this->params,
			$this->getBody(),
			$this->options
		);
		return $result;
	}

	/**
	 * @param array $params
	 * @return $this
	 */
	public function setParams(array $params)
	{
		$this->checkParams($params);
		$this->extractOptions($params);

		$this->params = $this->convertArraysToStrings($params);

		return $this;
	}

	/**
	 * @return array
	 */
	public function getParams()
	{
		$result = $this->params;
		if (isset($this->options['client'])) {
			$result['client'] = $this->options['client'];
		}
		return $result;
	}

	/**
	 * @return mixed
	 */
	public function getBody()
	{
		return $this->body;
	}

	/**
	 * @param array $params
	 * @throws UnexpectedParamException
	 */
	private function checkParams(array $params)
	{
		$whiteList = array_merge($this->getParamWhiteList(), ['client']);

		foreach ($params as $key => $value) {
			if (!in_array($key, $whiteList)) {
				throw new UnexpectedParamException(sprintf('"%s" is not a valid parameter. Allowed parameters are: "%s"',
					$key, implode('", "', $whiteList)));
			}
		}
	}

	/**
	 * @param array $params
	 */
	private function extractOptions(array &$params)
	{
		if (!isset($params['client']))
			return;

		$this->options['client'] = $params['client'];
		unset($params['client']);

		// Workaround ignore option
		if (isset($this->options['client']['ignore'])) {
			$ignore = $this->options['client']['ignore'];
			if (is_string($ignore)) {
				$this->options['client']['ignore'] = explode(',', $ignore);
			} elseif (!is_array($ignore)) {
				$this->options['client']['ignore'] = (array)$ignore;
			}
		}
	}

	/**
	 * @param array $params
	 * @return array
	 */
	private function convertArraysToStrings(array $params)
	{
		foreach ($params as $key => &$value) {
			if (is_array($value) && !$this->isNestedArray($value)) {
				$value = implode(',', $value);
			}
		}
		return $params;
	}

	/**
	 * @param array $a
	 * @return bool
	 */
	private function isNestedArray(array $a)
	{
		foreach ($a as $v) {
			if (is_array($v)) {
				return true;
			}
		}
		return false;
	}
}