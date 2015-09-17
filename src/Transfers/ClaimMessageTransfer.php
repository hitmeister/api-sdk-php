<?php
namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property int $id_claim_message
 * @property int $id_claim
 * @property ClaimMessageAuthorTransfer $author
 * @property string $text
 * @property string $ts_created
 *
 *
 */
class ClaimMessageTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'id_claim_message' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'id_claim' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'author' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
    'type' => 'Hitmeister\\Component\\Api\\Transfers\\ClaimMessageAuthorTransfer',
  ),
  'text' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'ts_created' => 
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
     * @return ClaimMessageTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\ClaimMessageTransfer', $data);
    }
}
