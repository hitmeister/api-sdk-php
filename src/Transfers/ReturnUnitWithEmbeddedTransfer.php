<?php
namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property int $id_return_unit
 * @property int $id_return
 * @property int $id_order_unit
 * @property string $ts_created
 * @property string $status
 * @property string $note
 * @property string $reason
 *
 * @property ItemTransfer $item
 * @property ReturnTransfer $return
 * @property OrderUnitTransfer $order_unit
 * @property ClaimTransfer $claim
 *
 */
class ReturnUnitWithEmbeddedTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'id_return_unit' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'id_return' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'id_order_unit' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'ts_created' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'status' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'note' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'reason' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'item' => 
  array (
    'embedded' => true,
    'is_multiple' => false,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\ItemTransfer',
  ),
  'return' => 
  array (
    'embedded' => true,
    'is_multiple' => false,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\ReturnTransfer',
  ),
  'order_unit' => 
  array (
    'embedded' => true,
    'is_multiple' => false,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\OrderUnitTransfer',
  ),
  'claim' => 
  array (
    'embedded' => true,
    'is_multiple' => false,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\ClaimTransfer',
  ),
);
        return $properties;
    }

    /**
     * @param array $data
     *
     * @return ReturnUnitWithEmbeddedTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\ReturnUnitWithEmbeddedTransfer', $data);
    }
}
