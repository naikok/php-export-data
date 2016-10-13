<?php
require_once("ExportDataFactoryInterface.php");
require_once("ManagerTypes/ExportDataCsv.php");
require_once("ManagerTypes/ExportDataCsvFileDecorator.php");
require_once("ManagerTypes/ExportDataCsvBrowserDecorator.php");
require_once("ManagerTypes/ExportDataCsvStringDecorator.php");

class CsvExportDataFactory implements ExportDataFactoryInterface {

    private $context = "Csv";

    public static function makeExportDataBrowser()
    {
        $objExportDataCsv = new ExportDataCsv();
        return new ExportDataCsvBrowserDecorator($objExportDataCsv);
    }

    public static function makeExportDataFile()
    {
        $objExportDataCsv = new ExportDataCsv();
        return new ExportDataCsvFileDecorator($objExportDataCsv);
    }

    public static function makeExportDataString()
    {
        $objExportDataCsv = new ExportDataCsv();
        return new ExportDataCsvStringDecorator($objExportDataCsv);
    }
}

