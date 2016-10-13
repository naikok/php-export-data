<?php
require_once("ManagerInterface/ExportDataInterface.php");

class ExportDataTsvBrowserDecorator implements ExportDataInterface
{
    protected $exportDataInterface;

    public function __construct($exportDataInterface)
    {
        $this->exportDataInterface = $exportDataInterface;
    }

    public function initialize()
    {
        $this->sendHttpHeaders();
    }

    public function getType()
    {
        return $this->exportDataInterface->getType();
    }

    public function addRow($row)
    {
        $this->write($this->generateRow($row));
    }

    public function setFileName($filename)
    {
        $this->exportDataInterface->filename = $filename;
    }

    public function write($data)
    {
        echo $data;
    }

    public function finalize()
    {
        $this->write($this->generateFooter());
        flush();
    }

    public function getString()
    {
        return $this->stringData;
    }

    public function generateRow($row)
    {
        return $this->exportDataInterface->generateRow($row);
    }

    public function generateHeader() {}

    public function generateFooter() {}

    public function sendHttpHeaders()
    {
        header("Content-type: text/tab-separated-values");
        header("Content-Disposition: attachment; filename=".basename($this->exportDataInterface->filename));
    }
}