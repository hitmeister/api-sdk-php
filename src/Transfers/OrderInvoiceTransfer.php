<?php

namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property int $id_invoice
 * @property string $id_order
 * @property string $original_name
 * @property string $mime_type
 * @property string $url
 * @property string $ts_created
 *
 *
 */
class OrderInvoiceTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'id_invoice' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
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
  'url' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'ts_created' => 
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
     * @return OrderInvoiceTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\OrderInvoiceTransfer', $data);
    }
}
