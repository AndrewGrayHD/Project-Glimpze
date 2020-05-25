<?php

include "php/database_engine.php";
include "C:\\xampp\\php\\pear\\PEAR\\config.php";
session_start();


function prepareImageDBString($filepath)
{
    $out = 'null';
    $handle = @fopen($filepath, 'rb');
    if ($handle)
    {
        $content = @fread($handle, filesize($filepath));
        $content = bin2hex($content);
        @fclose($handle);
        $out = "0x".$content;
    }
    return $out;
}


$ClassConnection=new DB_Connection();
$connection= $ClassConnection -> Open_connection(1);

if ($connection){


$invidualInfo=$_SESSION['IndividualInfo'];

$filename=$_FILES['phtoFileName']['name'];
$target_dir="upload/";
$targetFile=$target_dir.basename($_FILES['phtoFileName']['name']);
$FileType=strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

$extension_array=array("jpg","jpeg","png","gif");

if (in_array($FileType, $extension_array)){
//$fileImage64=base64_encode(file_get_contents($_FILES['phtoFileName']['tmp_name']));
$fileImage64= prepareImageDBString($_FILES['phtoFileName']['tmp_name']);
if($fileImage64!=null || $fileImage64 != ""){
//$imageBase64='data:image/'.$FileType.';base64,'.$fileImage64;

//$SQLstring="Update photoTable set photoTable.PhotoValue='".$imageBase64."' FROM (SELECT a.PhotoValue FROM TB_ProfilePhoto a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like '".$invidualInfo[0]."' ) as photoTable";

$SQLstring="Update photoTable set photoTable.PhotoValue=".$fileImage64.",photoTable.Photoextension="."'".$FileType."'"." FROM (SELECT a.PhotoValue,a.Photoextension FROM TB_ProfilePhoto a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like '".$invidualInfo[0]."' ) as photoTable";

$execQuery=odbc_exec($connection, $SQLstring);

$rowAffected=odbc_num_rows($execQuery);

if($rowAffected > 0){

echo '<script type="text/javascript">alert("Successfully changed the profile photo.");</script>';

}else{

echo '<script type="text/javascript">alert("Error on changing profile photo");</script>';
}

}else{

echo '<script type="text/javascript">alert("Uploaded file was empty");</script>';

}

}else{

echo '<script type="text/javascript">alert("Error - Uploaded file was not on required format (.jpg,.jpeg,.png,.gif)");</script>';

}

echo '<script type="text/javascript">window.location = "EmpInfo.php";</script>';

}


?>