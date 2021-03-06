<?php
require_once("ExportDataFactoryInterface.php");
require_once("ManagerTypes/ExportDataTsv.php");
require_once("ManagerTypes/ExportDataTsvFileDecorator.php");
require_once("ManagerTypes/ExportDataTsvBrowserDecorator.php");
require_once("ManagerTypes/ExportDataTsvStringDecorator.php");

class TsvExportDataFactory implements ExportDataFactoryInterface
{
    private $context = "Tsv";

    public static function makeExportDataBrowser()
    {
        $objExportDataTsv = new ExportDataTsv();
        return new ExportDataTsvBrowserDecorator($objExportDataTsv);
    }

    public static function makeExportDataFile()
    {
        $objExportDataTsv = new ExportDataTsv();
        return new ExportDataTsvFileDecorator($objExportDataTsv);
    }

    public static function makeExportDataString()
    {
        $objExportDataTsv = new ExportDataTsv();
        return new ExportDataTsvStringDecorator($objExportDataTsv);
    }
}
