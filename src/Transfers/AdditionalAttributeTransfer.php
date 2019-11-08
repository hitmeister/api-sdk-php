<?php

namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property string $attribute
 * @property array $value
 *
 *
 */
class AdditionalAttributeTransfer extends AbstractTransfer
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
  'value' => 
  array (
    'embedded' => false,
    'is_multiple' => true,
  ),
);
        return $properties;
    }

    /**
     * @param array $data
     *
     * @return AdditionalAttributeTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\AdditionalAttributeTransfer', $data);
    }
}
