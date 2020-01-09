<?php

namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property int $id_order_unit
 * @property ShipmentInformationTransfer $shipment_information
 *
 *
 */
class OrderUnitShipmentTransfer extends AbstractTransfer
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
  'shipment_information' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\ShipmentInformationTransfer',
  ),
);
        return $properties;
    }

    /**
     * @param array $data
     *
     * @return OrderUnitShipmentTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\OrderUnitShipmentTransfer', $data);
    }
}
