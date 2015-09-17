<?php
namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property ItemAddTransfer $item
 * @property int $price
 * @property int $id_category
 * @property array $keywords
 *
 *
 */
class CategoryDecideTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'item' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\ItemAddTransfer',
  ),
  'price' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'id_category' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'keywords' => 
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
     * @return CategoryDecideTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\CategoryDecideTransfer', $data);
    }
}
