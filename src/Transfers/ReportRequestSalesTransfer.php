<?php
namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property array $status
 * @property string $ts_from
 * @property string $ts_to
 *
 *
 */
class ReportRequestSalesTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'status' => 
  array (
    'embedded' => false,
    'is_multiple' => true,
  ),
  'ts_from' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'ts_to' => 
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
     * @return ReportRequestSalesTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\ReportRequestSalesTransfer', $data);
    }
}
