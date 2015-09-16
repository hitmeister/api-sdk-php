<?php
namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property int $id_order_unit
 * @property string $text
 *
 *
 */
class ClaimAddTransfer extends AbstractTransfer
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
    'is_multiple' => false,
  ),
  'text' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
);
        return $properties;
    }
}
