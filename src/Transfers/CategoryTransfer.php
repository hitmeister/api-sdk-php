<?php
namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property int $id_category
 * @property string $name
 * @property int $id_parent_category
 * @property string $title_singular
 * @property string $title_plural
 * @property int $level
 * @property string $url
 * @property string $shipping_category
 * @property float $variable_fee
 * @property int $fixed_fee
 * @property float $vat
 *
 *
 */
class CategoryTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'id_category' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'name' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'id_parent_category' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'title_singular' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'title_plural' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'level' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'url' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'shipping_category' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'variable_fee' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'fixed_fee' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'vat' => 
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
     * @return CategoryTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\CategoryTransfer', $data);
    }
}
