<?php

namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property int $id_invoice
 * @property string $id_order
 * @property string $ts_created
 *
 *
 */
class OrderInvoiceListTransfer extends AbstractTransfer
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
     * @return OrderInvoiceListTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\OrderInvoiceListTransfer', $data);
    }
}
