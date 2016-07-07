<?php

namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property string $street
 * @property string $house_number
 * @property string $postcode
 * @property string $city
 * @property string $country
 * @property string $phone
 *
 *
 */
class WarehouseAddressTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'street' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'house_number' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'postcode' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'city' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'country' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'phone' => 
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
     * @return WarehouseAddressTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\WarehouseAddressTransfer', $data);
    }
}
