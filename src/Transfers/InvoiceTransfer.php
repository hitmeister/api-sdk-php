<?php
namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property int $id_invoice
 * @property int $id_order_unit
 * @property string $number
 * @property string $url
 * @property string $type
 *
 *
 */
class InvoiceTransfer extends AbstractTransfer
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
  'id_order_unit' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'number' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'url' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'type' => 
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
     * @return InvoiceTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\InvoiceTransfer', $data);
    }
}
