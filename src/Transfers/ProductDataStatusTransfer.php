<?php

namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property bool $item_ready
 * @property string $item_not_ready_reason
 * @property int $id_item
 * @property float $item_quality
 * @property bool $item_isvalid
 * @property array $missing_mandatory_attributes
 * @property array $min_one_missing_attributes
 * @property string $update_status
 * @property string $update_fail_reason
 * @property array $attribute_values
 *
 *
 */
class ProductDataStatusTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'item_ready' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'item_not_ready_reason' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'id_item' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'item_quality' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'item_isvalid' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'missing_mandatory_attributes' => 
  array (
    'embedded' => false,
    'is_multiple' => true,
  ),
  'min_one_missing_attributes' => 
  array (
    'embedded' => false,
    'is_multiple' => true,
  ),
  'update_status' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'update_fail_reason' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'attribute_values' => 
  array (
    'embedded' => false,
    'is_multiple' => true,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\ProductDataStatusAttributeValueTransfer',
  ),
);
        return $properties;
    }

    /**
     * @param array $data
     *
     * @return ProductDataStatusTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\ProductDataStatusTransfer', $data);
    }
}
