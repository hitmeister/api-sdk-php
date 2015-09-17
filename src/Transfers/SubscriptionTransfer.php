<?php
namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property int $id_subscription
 * @property string $callback_url
 * @property string $fallback_email
 * @property string $event_name
 * @property boolean $is_active
 *
 *
 */
class SubscriptionTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'id_subscription' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'callback_url' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'fallback_email' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'event_name' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'is_active' => 
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
     * @return SubscriptionTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\SubscriptionTransfer', $data);
    }
}
