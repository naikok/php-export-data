<?php
require_once("ManagerInterface/ExportDataInterface.php");

class ExportDataCsv implements ExportDataInterface
{
    public $stringData; // stringData so far, used if export string mode
    public $tempFile; // handle to temp file (for export file mode)
    public $tempFilename; // temp file name and path (for export file mode)
    static $type = null;

    public function  __construct($filename = "exportdata")
    {
        $this->filename = $filename;
        self::$type = "Csv";
    }

    public function getType()
    {
        return self::$type;
    }

    public function generateFooter(){}

    public function generateHeader(){}

    public function generateRow($row)
    {
        foreach ($row as $key => $value) {
            // Escape inner quotes and wrap all contents in new quotes.
            // Note that we are using \" to escape double quote not ""
            $row[$key] = '"' . str_replace('"', '\"', $value) . '"';
        }

        return implode(",", $row) . "\n";
    }
}