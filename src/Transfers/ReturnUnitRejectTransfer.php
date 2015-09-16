<?php
namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property string $message
 *
 *
 */
class ReturnUnitRejectTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'message' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
);
        return $properties;
    }
}
