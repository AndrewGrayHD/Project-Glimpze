<?php

class DB_Connection{



function Open_connection($databaseName){

 $server="PHQCEAPCTR777\SQLEXPRESS";
 $database="";
 $user="MIS";
 $password="NovembeR2020@@@";


if($databaseName==1){
$database="DB_Employee_Management_System";
}else if($databaseName==2){
$database="DB_Employee_Management_System_Notification";
}else if($databaseName==3){
$database="DB_Employee_Management_System_Logs_History";
}

$connection= odbc_connect("Driver={SQL Server Native Client 11.0};Server=$server;Database=$database;",$user,$password);

return  $connection;

	
}

function Close_connection($connection){

odbc_close($connection);

}

}


?>