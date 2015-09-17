<?php
namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $company_name
 * @property string $street
 * @property string $house_number
 * @property int $postcode
 * @property string $additional_field
 * @property string $city
 * @property string $phone
 * @property string $country
 *
 *
 */
class AddressTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'first_name' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'last_name' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'gender' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'company_name' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'street' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'house_number' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'postcode' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'additional_field' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'city' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'phone' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'country' => 
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
     * @return AddressTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\AddressTransfer', $data);
    }
}
