<?php

include "C:\\xampp\\php\\pear\\PEAR\\config.php";
session_start();



$Targetfilename=$_SESSION['EmployeeID'] .date("Ymd His").".xls";
$targetDir="BulkUpdateFile/";

$finalFilename=$targetDir.basename($Targetfilename);


if($_FILES['BulkUpdateExcelFileName']['name'] != NULL && $_FILES['BulkUpdateExcelFileName']['name'] !=""){

$FileType=strtolower(pathinfo($_FILES['BulkUpdateExcelFileName']['name'],PATHINFO_EXTENSION));

$extension_array=array("xls","xlsx","xlsm","xlsb");

if (in_array($FileType, $extension_array)){

//$ExcelFile=realpath(file_get_contents($_FILES['BulkUpdateExcelFileName']['tmp_name']));
//$ExcelDir=dirname(file_get_contents($_FILES['BulkUpdateExcelFileName']['tmp_name']));
 
move_uploaded_file($_FILES['BulkUpdateExcelFileName']['tmp_name'], $finalFilename);
$ExcelFile=realpath($finalFilename);
$ExcelDir=dirname($ExcelFile);


//$connection= odbc_connect("Driver={Microsoft Excel Driver(*.xls,*.xlsx,*.xlsm,*.xlsb)};Dbq=$ExcelFile","","");

if($connection){


}else{

echo '<script type="text/javascript">alert("Bulk update failed!");</script>';

}



}else{

echo '<script type="text/javascript">alert("Error - Uploaded file was not on required format (.xls,.xlsx,.xlsm,.xlsb)");</script>';

}


}else{

echo '<script type="text/javascript">alert("Uploaded file was empty");</script>';

}

//echo '<script type="text/javascript">window.location = "mslt.php";</script>';


function csvstr($fields){

global $finalFilename;

$f=fopen($finalFilename, 'r+');

if(fputcsv($f, $fields)===false){

return false;

}

rewind($f);
$csv_line=stream_get_contents($f);
return rtrim($csv_line);

}

?>