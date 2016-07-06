<?php

namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property string $attribute
 * @property string $original_value
 * @property string $state
 * @property string $message
 *
 *
 */
class ProductDataStatusAttributeValueTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'attribute' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'original_value' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'state' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'message' => 
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
     * @return ProductDataStatusAttributeValueTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\ProductDataStatusAttributeValueTransfer', $data);
    }
}
