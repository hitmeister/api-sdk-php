<?php

namespace Hitmeister\Component\Api\Transfers;

use Hitmeister\Component\Api\Exceptions\EmptyEmbeddedPropertyException;
use Hitmeister\Component\Api\Exceptions\UnexpectedParamException;
use Hitmeister\Component\Api\Exceptions\UnexpectedPropertyException;

abstract class AbstractTransfer implements \JsonSerializable
{
	/** @var array */
	private $data = [];

	/**
	 * @return array
	 */
	abstract public function getProperties();

	/**
	 * @param string $name
	 * @return mixed
	 */
	public function __get($name)
	{
		$this->validateProperty($name);

		if (!array_key_exists($name, $this->data)) {
			if ($this->isEmbedded($name)) {
				throw new EmptyEmbeddedPropertyException(sprintf('Embedded property "%s" is empty.', $name));
			}

			trigger_error(sprintf('Requested core property "%s" is empty.', $name));
			return null;
		}

		return $this->data[$name];
	}

	/**
	 * @param string $name
	 * @param mixed  $value
	 */
	public function __set($name, $value)
	{
		$this->validateProperty($name);
		$this->validateMulti($name, $value);

		if (null !== ($type = $this->getCustomType($name))) {
			if (!$this->isMulti($name)) {
				if (!$value instanceof $type) {
					throw new UnexpectedParamException(sprintf('Property "%s" has to be %s type, but got %s.',
						$name, $type, gettype($value)));
				}
			} else {
				foreach ($value as $item) {
					if (!$item instanceof $type) {
						throw new UnexpectedParamException(
							sprintf('Property "%s" has to be an array of %s type, but one of the elements has %s type.',
								$name, $type, gettype($item)));
					}
				}
			}
		}

		$this->data[$name] = $value;
	}

	/**
	 * @param string $name
	 * @return bool
	 */
	public function __isset($name)
	{
		$this->validateProperty($name);

		return isset($this->data[$name]);
	}

	/**
	 * @param string $name
	 */
	public function __unset($name)
	{
		$this->validateProperty($name);

		if (isset($this->data[$name])) {
			unset($this->data[$name]);
		}
	}

	/**
	 * @param array $data
	 */
	public function fromArray(array $data)
	{
		foreach ($data as $name => $value) {
			$this->validateProperty($name);
			$this->validateMulti($name, $value);
			$type = $this->getCustomType($name);

			if (null === $type) {
				$this->data[$name] = $value;
				continue;
			}

			if (!$this->isMulti($name)) {
				$this->data[$name] = AbstractTransfer::makeTransfer($type, $value);
			} else {
				foreach ($value as $i => $item) {
					$this->data[$name][$i] = AbstractTransfer::makeTransfer($type, $item);
				}
			}
		}
	}

	/**
	 * @return array
	 */
	public function toArray()
	{
		$result = [];

		foreach ($this->data as $name => $data) {
			if (is_array($data)) {
				foreach ($data as &$v) {
					if ($v instanceof AbstractTransfer) {
						$v = $v->toArray();
					}
				}
			} elseif ($data instanceof AbstractTransfer) {
				$data = $data->toArray();
			}

			$result[$name] = $data;
		}

		return $result;
	}

	/**
	 * @return string
	 */
	public function jsonSerialize()
	{
		return $this->toArray();
	}

	/**
	 * @param string $type
	 * @param array  $value
	 * @return AbstractTransfer
	 */
	public static function makeTransfer($type, array $value)
	{
		$instance = new $type();
		if (!$instance instanceof AbstractTransfer) {
			throw new UnexpectedParamException('Expected that class of transfer extends AbstractTransfer class.');
		}
		$instance->fromArray($value);
		return $instance;
	}

	/**
	 * @param string $name
	 */
	private function validateProperty($name)
	{
		if (!isset($this->getProperties()[$name])) {
			throw new UnexpectedPropertyException(sprintf('Property "%s" not found.', $name));
		}
	}

	/**
	 * @param string $name
	 * @param mixed  $value
	 */
	private function validateMulti($name, $value)
	{
		if ($this->isMulti($name) && !is_array($value)) {
			throw new UnexpectedPropertyException(sprintf('Property "%s" has to be an array but got %s.', $name,
				gettype($value)));
		}
	}

	/**
	 * @param string $name
	 * @return bool
	 */
	private function isEmbedded($name)
	{
		return $this->getProperties()[$name]['embedded'];
	}

	/**
	 * @param string $name
	 * @return bool
	 */
	private function isMulti($name)
	{
		return $this->getProperties()[$name]['is_multiple'];
	}

	/**
	 * @param string $name
	 * @return null|string
	 */
	private function getCustomType($name)
	{
		$property = $this->getProperties()[$name];
		return isset($property['type']) ? $property['type'] : null;
	}
}