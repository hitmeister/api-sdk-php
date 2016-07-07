<?php

namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property string $name
 * @property WarehouseAddressTransfer $address
 * @property boolean $is_pickup_possible
 * @property boolean $is_default
 *
 *
 */
class WarehouseUpdateTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'name' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'address' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\WarehouseAddressTransfer',
  ),
  'is_pickup_possible' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'is_default' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
);
        return $properties;
    }

    /**
     * @param array $data
     *
     * @return WarehouseUpdateTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\WarehouseUpdateTransfer', $data);
    }
}
