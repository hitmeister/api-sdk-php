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
 *
 */
class TicketTransfer extends AbstractTransfer
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
);
        return $properties;
    }

    /**
     * @param array $data
     *
     * @return TicketTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\TicketTransfer', $data);
    }
}
