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
 *
 */
class ReturnUnitTransfer extends AbstractTransfer
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
);
        return $properties;
    }

    /**
     * @param array $data
     *
     * @return ReturnUnitTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\ReturnUnitTransfer', $data);
    }
}
