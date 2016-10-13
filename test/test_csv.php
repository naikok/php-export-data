<?php
require_once("../CsvExportDataFactory.php");
$csv = CsvExportDataFactory::makeExportDataBrowser();
$csv->setFileName("csv2.csv");
$data = array(
    array(1,2,3),
    array("asdf","jkl","semi"),
    array("1273623874628374634876","=asdf","10-10"),
    array("2010-01-02 10:00AM","1/1/11","10-10"),
    array("1234","12.34","-123."),
    array("-12345678901234567890","0.0000000000123456789","-"),
);

$csv->initialize();
foreach($data as $row) {
    $csv->addRow($row);
}
$csv->finalize();