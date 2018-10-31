<?php

namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property array $id_order_unit
 * @property string $topic
 * @property string $message
 *
 *
 */
class TicketOpenTransfer extends AbstractTransfer
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
  'topic' => 
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
     * @return TicketOpenTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\TicketOpenTransfer', $data);
    }
}
