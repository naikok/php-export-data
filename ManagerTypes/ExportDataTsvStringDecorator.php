<?php
require_once("ManagerInterface/ExportDataInterface.php");

class ExportDataTsvStringDecorator implements ExportDataInterface
{
    protected $exportDataInterface;

    public function __construct($exportDataInterface)
    {
        $this->exportDataInterface = $exportDataInterface;
    }

    public function initialize()
    {
        $this->exportDataInterface->stringData = '';
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
        $this->exportDataInterface->stringData .= $data;
    }

    public function finalize()
    {
        echo $this->getString();
    }

    public function getString()
    {
        return $this->exportDataInterface->stringData;
    }

    public function generateRow($row)
    {
        return $this->exportDataInterface->generateRow($row);
    }

    public function generateHeader() {}

    public function generateFooter() {}
}