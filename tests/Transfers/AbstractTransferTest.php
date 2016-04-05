<?php

namespace Hitmeister\Component\Api\Tests\Transfers;

use Hitmeister\Component\Api\Transfers\AbstractTransfer;

class AbstractTransferTest extends \PHPUnit_Framework_TestCase
{
	/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\AbstractTransfer */
	private $transfer;

	/**
	 *
	 */
	protected function setUp()
	{
		$this->transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\AbstractTransfer[getProperties]');
	}

	/**
	 * This method is called after a test is executed.
	 */
	public function tearDown()
	{
		\Mockery::close();

		$this->transfer = null;
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\UnexpectedPropertyException
	 * @expectedExceptionMessage Property "unexpected_property" not found.
	 */
	public function testGetUnexpectedProperty()
	{
		$this->transfer->shouldReceive('getProperties')->andReturn([]);
		if ($this->transfer->unexpected_property) {
			$this->fail('Should not exists');
		}
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\EmptyEmbeddedPropertyException
	 * @expectedExceptionMessage Embedded property "prop" is empty.
	 */
	public function testGetEmptyEmbeddedProperty()
	{
		$this->transfer->shouldReceive('getProperties')->andReturn([
			'prop' => [
				'embedded' => true,
			],
		]);
		if ($this->transfer->prop) {
			$this->fail('Should not exists');
		}
	}

	/**
	 * @expectedException \PHPUnit_Framework_Error_Notice
	 * @expectedExceptionMessage Requested core property "prop" is empty.
	 */
	public function testGetEmptyPropertyRiseNotice()
	{
		$this->transfer->shouldReceive('getProperties')->andReturn([
			'prop' => [
				'embedded' => false,
			],
		]);
		$this->assertNull($this->transfer->prop);
	}

	public function testGetEmptyProperty()
	{
		$this->transfer->shouldReceive('getProperties')->andReturn([
			'prop' => [
				'embedded' => false,
			],
		]);
		$this->assertNull(@$this->transfer->prop);
	}

	public function testSetGetProperty()
	{
		$this->transfer->shouldReceive('getProperties')->andReturn([
			'prop' => [
				'embedded' => false,
				'is_multiple' => false,
			],
		]);
		$this->transfer->prop = 'hello';
		$this->assertEquals('hello', $this->transfer->prop);
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\UnexpectedPropertyException
	 * @expectedExceptionMessage Property "prop" has to be an array
	 */
	public function testSetMultiErrorProperty()
	{
		$this->transfer->shouldReceive('getProperties')->andReturn([
			'prop' => [
				'is_multiple' => true,
			],
		]);
		$this->transfer->prop = 'hello';
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\UnexpectedParamException
	 * @expectedExceptionMessage Property "prop" has to be \stdClass type
	 */
	public function testSetCustomTypeErrorProperty()
	{
		$this->transfer->shouldReceive('getProperties')->andReturn([
			'prop' => [
				'is_multiple' => false,
				'type' => '\stdClass'
			],
		]);
		$this->transfer->prop = 'hello';
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\UnexpectedParamException
	 * @expectedExceptionMessage Property "prop" has to be an array of \stdClass type
	 */
	public function testSetMultiCustomTypeErrorProperty()
	{
		$this->transfer->shouldReceive('getProperties')->andReturn([
			'prop' => [
				'is_multiple' => true,
				'type' => '\stdClass'
			],
		]);
		$this->transfer->prop = ['hello', 'world'];
	}

	public function testSetCustomTypeProperty()
	{
		$this->transfer->shouldReceive('getProperties')->andReturn([
			'prop' => [
				'is_multiple' => false,
				'type' => '\stdClass'
			],
		]);

		$val = new \stdClass();
		$val->prop = 'hello';

		$this->transfer->prop = $val;

		$this->assertInstanceOf('\stdClass', $this->transfer->prop);
		$this->assertEquals('hello', $this->transfer->prop->prop);
	}

	public function testSetMultiCustomTypeProperty()
	{
		$this->transfer->shouldReceive('getProperties')->andReturn([
			'prop' => [
				'is_multiple' => true,
				'type' => '\stdClass'
			],
		]);

		$this->transfer->prop = [new \stdClass(), new \stdClass()];

		$this->assertTrue(is_array($this->transfer->prop));
		$this->assertEquals(2, count($this->transfer->prop));
		$this->assertInstanceOf('\stdClass', $this->transfer->prop[0]);
	}

	public function testIssetProperty()
	{
		$this->transfer->shouldReceive('getProperties')->andReturn([
			'prop' => [
				'embedded' => false,
				'is_multiple' => false,
			],
		]);

		$this->assertFalse(isset($this->transfer->prop));

		$this->transfer->prop = 'hello';

		$this->assertTrue(isset($this->transfer->prop));
	}

	public function testUnsetProperty()
	{
		$this->transfer->shouldReceive('getProperties')->andReturn([
			'prop' => [
				'embedded' => false,
				'is_multiple' => false,
			],
		]);

		$this->transfer->prop = 'hello';
		$this->assertTrue(isset($this->transfer->prop));

		unset($this->transfer->prop);
		$this->assertFalse(isset($this->transfer->prop));
	}

	/**
	 * @expectedException \Hitmeister\Component\Api\Exceptions\UnexpectedParamException
	 * @expectedExceptionMessage AbstractTransfer
	 */
	public function testMakeTransferWrongType()
	{
		AbstractTransfer::makeTransfer('\stdClass', []);
	}

	public function testMakeTransferType()
	{
		$a = AbstractTransfer::makeTransfer('\Hitmeister\Component\Api\Transfers\StatusPingTransfer', []);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\StatusPingTransfer', $a);
	}

	public function testFromArray()
	{
		$this->transfer->shouldReceive('getProperties')->andReturn([
			'prop_normal' => [
				'is_multiple' => false,
			],
			'prop_multi' => [
				'is_multiple' => true,
			],
			'prop_normal_type' => [
				'is_multiple' => false,
				'type' => '\Hitmeister\Component\Api\Transfers\StatusPingTransfer',
			],
			'prop_multi_type' => [
				'is_multiple' => true,
				'type' => '\Hitmeister\Component\Api\Transfers\StatusPingTransfer',
			],
		]);

		$data = [
			'prop_normal' => 'hello',
			'prop_multi' => ['hello', 'world'],
			'prop_normal_type' => [
				'message' => 'hello',
			],
			'prop_multi_type' => [
				[
					'message' => 'hello',
				],
				[
					'message' => 'world',
				]
			],
		];

		$this->transfer->fromArray($data);
		$this->assertEquals('hello', $this->transfer->prop_normal);
		$this->assertTrue(is_array($this->transfer->prop_multi));
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\StatusPingTransfer', $this->transfer->prop_normal_type);
		$this->assertEquals('hello', $this->transfer->prop_normal_type->message);
		$this->assertTrue(is_array($this->transfer->prop_multi_type));
		$this->assertEquals(2, count($this->transfer->prop_multi_type));
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\StatusPingTransfer', $this->transfer->prop_multi_type[0]);
		$this->assertEquals('hello', $this->transfer->prop_multi_type[0]->message);
	}

	public function testFromArrayNull()
	{
		$this->transfer->shouldReceive('getProperties')->andReturn([
			'prop_normal' => [
				'is_multiple' => false,
			],
			'prop_normal_type' => [
				'is_multiple' => false,
				'type' => '\Hitmeister\Component\Api\Transfers\StatusPingTransfer',
			],
		]);

		$data = [
			'prop_normal' => null,
			'prop_normal_type' => null,
		];

		$this->transfer->fromArray($data);
		$result = $this->transfer->toArray();
		$this->assertArrayHasKey('prop_normal', $result);
		$this->assertArrayHasKey('prop_normal_type', $result);
		$this->assertNull($this->transfer->prop_normal);
		$this->assertNull($this->transfer->prop_normal_type);
	}

	public function testToArray()
	{
		$this->transfer->shouldReceive('getProperties')->andReturn([
			'prop_normal' => [
				'is_multiple' => false,
			],
			'prop_multi' => [
				'is_multiple' => true,
			],
			'prop_normal_type' => [
				'is_multiple' => false,
				'type' => '\Hitmeister\Component\Api\Transfers\StatusPingTransfer',
			],
			'prop_multi_type' => [
				'is_multiple' => true,
				'type' => '\Hitmeister\Component\Api\Transfers\StatusPingTransfer',
			],
			'not_in_data' => [
				'is_multiple' => true,
			]
		]);

		$data = [
			'prop_normal' => 'hello',
			'prop_multi' => ['hello', 'world'],
			'prop_normal_type' => [
				'message' => 'hello',
			],
			'prop_multi_type' => [
				[
					'message' => 'hello',
				],
				[
					'message' => 'world',
				]
			],
			'prop_is_invalid' => 'hello',
		];

		$this->transfer->fromArray($data);
		$result = $this->transfer->toArray();

		$this->assertArrayNotHasKey('not_in_data', $result);
		$this->assertArrayHasKey('prop_normal', $result);
		$this->assertArrayHasKey('prop_multi', $result);
		$this->assertArrayHasKey('prop_normal_type', $result);
		$this->assertArrayHasKey('prop_multi_type', $result);
		$this->assertArrayNotHasKey('prop_is_invalid', $result);

		$this->assertTrue(is_array($result['prop_multi']));
		$this->assertTrue(is_array($result['prop_normal_type']));
		$this->assertTrue(is_array($result['prop_multi_type']));

		$this->assertEquals('hello', $result['prop_normal']);
		$this->assertEquals(2, count($result['prop_multi']));
		$this->assertEquals(1, count($result['prop_normal_type']));
		$this->assertEquals(2, count($result['prop_multi_type']));
	}

	public function testToJson()
	{
		$this->transfer->shouldReceive('getProperties')->andReturn([
			'prop' => [
				'is_multiple' => false,
			],
			'not_in_data' => [
				'is_multiple' => false,
			]
		]);

		$data = [
			'prop' => 'hello',
		];

		$this->transfer->fromArray($data);
		$result = json_encode($this->transfer);

		$this->assertJson($result);
	}
}