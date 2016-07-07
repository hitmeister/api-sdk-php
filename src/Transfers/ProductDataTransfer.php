<?php

namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property array $ean
 * @property array $title
 * @property array $category
 * @property array $additional_categories
 * @property array $description
 * @property array $short_description
 * @property array $mpn
 * @property array $list_price
 * @property array $picture
 *
 *
 */
class ProductDataTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'ean' => 
  array (
    'embedded' => false,
    'is_multiple' => true,
  ),
  'title' => 
  array (
    'embedded' => false,
    'is_multiple' => true,
  ),
  'category' => 
  array (
    'embedded' => false,
    'is_multiple' => true,
  ),
  'additional_categories' => 
  array (
    'embedded' => false,
    'is_multiple' => true,
  ),
  'description' => 
  array (
    'embedded' => false,
    'is_multiple' => true,
  ),
  'short_description' => 
  array (
    'embedded' => false,
    'is_multiple' => true,
  ),
  'mpn' => 
  array (
    'embedded' => false,
    'is_multiple' => true,
  ),
  'list_price' => 
  array (
    'embedded' => false,
    'is_multiple' => true,
  ),
  'picture' => 
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
     * @return ProductDataTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\ProductDataTransfer', $data);
    }
}
