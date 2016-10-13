<?php
require_once("ManagerInterface/ExportDataInterface.php");

class ExportDataExcelStringDecorator implements ExportDataInterface
{
    protected $exportDataInterface;

    public function __construct($exportDataInterface)
    {
        $this->exportDataInterface = $exportDataInterface;
    }

    public function getType()
    {
        return $this->exportDataInterface->getType();
    }

    public function initialize()
    {
        $this->exportDataInterface->stringData = '';
        $this->write($this->generateHeader());
    }

    public function finalize()
    {
        $this->write($this->generateFooter());
        echo $this->exportDataInterface->stringData;
    }

    public function write($data)
    {
        $this->exportDataInterface->stringData .= $data;
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
}