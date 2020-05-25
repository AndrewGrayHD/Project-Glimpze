<?php

include "database_engine.php";
session_start();

$ClassConnection=new DB_Connection();
$connection= $ClassConnection -> Open_connection(1);

if (!$connection){

echo '<script type="text/javascript">alert("Error : Failed to connect on database");</script>';

}else{

$landID=$_POST['LanID'];
$password=$_POST['password'];

//LDAP 

//LDAP end


//Get Init user info

$SQLstring="SELECT a.EmployeeID,a.FirstName,a.MiddleName,a.LastName,a.Process,b.PositionCategoryVal,a.Assignment_Role,c.NetworkID,c.CompanyEmail,d.Supervisor1,d.Supervisor2,d.Supervisor3,d.Supervisor4,d.Supervisor5,f.AccesType FROM TB_Information a JOIN TB_PositionCategory b ON a.Position=b.Code JOIN TB_Credentials c ON a.TableID=c.TableID JOIN TB_Hierarchy d ON a.TableID=d.TableID JOIN TB_Access e ON a.EmployeeID=e.EmployeeID JOIN TB_AccessDescription f ON e.AccessCode=f.AccessCode WHERE c.NetworkID="."'".$landID."'"."";

$execQuery=odbc_exec($connection, $SQLstring);
$SuccessFullyLogin=FALSE;


while(odbc_fetch_row($execQuery)){

$_SESSION['EmployeeID']=odbc_result($execQuery, odbc_field_name($execQuery, 1));
$_SESSION['FirstName']=odbc_result($execQuery, odbc_field_name($execQuery, 2));
$_SESSION['MiddleName']=odbc_result($execQuery, odbc_field_name($execQuery, 3));
$_SESSION['LastName']=odbc_result($execQuery, odbc_field_name($execQuery, 4));
$_SESSION['Process']=odbc_result($execQuery, odbc_field_name($execQuery, 5));
$_SESSION['Position']=odbc_result($execQuery, odbc_field_name($execQuery, 6));
$_SESSION['Assignment_Role']=odbc_result($execQuery, odbc_field_name($execQuery, 7));
$_SESSION['NetworkID']=odbc_result($execQuery, odbc_field_name($execQuery, 8));
$_SESSION['CompanyEmail']=odbc_result($execQuery, odbc_field_name($execQuery, 9));
$_SESSION['Supervisor1']=odbc_result($execQuery, odbc_field_name($execQuery, 10));
$_SESSION['Supervisor2']=odbc_result($execQuery, odbc_field_name($execQuery, 11));
$_SESSION['Supervisor3']=odbc_result($execQuery, odbc_field_name($execQuery, 12));
$_SESSION['Supervisor4']=odbc_result($execQuery, odbc_field_name($execQuery, 13));
$_SESSION['Supervisor5']=odbc_result($execQuery, odbc_field_name($execQuery, 14));
$_SESSION['AccesType']=odbc_result($execQuery, odbc_field_name($execQuery, 15));

$SuccessFullyLogin=TRUE;

}

if ($SuccessFullyLogin){

	//mslt.php ini
	$_SESSION['msltDatable']=null;
	$_SESSION['msltDatableIterate']=0;
	$_SESSION['IndividualInfo']=null;

	


	echo json_encode(1);
}else{
	echo json_encode(0);
}

$ClassConnection -> Close_connection($connection);	

}

//End

?>