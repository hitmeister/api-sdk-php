<?php
namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property string $id_order
 * @property string $ts_created
 *
 * @property AddressTransfer $billing_address
 * @property BuyerTransfer $buyer
 * @property array $seller_units
 * @property AddressTransfer $shipping_address
 *
 */
class OrderWithEmbeddedTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
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
  'billing_address' => 
  array (
    'embedded' => true,
    'is_multiple' => false,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\AddressTransfer',
  ),
  'buyer' => 
  array (
    'embedded' => true,
    'is_multiple' => false,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\BuyerTransfer',
  ),
  'seller_units' => 
  array (
    'embedded' => true,
    'is_multiple' => true,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\OrderUnitTransfer',
  ),
  'shipping_address' => 
  array (
    'embedded' => true,
    'is_multiple' => false,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\AddressTransfer',
  ),
);
        return $properties;
    }

    /**
     * @param array $data
     *
     * @return OrderWithEmbeddedTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\OrderWithEmbeddedTransfer', $data);
    }
}
