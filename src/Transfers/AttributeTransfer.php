<?php
namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property int $id_attribute
 * @property string $name
 * @property string $title
 * @property boolean $is_multiple_allowed
 * @property string $type
 *
 *
 */
class AttributeTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'id_attribute' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'name' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'title' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'is_multiple_allowed' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'type' => 
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
     * @return AttributeTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\AttributeTransfer', $data);
    }
}
