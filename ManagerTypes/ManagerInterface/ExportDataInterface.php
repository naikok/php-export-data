<?php

interface ExportDataInterface 
{
   public function generateFooter();
   public function generateHeader();
   public function generateRow($row);
   public function getType();
}
