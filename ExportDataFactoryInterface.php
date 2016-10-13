<?php

interface ExportDataFactoryInterface
{
    public static function makeExportDataBrowser();
    public static function makeExportDataFile();
    public static function makeExportDataString();
}