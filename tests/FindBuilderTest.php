<?php

namespace Hitmeister\Component\Api\Tests;

use Hitmeister\Component\Api\FindBuilder;

class FindBuilderTest extends TransportAwareTestCase
{
	/** @var \Mockery\Mock|\Hitmeister\Component\Api\Endpoints\AbstractEndpoint */
	private $endpoint;

	/**
	 *
	 */
	public function setUp()
	{
		parent::setUp();

		$this->endpoint =
			\Mockery::mock('\Hitmeister\Component\Api\Endpoints\AbstractEndpoint[getParamWhiteList,getMethod,getURI]',
				[$this->transport]);
	}

	/**
	 * This method is called after a test is executed.
	 */
	public function tearDown()
	{
		$this->endpoint = null;
		parent::tearDown();
	}

	public function testGetSet()
	{
		$builder = new FindBuilder($this->endpoint, '\stdClass');
		$builder->setParams(['one' => 1, 'two' => 2, 'nothing' => null]);
		$this->assertEquals(['one' => 1, 'two' => 2], $builder->getParams());
		$builder->setParams(['one' => 1, 'two' => null]);
		$this->assertEquals(['one' => 1], $builder->getParams());

		// Reset
		$builder->setParams([]);

		$builder->addParam('one', null);
		$this->assertArrayNotHasKey('one', $builder->getParams());
		$builder->addParam('two', 2);
		$this->assertEquals(2, $builder->getParam('two'));
		$builder->addParam('two', null);
		$this->assertArrayNotHasKey('two', $builder->getParams());
		$this->assertEquals(100, $builder->getParam('two', 100));

		// Reset
		$builder->setParams([]);

		$builder->setOffset(100);
		$this->assertEquals(100, $builder->getOffset());
		$builder->setLimit(40);
		$this->assertEquals(40, $builder->getLimit());
		$builder->setSort('date:asc');
		$this->assertEquals('date:asc', $builder->getSort());
		$builder->setOffset();
		$this->assertEquals(0, $builder->getOffset());
		$builder->setLimit();
		$this->assertEquals(null, $builder->getLimit());
		$builder->setSort(null);
		$this->assertEquals(null, $builder->getSort());

		// Reset
		$builder->setParams([]);

		$d = time() + 100;
		$dt = time() - 100;

		/** @var \Mockery\Mock $mock */
		$mock = \Mockery::mock('alias:\Hitmeister\Component\Api\Helper\Request');
		$mock->shouldReceive('formatDate')->withArgs([$d])->once()->andReturn('date');
		$mock->shouldReceive('formatDateTime')->withArgs([$dt])->once()->andReturn('date_time');

		$builder->addDateParam('date', $d);
		$this->assertEquals('date', $builder->getParam('date'));

		$builder->addDateTimeParam('date_time', $dt);
		$this->assertEquals('date_time', $builder->getParam('date_time'));

		// Reset
		$builder->setParams(['one' => 1, 'two' => 2]);

		$this->endpoint->shouldReceive('getParamWhiteList')->andReturn(['one', 'two']);
		$cursor = $builder->find();
		$endpoint = $cursor->getEndpoint();
		$this->assertEquals(['one' => 1, 'two' => 2], $endpoint->getParams());
	}
}