<?php

namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property int $id_ticket_message
 * @property string $id_ticket
 * @property TicketMessageAuthorTransfer $author
 * @property string $text
 * @property string $ts_created
 *
 *
 */
class TicketMessageTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'id_ticket_message' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'id_ticket' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'author' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\TicketMessageAuthorTransfer',
  ),
  'text' => 
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
     * @return TicketMessageTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\TicketMessageTransfer', $data);
    }
}
