<?php

namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property string $id_ticket
 * @property string $text
 * @property boolean $interim_notice
 *
 *
 */
class TicketMessageAddTransfer extends AbstractTransfer
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
  'text' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'interim_notice' => 
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
     * @return TicketMessageAddTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\TicketMessageAddTransfer', $data);
    }
}
