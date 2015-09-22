<?php

namespace Hitmeister\Component\Api;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Helper\Request;

class FindBuilder
{
	/** @var array */
	private $params = [];

	/** @var AbstractEndpoint */
	private $endpoint;

	/** @var string */
	private $transferClass;

	/**
	 * @param AbstractEndpoint $endpoint
	 * @param string           $transferClass
	 */
	public function __construct(AbstractEndpoint $endpoint, $transferClass)
	{
		$this->endpoint = $endpoint;
		$this->transferClass = $transferClass;
	}

	/**
	 * @param int|null $limit
	 * @return $this
	 */
	public function setLimit($limit = null)
	{
		return $this->addParam('limit', $limit);
	}

	/**
	 * @return int|null
	 */
	public function getLimit()
	{
		return $this->getParam('limit');
	}

	/**
	 * @param int $offset
	 * @return $this
	 */
	public function setOffset($offset = 0)
	{
		return $this->addParam('offset', $offset);
	}

	/**
	 * @return int
	 */
	public function getOffset()
	{
		return $this->getParam('offset', 0);
	}

	/**
	 * @param string $sort
	 * @return $this
	 */
	public function setSort($sort)
	{
		return $this->addParam('sort', $sort);
	}

	/**
	 * @return string|null
	 */
	public function getSort()
	{
		return $this->getParam('sort');
	}

	/**
	 * @param string               $name
	 * @param \DateTime|int|string $date
	 * @return $this
	 */
	public function addDateParam($name, $date)
	{
		return $this->addParam($name, Request::formatDate($date));
	}

	/**
	 * @param string               $name
	 * @param \DateTime|int|string $dateTime
	 * @return $this
	 */
	public function addDateTimeParam($name, $dateTime)
	{
		return $this->addParam($name, Request::formatDateTime($dateTime));
	}

	/**
	 * @param array $params
	 * @return $this
	 */
	public function setParams(array $params)
	{
		$this->params = [];
		foreach ($params as $name => $value) {
			if (null === $value) {
				continue;
			}
			$this->params[$name] = $value;
		}
		return $this;
	}

	/**
	 * @return array
	 */
	public function getParams()
	{
		return $this->params;
	}

	/**
	 * @param string $name
	 * @param mixed  $value
	 * @return $this
	 */
	public function addParam($name, $value)
	{
		if (null !== $value) {
			$this->params[$name] = $value;
		} elseif (isset($this->params[$name])) {
			unset($this->params[$name]);
		}
		return $this;
	}

	/**
	 * @param  string $name
	 * @param mixed   $default
	 * @return mixed
	 */
	public function getParam($name, $default = null)
	{
		return isset($this->params[$name]) ? $this->params[$name] : $default;
	}

	/**
	 * @return Cursor
	 */
	public function find()
	{
		$this->endpoint->setParams($this->params);
		return new Cursor($this->endpoint, $this->transferClass);
	}
}