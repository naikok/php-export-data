<?php
require_once("ManagerInterface/ExportDataInterface.php");

class ExportDataTsv implements ExportDataInterface
{
    public $exportTo; // Set in constructor to one of 'browser', 'file', 'string'
    public $stringData; // stringData so far, used if export string mode
    public $tempFile; // handle to temp file (for export file mode)
    public $tempFilename; // temp file name and path (for export file mode)
    static $type = null;
    public $filename; // file mode: the output file name; browser mode: file name for download; string mode: not used

    public function __construct($exportTo = "browser", $filename = "exportdata")
    {
        if(!in_array($exportTo, array('browser','file','string') )) {
            throw new Exception("$exportTo is not a valid ExportData export type");
        }
        $this->exportTo = $exportTo;
        $this->filename = $filename;
        self::$type = "Tsv";
    }

    public function getType()
    {
        return self::$type;
    }

    public function getString()
    {
        return $this->stringData;
    }

    public function generateRow($row)
    {
        foreach ($row as $key => $value) {
            // Escape inner quotes and wrap all contents in new quotes.
            // Note that we are using \" to escape double quote not ""
            $row[$key] = '"'. str_replace('"', '\"', $value) .'"';
        }

       return implode("\t", $row) . "\n";
    }

    public function generateHeader() {}

    public function generateFooter() {}
}