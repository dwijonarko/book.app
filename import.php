<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

date_default_timezone_set('Asia/Jakarta');

/** PHPExcel_IOFactory */
require_once dirname(__FILE__) . '/Classes/PHPExcel/IOFactory.php';

$objReader = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objReader->load("books.xlsx");


foreach ($objPHPExcel->getActiveSheet()->getRowIterator(2) as $row){
	$cellIterator = $row->getCellIterator();
	$cellIterator->setIterateOnlyExistingCells(false);
	foreach ($cellIterator as $cell) {
    	echo $cell->getValue()." ";
	}
	echo "<br>";
}
