<?php
require_once("ManagerInterface/ExportDataInterface.php");

class ExportDataCsvStringDecorator implements ExportDataInterface
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

    public function initialize()
    {
        $this->exportDataInterface->stringData = '';
    }

    public function finalize()
    {
        echo $this->exportDataInterface->stringData;
    }

    public function getType()
    {
        return $this->exportDataInterface->getType();
    }

    public function write($data)
    {
        $this->exportDataInterface->stringData .= $data;
    }

    public function generateFooter(){}

    public function generateHeader(){}

    public function generateRow($row)
    {
        return $this->exportDataInterface->generateRow($row);
    }

    public function addRow($row)
    {
        $this->write($this->generateRow($row));
    }
}