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
 * @property CategoryTransfer $parent
 * @property array $children
 * @property array $optional_attributes
 * @property array $mandatory_attributes
 *
 */
class CategoryWithEmbeddedTransfer extends AbstractTransfer
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
  'parent' => 
  array (
    'embedded' => true,
    'is_multiple' => false,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\CategoryTransfer',
  ),
  'children' => 
  array (
    'embedded' => true,
    'is_multiple' => true,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\CategoryTransfer',
  ),
  'optional_attributes' => 
  array (
    'embedded' => true,
    'is_multiple' => true,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\AttributeTransfer',
  ),
  'mandatory_attributes' => 
  array (
    'embedded' => true,
    'is_multiple' => true,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\AttributeTransfer',
  ),
);
        return $properties;
    }

    /**
     * @param array $data
     *
     * @return CategoryWithEmbeddedTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\CategoryWithEmbeddedTransfer', $data);
    }
}
