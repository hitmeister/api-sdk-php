<?php
namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property string $title
 * @property string $description
 * @property string $manufacturer
 * @property array $pictures
 *
 *
 */
class ItemAddTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'title' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'description' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'manufacturer' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'pictures' => 
  array (
    'embedded' => false,
    'is_multiple' => true,
  ),
);
        return $properties;
    }

    /**
     * @param array $data
     *
     * @return ItemAddTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\ItemAddTransfer', $data);
    }
}
