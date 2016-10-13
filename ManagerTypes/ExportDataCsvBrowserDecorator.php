<?php
require_once("ManagerInterface/ExportDataInterface.php");

class ExportDataCsvBrowserDecorator implements ExportDataInterface
{
    protected $exportDataInterface;

    public function __construct($exportDataInterface)
    {
        $this->exportDataInterface = $exportDataInterface;
    }

    public function setFileName($filename)
    {
        $this->exportDataInterface->filename = $filename;
    }

    public function addRow($row)
    {
        $this->write($this->generateRow($row));
    }

    public function getType()
    {
        return $this->exportDataInterface->getType();
    }

    public function initialize()
    {
        $this->sendHttpHeaders();
    }

    public function finalize()
    {
        flush();
    }

    public function write($data)
    {
        echo $data;
    }

    public function generateFooter(){}

    public function generateHeader(){}

    public function generateRow($row)
    {
        return $this->exportDataInterface->generateRow($row);
    }

    public function sendHttpHeaders()
    {
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=".basename($this->exportDataInterface->filename));
    }
}