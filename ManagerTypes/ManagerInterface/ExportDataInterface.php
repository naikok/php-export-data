<?php

interface ExportDataInterface {

   // public function initialize();

    public function generateFooter();

    public function generateHeader();

    public function generateRow($row);

    //public function sendHttpHeaders();

    //public function write($data);

   // public function addRow($row);

    public function getType();

   // public function finalize();

}