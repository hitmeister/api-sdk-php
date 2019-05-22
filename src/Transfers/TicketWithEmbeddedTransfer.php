<?php

namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property string $id_ticket
 * @property array $ids_order_units
 * @property int $id_buyer
 * @property string $ts_created
 * @property string $ts_updated
 * @property string $status
 * @property string $open_reason
 * @property string $topic
 * @property string $callback_phone
 * @property boolean $is_seller_responsible
 *
 * @property array $messages
 * @property array $order_units
 * @property BuyerTransfer $buyer
 * @property ItemTransfer $item
 * @property array $files
 *
 */
class TicketWithEmbeddedTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'id_ticket' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'ids_order_units' => 
  array (
    'embedded' => false,
    'is_multiple' => true,
  ),
  'id_buyer' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'ts_created' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'ts_updated' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'status' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'open_reason' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'topic' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'callback_phone' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'is_seller_responsible' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'messages' => 
  array (
    'embedded' => true,
    'is_multiple' => true,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\TicketMessageTransfer',
  ),
  'order_units' => 
  array (
    'embedded' => true,
    'is_multiple' => true,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\OrderUnitTransfer',
  ),
  'buyer' => 
  array (
    'embedded' => true,
    'is_multiple' => false,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\BuyerTransfer',
  ),
  'item' => 
  array (
    'embedded' => true,
    'is_multiple' => false,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\ItemTransfer',
  ),
  'files' => 
  array (
    'embedded' => true,
    'is_multiple' => true,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\ClaimFileTransfer',
  ),
);
        return $properties;
    }

    /**
     * @param array $data
     *
     * @return TicketWithEmbeddedTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\TicketWithEmbeddedTransfer', $data);
    }
}
