<?php

namespace Hitmeister\Component\Api\Namespaces;

use Hitmeister\Component\Api\Cursor;
use Hitmeister\Component\Api\Endpoints\OrderInvoices\Delete;
use Hitmeister\Component\Api\Endpoints\OrderInvoices\Find;
use Hitmeister\Component\Api\Endpoints\OrderInvoices\Get;
use Hitmeister\Component\Api\Endpoints\OrderInvoices\Post;
use Hitmeister\Component\Api\Exceptions\ResourceNotFoundException;
use Hitmeister\Component\Api\Exceptions\ApiException;
use Hitmeister\Component\Api\FindBuilder;
use Hitmeister\Component\Api\Helper\Response;
use Hitmeister\Component\Api\Namespaces\Traits\PerformWithId;
use Hitmeister\Component\Api\Transfers\OrderInvoiceAddTransfer;
use Hitmeister\Component\Api\Transfers\OrderInvoiceTransfer;

class OrderInvoicesNamespace extends AbstractNamespace
{
	use PerformWithId;

	/**
	 * Find all invoices paginated via limit and offset.
	 *
	 * @param int $limit
	 * @param int $offset
	 *
	 * @return Cursor|OrderInvoiceTransfer[]
	 * @throws ApiException
	 */
	public function find($limit = 30, $offset = 0)
	{
		$findBuilder = new FindBuilder(
			new Find($this->getTransport()),
			'\Hitmeister\Component\Api\Transfers\OrderInvoiceTransfer'
		);

		return $findBuilder
			->setLimit($limit)
			->setOffset($offset)
			->find();
	}

	/**
	 * Get a single invoice by id.
	 *
	 * @param int $id
	 *
	 * @return OrderInvoiceTransfer|null
	 * @throws ApiException
	 */
	public function get($id)
	{
		$endpoint = new Get($this->getTransport());
		$result = $this->performWithId($endpoint, $id);

		return $result ? OrderInvoiceTransfer::make($result) : null;
	}

	/**
	 * Attach an invoice to an order.
	 *
	 * @param string $idOrder
	 * @param string $originalName
	 * @param string $mimeType
	 * @param string $content
	 *
	 * @return int
	 * @throws ApiException
	 */
	public function post($idOrder, $originalName, $mimeType, $content)
	{
		$data = new OrderInvoiceAddTransfer();
		$data->id_order = $idOrder;
		$data->original_name = $originalName;
		$data->mime_type = $mimeType;
        $data->data = $content;

		$endpoint = new Post($this->getTransport());
		$endpoint->setTransfer($data);
		$result = $endpoint->performRequest();

		return Response::extractId($result, '/order-invoices/%d/');
	}

	/**
	 * Delete an invoice.
	 *
	 * @param int $id
	 *
	 * @return bool
	 * @throws ApiException
	 */
	public function delete($id)
	{
		$endpoint = new Delete($this->getTransport());
		$endpoint->setId($id);

		try {
			$result = $endpoint->performRequest();
		} catch (ResourceNotFoundException $e) {
			return false;
		}

		return $result['status'] == 204;
	}
}
