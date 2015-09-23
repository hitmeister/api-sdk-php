<?php

namespace Hitmeister\Component\Api\Tests\Endpoints\Reports;

use Hitmeister\Component\Api\Endpoints\Reports\ProductDataImportErrors;
use Hitmeister\Component\Api\Tests\TransportAwareTestCase;

/**
 * Class ProductDataImportErrorsTest
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Tests\Endpoints\Reports
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class ProductDataImportErrorsTest extends TransportAwareTestCase
{
	public function testInstance()
	{
		/** @var \Mockery\Mock|\Hitmeister\Component\Api\Transfers\ReportProductDataImportFileErrorsTransfer $transfer */
		$transfer = \Mockery::mock('\Hitmeister\Component\Api\Transfers\ReportProductDataImportFileErrorsTransfer');
		$transfer->shouldReceive('toArray')->once()->andReturn(['id_import_file' => 123]);

		$post = new ProductDataImportErrors($this->transport);
		$post->setTransfer($transfer);
		$this->assertInstanceOf('\Hitmeister\Component\Api\Transfers\ReportProductDataImportFileErrorsTransfer', $post->getTransfer());
		$this->assertEquals([], $post->getParamWhiteList());
		$this->assertEquals('POST', $post->getMethod());
		$this->assertEquals('reports/product-data-import-file-errors/', $post->getURI());

		$body = $post->getBody();
		$this->assertArrayHasKey('id_import_file', $body);
	}
}