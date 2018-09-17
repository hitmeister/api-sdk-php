<?php

namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property array $id_order_unit
 * @property string $reason
 * @property string $note
 *
 *
 */
class OrderUnitReturnTransfer extends AbstractTransfer
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
    'is_multiple' => true,
  ),
  'reason' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'note' => 
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
     * @return OrderUnitReturnTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\OrderUnitReturnTransfer', $data);
    }
}
