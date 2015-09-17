<?php
namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property int $id_order_unit
 * @property string $id_order
 * @property string $ts_created
 * @property string $ts_updated
 * @property string $status
 * @property int $price
 * @property string $id_offer
 * @property int $revenue_gross
 * @property int $revenue_net
 * @property string $note
 * @property string $unit_condition
 * @property string $delivery_time
 * @property string $delivery_time_expires
 * @property int $shipping_rate
 * @property BuyerTransfer $buyer
 * @property ClaimTransfer $claim
 * @property AddressTransfer $billing_address
 * @property AddressTransfer $shipping_address
 * @property InvoiceTransfer $invoice
 * @property ItemTransfer $item
 *
 *
 */
class OrderUnitTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'id_order_unit' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'id_order' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'ts_created' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'ts_updated' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'status' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'price' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'id_offer' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'revenue_gross' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'revenue_net' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'note' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'unit_condition' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'delivery_time' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'delivery_time_expires' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'shipping_rate' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'buyer' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\BuyerTransfer',
  ),
  'claim' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\ClaimTransfer',
  ),
  'billing_address' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\AddressTransfer',
  ),
  'shipping_address' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\AddressTransfer',
  ),
  'invoice' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\InvoiceTransfer',
  ),
  'item' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\ItemTransfer',
  ),
);
        return $properties;
    }

    /**
     * @param array $data
     *
     * @return OrderUnitTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\OrderUnitTransfer', $data);
    }
}
