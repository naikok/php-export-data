<?php
require_once("ExportDataFactoryInterface.php");
require_once("ManagerTypes/ExportDataExcel.php");
require_once("ManagerTypes/ExportDataExcelFileDecorator.php");
require_once("ManagerTypes/ExportDataExcelBrowserDecorator.php");
require_once("ManagerTypes/ExportDataExcelStringDecorator.php");

class ExcelExportDataFactory implements ExportDataFactoryInterface {

    private $context = "Excel";

    public static function makeExportDataBrowser()
    {
        $objExportDataExcel = new ExportDataExcel();
        return new ExportDataExcelBrowserDecorator($objExportDataExcel);
    }

    public static function makeExportDataFile()
    {
        $objExportDataExcel = new ExportDataExcel();
        return new ExportDataExcelFileDecorator($objExportDataExcel);
    }

    public static function makeExportDataString()
    {
        $objExportDataExcel = new ExportDataExcel();
        return new ExportDataExcelStringDecorator($objExportDataExcel);
    }
}

