<?php

namespace Hitmeister\Component\Api\Tests\Namespaces;

use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Helper\Request;
use Hitmeister\Component\Api\Namespaces\ImportFilesNamespace;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class ImportFilesNamespaceTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Namespaces
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ImportFilesNamespaceTest extends TransportAwareTestCase
{
	public function testFind()
	{
		$createdTime = time() - 100;
		$updatedTime = time() - 200;

		$this->transport
			->shouldReceive('performRequest')
			->once()
			->withArgs([
				\Mockery::any(),
				\Mockery::any(),
				[
					'status' => 'DONE,DOWNLOADED',
					'type' => 'COMMAND',
					'ts_created:from' => date(Request::DATE_TIME_FORMAT, $createdTime),
					'ts_updated:from' => date(Request::DATE_TIME_FORMAT, $updatedTime),
					'sort' => 'ts_created:desc',
					'limit' => 30,
					'offset' => 0,
				],
				\Mockery::any(),
				\Mockery::any(),
			])
			->andReturn([
				'headers' => [
					'Hm-Collection-Range' => ['1-30/294'],
				],
				'json' => [
					[
						'id_import_file' => 12356,
						'uri' => 'http://google.com/',
					]
				]
			]);

		$namespace = new ImportFilesNamespace($this->transport);
		$result = $namespace->find(['DONE','DOWNLOADED'], ['COMMAND'], $createdTime, $updatedTime);

		$this->assertInstanceOf('\Iterator', $result);
		$result = iterator_to_array($result);

		/** @var \Hitmeister\Component\Api\Transfers\ImportFileTransfer[] $result */
		$this->assertEquals(1, count($result));
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ImportFileTransfer', $result[0]);
		$this->assertEquals(12356, $result[0]->id_import_file);
		$this->assertEquals('http://google.com/', $result[0]->uri);
	}

	public function testPost()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'headers' => [
				'Location' => ['/import-files/15798348/'],
			],
		]);

		$namespace = new ImportFilesNamespace($this->transport);
		$result = $namespace->post(2939276, 'message');
		$this->assertEquals(15798348, $result);
	}

	public function testGet()
	{
		$this->transport->shouldReceive('performRequest')->once()->andReturn([
			'json' => [
				'id_import_file' => 12356,
			]
		]);

		$namespace = new ImportFilesNamespace($this->transport);
		$result = $namespace->get(1);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ImportFileTransfer', $result);
		$this->assertEquals(12356, $result->id_import_file);
	}

	public function testGetNotFound()
	{
		$this->transport->shouldReceive('performRequest')->once()->andThrow(new ResourceNotFoundException());

		$namespace = new ImportFilesNamespace($this->transport);
		$result = $namespace->get(10);
		$this->assertNull($result);
	}
}