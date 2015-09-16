<?php
namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property string $date_from
 * @property string $date_to
 *
 *
 */
class ReportRequestBookingsTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'date_from' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'date_to' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
);
        return $properties;
    }
}
