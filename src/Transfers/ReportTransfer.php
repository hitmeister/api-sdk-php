<?php
namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property int $id_report
 * @property string $status
 * @property string $date_requested
 * @property string $url
 * @property array $params
 *
 *
 */
class ReportTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'id_report' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'status' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'date_requested' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'url' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'params' => 
  array (
    'embedded' => false,
    'is_multiple' => true,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\ReportParamTransfer',
  ),
);
        return $properties;
    }

    /**
     * @param array $data
     *
     * @return ReportTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\ReportTransfer', $data);
    }
}
