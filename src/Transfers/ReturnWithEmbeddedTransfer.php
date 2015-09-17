<?php
namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property int $id_return
 * @property string $ts_created
 * @property string $ts_updated
 * @property string $tracking_provider
 * @property string $tracking_code
 * @property string $status
 *
 * @property array $units
 * @property BuyerTransfer $buyer
 *
 */
class ReturnWithEmbeddedTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'id_return' => 
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
  'tracking_provider' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'tracking_code' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'status' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'units' => 
  array (
    'embedded' => true,
    'is_multiple' => true,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\ReturnUnitTransfer',
  ),
  'buyer' => 
  array (
    'embedded' => true,
    'is_multiple' => false,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\BuyerTransfer',
  ),
);
        return $properties;
    }

    /**
     * @param array $data
     *
     * @return ReturnWithEmbeddedTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\ReturnWithEmbeddedTransfer', $data);
    }
}
