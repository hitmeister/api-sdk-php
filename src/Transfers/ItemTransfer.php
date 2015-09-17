<?php
namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property int $id_item
 * @property string $title
 * @property array $eans
 * @property int $id_category
 * @property string $main_picture
 * @property string $manufacturer
 * @property string $url
 *
 *
 */
class ItemTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'id_item' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'title' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'eans' => 
  array (
    'embedded' => false,
    'is_multiple' => true,
  ),
  'id_category' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'main_picture' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'manufacturer' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'url' => 
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
     * @return ItemTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\ItemTransfer', $data);
    }
}
