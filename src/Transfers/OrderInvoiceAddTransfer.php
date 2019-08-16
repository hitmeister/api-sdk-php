<?php

namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property string $id_order
 * @property string $original_name
 * @property string $mime_type
 * @property string $data
 *
 *
 */
class OrderInvoiceAddTransfer extends AbstractTransfer
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
  'original_name' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'mime_type' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'data' => 
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
     * @return OrderInvoiceAddTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\OrderInvoiceAddTransfer', $data);
    }
}
