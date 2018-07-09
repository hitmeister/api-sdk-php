<?php

namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property string $ts_from
 * @property string $ts_to
 *
 *
 */
class ReportRequestSalesNewTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
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
     * @return ReportRequestSalesNewTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\ReportRequestSalesNewTransfer', $data);
    }
}
