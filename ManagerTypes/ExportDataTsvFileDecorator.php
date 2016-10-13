<?php
require_once("ManagerInterface/ExportDataInterface.php");

class ExportDataTsvFileDecorator implements ExportDataInterface {

    protected $exportDataInterface;

    public function __construct($exportDataInterface)
    {
        $this->exportDataInterface = $exportDataInterface;
    }

    public function initialize()
    {
        $this->exportDataInterface->tempFilename = tempnam(sys_get_temp_dir(), 'exportdata');
        $this->exportDataInterface->tempFile = fopen($this->exportDataInterface->tempFilename, "w");

        $this->write($this->generateHeader());
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
        fwrite($this->exportDataInterface->tempFile, $data);
    }

    public function finalize()
    {
        $this->write($this->generateFooter());
        fclose($this->exportDataInterface->tempFile);
        rename($this->exportDataInterface->tempFilename, $this->exportDataInterface->filename);
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
}