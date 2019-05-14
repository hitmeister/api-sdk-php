<?php

namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property string $filename
 * @property string $mime_type
 * @property string $data
 *
 *
 */
class MessageClaimFileTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'filename' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'mime_type' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'data' => 
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
     * @return MessageClaimFileTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\MessageClaimFileTransfer', $data);
    }
}
