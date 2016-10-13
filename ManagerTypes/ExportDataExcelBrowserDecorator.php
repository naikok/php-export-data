<?php
require_once("ManagerInterface/ExportDataInterface.php");

class ExportDataExcelBrowserDecorator implements ExportDataInterface
{
    protected $exportDataInterface;

    public function __construct($exportDataInterface)
    {
        $this->exportDataInterface = $exportDataInterface;
    }

    public function initialize()
    {
        $this->sendHttpHeaders();
        $this->write($this->generateHeader());
    }

    public function finalize()
    {
        $this->write($this->generateFooter());
        flush();
    }

    public function getType()
    {
        return $this->exportDataInterface->getType();
    }

    public function write($data)
    {
        echo $data;
    }

    public function setFileName($filename)
    {
        $this->exportDataInterface->filename = $filename;
    }

    public function addRow($row)
    {
        $this->write($this->generateRow($row));
    }

    public function generateHeader()
    {
        return $this->exportDataInterface->generateHeader();
    }

    public function generateFooter()
    {
        return $this->exportDataInterface->generateFooter();
    }

    public function generateRow($row)
    {
        return $this->exportDataInterface->generateRow($row);
    }

    public function sendHttpHeaders()
    {
        header("Content-Type: application/xls; charset=\"" . $this->exportDataInterface->encoding ."\"");
        header("Content-Disposition: inline; filename=\"" . basename($this->exportDataInterface->filename) . "\"");
        header("Pragma: no-cache");
        header("Expires: 0");
    }
}