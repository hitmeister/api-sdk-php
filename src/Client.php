<?php

namespace Hitmeister\Component\Api;

use Hitmeister\Component\Api\Namespaces\AttributesNamespace;
use Hitmeister\Component\Api\Namespaces\CategoriesNamespace;
use Hitmeister\Component\Api\Namespaces\ClaimMessagesNamespace;
use Hitmeister\Component\Api\Namespaces\ClaimsNamespace;
use Hitmeister\Component\Api\Namespaces\ImportFilesNamespace;
use Hitmeister\Component\Api\Namespaces\ItemsNamespace;
use Hitmeister\Component\Api\Namespaces\OrdersNamespace;
use Hitmeister\Component\Api\Namespaces\OrderUnitsNamespace;
use Hitmeister\Component\Api\Namespaces\ReportsNamespace;
use Hitmeister\Component\Api\Namespaces\ReturnsNamespace;
use Hitmeister\Component\Api\Namespaces\ReturnUnitsNamespace;
use Hitmeister\Component\Api\Namespaces\StatusNamespace;
use Hitmeister\Component\Api\Namespaces\SubscriptionsNamespace;
use Hitmeister\Component\Api\Namespaces\UnitsNamespace;
use Hitmeister\Component\Api\Transport\Transport;

/**
 * Class Client
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api
 * @author   Maksim Naumov <maksim.naumov@hitmeister.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Client
{
	const VERSION = '0.1';

	/** @var Transport */
	private $transport;

	/** @var AttributesNamespace */
	private $attributesNs;

	/** @var CategoriesNamespace */
	private $categoriesNs;

	/** @var ClaimMessagesNamespace */
	private $claimMessagesNs;

	/** @var ClaimsNamespace */
	private $claimsNs;

	/** @var ImportFilesNamespace */
	private $importFilesNs;

	/** @var ItemsNamespace */
	private $itemsNs;

	/** @var OrdersNamespace */
	private $ordersNs;

	/** @var OrderUnitsNamespace */
	private $orderUnitsNs;

	/** @var ReportsNamespace */
	private $reportsNs;

	/** @var ReturnsNamespace */
	private $returnsNs;

	/** @var ReturnUnitsNamespace */
	private $returnUnitsNs;

	/** @var StatusNamespace */
	private $statusNs;

	/** @var SubscriptionsNamespace */
	private $subscriptionsNs;

	/** @var UnitsNamespace */
	private $unitsNs;

	/**
	 * @param Transport $transport
	 */
	public function __construct(Transport $transport)
	{
		$this->transport = $transport;

		// Namespaces
		$this->attributesNs = new AttributesNamespace($this->transport);
		$this->categoriesNs = new CategoriesNamespace($this->transport);
		$this->claimMessagesNs = new ClaimMessagesNamespace($this->transport);
		$this->claimsNs = new ClaimsNamespace($this->transport);
		$this->importFilesNs = new ImportFilesNamespace($this->transport);
		$this->itemsNs = new ItemsNamespace($this->transport);
		$this->ordersNs = new OrdersNamespace($this->transport);
		$this->orderUnitsNs = new OrderUnitsNamespace($this->transport);
		$this->reportsNs = new ReportsNamespace($this->transport);
		$this->returnsNs = new ReturnsNamespace($this->transport);
		$this->returnUnitsNs = new ReturnUnitsNamespace($this->transport);
		$this->statusNs = new StatusNamespace($this->transport);
		$this->subscriptionsNs = new SubscriptionsNamespace($this->transport);
		$this->unitsNs = new UnitsNamespace($this->transport);
	}

	/**
	 * @return Transport
	 */
	public function getTransport()
	{
		return $this->transport;
	}

	/**
	 * @return AttributesNamespace
	 */
	public function attributes()
	{
		return $this->attributesNs;
	}

	/**
	 * @return CategoriesNamespace
	 */
	public function categories()
	{
		return $this->categoriesNs;
	}

	/**
	 * @return ClaimMessagesNamespace
	 */
	public function claimMessages()
	{
		return $this->claimMessagesNs;
	}

	/**
	 * @return ClaimsNamespace
	 */
	public function claims()
	{
		return $this->claimsNs;
	}

	/**
	 * @return ImportFilesNamespace
	 */
	public function importFiles()
	{
		return $this->importFilesNs;
	}

	/**
	 * @return ItemsNamespace
	 */
	public function items()
	{
		return $this->itemsNs;
	}

	/**
	 * @return OrdersNamespace
	 */
	public function orders()
	{
		return $this->ordersNs;
	}

	/**
	 * @return OrderUnitsNamespace
	 */
	public function orderUnits()
	{
		return $this->orderUnitsNs;
	}

	/**
	 * @return ReportsNamespace
	 */
	public function reports()
	{
		return $this->reportsNs;
	}

	/**
	 * @return ReturnsNamespace
	 */
	public function returns()
	{
		return $this->returnsNs;
	}

	/**
	 * @return ReturnUnitsNamespace
	 */
	public function returnUnits()
	{
		return $this->returnUnitsNs;
	}

	/**
	 * @return StatusNamespace
	 */
	public function status()
	{
		return $this->statusNs;
	}

	/**
	 * @return SubscriptionsNamespace
	 */
	public function subscriptions()
	{
		return $this->subscriptionsNs;
	}

	/**
	 * @return UnitsNamespace
	 */
	public function units()
	{
		return $this->unitsNs;
	}
}