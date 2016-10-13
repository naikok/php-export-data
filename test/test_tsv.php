<?php
require_once("../TsvExportDataFactory.php");

$tsv = TsvExportDataFactory::makeExportDataString();
$tsv->setFileName("test.tsv");
$data = array(
	array(1,2,3),
	array("asdf","jkl","semi"),
	array("1273623874628374634876","=asdf","10-10"),
	array("2010-01-02 10:00AM","1/1/11","10-10"),
	array("1234","12.34","-123."),
	array("-12345678901234567890","0.0000000000123456789","-"),
);

$tsv->initialize();
foreach($data as $row) {
	$tsv->addRow($row);
}
$tsv->finalize();
