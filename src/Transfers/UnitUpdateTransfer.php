<?php

namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property string $condition
 * @property int $listing_price
 * @property int $minimum_price
 * @property int $amount
 * @property string $id_offer
 * @property string $note
 * @property string $delivery_time
 * @property int $delivery_time_min
 * @property int $delivery_time_max
 * @property string $shipping_group
 * @property string $location
 * @property string $warehouse
 * @property int $reference_price
 *
 *
 */
class UnitUpdateTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'condition' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'listing_price' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'minimum_price' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'amount' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'id_offer' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'note' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'delivery_time' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'delivery_time_min' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'delivery_time_max' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'shipping_group' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'location' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'warehouse' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'reference_price' => 
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
     * @return UnitUpdateTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\UnitUpdateTransfer', $data);
    }
}
