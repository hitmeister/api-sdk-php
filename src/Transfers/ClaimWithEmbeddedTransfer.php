<?php
namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property int $id_claim
 * @property int $id_order_unit
 * @property int $id_buyer
 * @property string $ts_created
 * @property string $ts_updated
 * @property string $status
 * @property string $open_reason
 * @property string $callback_phone
 *
 * @property array $messages
 * @property OrderUnitTransfer $order_unit
 * @property BuyerTransfer $buyer
 * @property ItemTransfer $item
 * @property array $files
 *
 */
class ClaimWithEmbeddedTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'id_claim' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'id_order_unit' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
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
  'callback_phone' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'messages' => 
  array (
    'embedded' => true,
    'is_multiple' => true,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\ClaimMessageTransfer',
  ),
  'order_unit' => 
  array (
    'embedded' => true,
    'is_multiple' => false,
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
     * @return ClaimWithEmbeddedTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\ClaimWithEmbeddedTransfer', $data);
    }
}
