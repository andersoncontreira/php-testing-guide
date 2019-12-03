<?php


namespace Training\Logger\Formatter;

use Monolog\Formatter\FormatterInterface;

/**
 * Class ConsoleFormatter
 *
 * Format log record for console output
 *
 * @package Training\Logger\Formatter
 */
class ConsoleFormatter implements FormatterInterface
{
    /**
     * Method format
     *
     * @param array $record
     *
     * @return string
     *
     */
    public function format(array $record){

        if (!isset($record['message'])) {
            $record['message'] = "";
        }

        $line = "";
        $line .= "[".$record['level_name']."] ";
        $line .= $record['message'];
        $line .= PHP_EOL;

        return $line;
    }

    /**
     * Formats a set of log records.
     *
     * @param  array $records A set of records to format
     *
     * @return mixed The formatted set of records
     */
    public function formatBatch(array $records)
    {
        return $this->format($records);
    }
}