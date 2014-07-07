<?php 
require 'excel_reader2.php';
$data = new Spreadsheet_Excel_Reader("books.xls");

$baris = $data->rowcount($sheet_index=0);
for ($i=2; $i<=$baris; $i++) {
  $id = $data->val($i,1);
  $title = $data->val($i,2);
  $author = $data->val($i,3);
  $description = $data->val($i,4);
  $on_sale = $data->val($i,5);
  $cover = $data->val($i,6);
  echo "$id $title $author $description $on_sale $cover <br>";
}