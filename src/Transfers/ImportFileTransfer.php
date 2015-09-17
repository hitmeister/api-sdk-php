<?php
namespace Hitmeister\Component\Api\Transfers;

/**
 * This class was auto generated. Please, do not modify it!
 *
 * @codeCoverageIgnore
 *
 * @property int $id_import_file
 * @property string $uri
 * @property string $status
 * @property string $type
 * @property string $note
 * @property int $total_lines
 * @property int $current_line
 * @property string $ts_created
 * @property string $ts_updated
 * @property string $ts_last_row_updated
 * @property string $ts_completed
 * @property int $error_count
 *
 *
 */
class ImportFileTransfer extends AbstractTransfer
{
    /**
     * @return array
     */
    public function getProperties()
    {
        static $properties = array (
  'id_import_file' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'uri' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'status' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'type' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'note' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'total_lines' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'current_line' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'ts_created' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'ts_updated' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'ts_last_row_updated' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'ts_completed' => 
  array (
    'embedded' => false,
    'is_multiple' => false,
  ),
  'error_count' => 
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
     * @return ImportFileTransfer
     */
    public static function make(array $data)
    {
        return AbstractTransfer::makeTransfer('Hitmeister\Component\Api\Transfers\ImportFileTransfer', $data);
    }
}
