<?php

namespace Hitmeister\Component\Api\Tests;

abstract class TransportAwareTestCase extends \PHPUnit_Framework_TestCase
{
	/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transport\Transport */
	protected $transport;

	/**
	 *
	 */
	public function setUp()
	{
		parent::setUp();
		$this->transport = \Mockery::mock('\Hitmeister\Component\Api\Transport\Transport');
	}

	/**
	 * This method is called after a test is executed.
	 */
	public function tearDown()
	{
		\Mockery::close();
		$this->transport = null;
		parent::tearDown();
	}
}