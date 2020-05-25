<?php
include "database_engine.php";
session_start();

$functionNumber=$_POST['functionNumber'];

switch ($functionNumber) {

	case 1:
		 getDropDownListNewEmployee($_POST['listNumberField']);
	break;
	case 2:
		 saveNewEmployeeInfo($_POST['DatasourceNewEmployee']);
	break;
	
}


function getDropDownListNewEmployee($listNumber){

$SQLstring="";

switch ($listNumber) {

	case 0:
	$SQLstring="SELECT ProcessName FROM TB_ProcessList ORDER BY ProcessName ASC";
	break;
	case 1:
	$SQLstring="SELECT BandwidthCategoryVal FROM TB_BandwidthCategory";	
	break;
	case 2:
	$SQLstring="SELECT PositionCategoryVal FROM TB_PositionCategory ORDER BY PositionCategoryVal ASC";		
	break;
	case 3:
	$SQLstring="SELECT DISTINCT AssignmentName FROM TB_AssignmentList ORDER BY AssignmentName ASC";	
	break;
	case 4:
	$SQLstring="SELECT BaseCity +"."'-'"."+ Location FROM TB_LocationDetails";	
	break;
	case 5:
	$SQLstring="SELECT Channel FROM TB_Channel";	
	break;
	case 6:
	$SQLstring="SELECT AccountName FROM TB_AccountList";
	break;


}

try{
$ClassConnection=new DB_Connection();
$connection= $ClassConnection -> Open_connection(1);

$dataVal[]=null;
$index=0;





$execQuery=odbc_exec($connection, $SQLstring);

while(odbc_fetch_row($execQuery)){

$dataVal[$index]=odbc_result($execQuery, odbc_field_name($execQuery, 1));

$index++;
}

echo json_encode($dataVal);
$ClassConnection -> Close_connection($connection); 
}catch(Exception $e){
	
	echo json_encode(0);
}

}

function saveNewEmployeeInfo($DataSource){

	$SQLstring="";

	try{

	$ClassConnection=new DB_Connection();
	$connection= $ClassConnection -> Open_connection(1);



	

	$SQLstring="SELECT AccountCode FROM  TB_AccountList WHERE AccountName like "."'".$DataSource[4]."'"."";	


	$execQuery=odbc_exec($connection, $SQLstring);

	while(odbc_fetch_row($execQuery)){
	$accountNum=odbc_result($execQuery, odbc_field_name($execQuery, 1));

	}	

	$ClassConnection -> Close_connection($connection); 

	$connection= $ClassConnection -> Open_connection(1);

	$SQLstring="SELECT Code FROM  TB_BandwidthCategory WHERE BandwidthCategoryVal like "."'".$DataSource[6]."'"."";	


	$execQuery=odbc_exec($connection, $SQLstring);

	while(odbc_fetch_row($execQuery)){
	$BandNum=odbc_result($execQuery, odbc_field_name($execQuery, 1));

	}	

	$ClassConnection -> Close_connection($connection); 

	$connection= $ClassConnection -> Open_connection(1);

	$SQLstring="SELECT Code FROM  TB_PositionCategory WHERE PositionCategoryVal like "."'".$DataSource[7]."'"."";	


	$execQuery=odbc_exec($connection, $SQLstring);

	while(odbc_fetch_row($execQuery)){
	$PosNum=odbc_result($execQuery, odbc_field_name($execQuery, 1));

	}	

	$ClassConnection -> Close_connection($connection); 


	$connection= $ClassConnection -> Open_connection(1);

	$SQLstring="SELECT AssignmentCode FROM  TB_AssignmentList WHERE AssignmentName like "."'".$DataSource[8]."'"."";	


	$execQuery=odbc_exec($connection, $SQLstring);

	while(odbc_fetch_row($execQuery)){
	$assignmentNum=odbc_result($execQuery, odbc_field_name($execQuery, 1));

	}	

	$ClassConnection -> Close_connection($connection); 

	$connection= $ClassConnection -> Open_connection(1);

	$SQLstring="SELECT ChannelCode FROM  TB_Channel WHERE Channel like "."'".$DataSource[12]."'"."";	


	$execQuery=odbc_exec($connection, $SQLstring);

	while(odbc_fetch_row($execQuery)){
	$channelNum=odbc_result($execQuery, odbc_field_name($execQuery, 1));

	}	

	$ClassConnection -> Close_connection($connection); 


	$connection= $ClassConnection -> Open_connection(1);

	$SQLstring="SELECT * FROM TB_Access WHERE EmployeeID like "."'".$DataSource[0]."'"."";

	$alreadyExist=false;

	$execQuery=odbc_exec($connection, $SQLstring);

	while(odbc_fetch_row($execQuery)){
	
		$alreadyExist=true;
	}	

	$ClassConnection -> Close_connection($connection); 

	if($alreadyExist==false){

	$connection= $ClassConnection -> Open_connection(1);

	if($DataSource[7]=="Associate-Customer Support" || $DataSource[7]=="Agent"){
			$AccessCode="1";
		}else{
			$AccessCode="2";
		}

	$SQLstring="INSERT INTO TB_Access (EmployeeID,AccessCode) VALUES (?,?)";


	$prepExec=odbc_prepare($connection,$SQLstring);

    $execQuery=odbc_execute($prepExec,array($DataSource[0],$AccessCode));


	$ClassConnection -> Close_connection($connection); 

	$connection= $ClassConnection -> Open_connection(1);


	$SQLstring="INSERT INTO TB_Information (EmployeeID,FirstName,MiddleName,LastName,Account_Name,Process,Bandwidth,Position,Assignment_Role,HiredDate,Location,Batch,Channel) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";

	 $prepExec=odbc_prepare($connection,$SQLstring);

     $execQuery=odbc_execute($prepExec,array($DataSource[0],ucwords(html_entity_decode(htmlentities($DataSource[1]))),ucwords(html_entity_decode(htmlentities($DataSource[2]))),ucwords(html_entity_decode(htmlentities($DataSource[3]))),$accountNum,$DataSource[5],$BandNum,$PosNum,$assignmentNum,date('Y-m-d',strtotime($DataSource[9])),$DataSource[10],$DataSource[11],$channelNum));

     $rowAffected=@odbc_num_rows($prepExec);

     if( $rowAffected > 0){

     $ClassConnection -> Close_connection($connection); 

     $connection= $ClassConnection -> Open_connection(1);

     	$SQLstring="SELECT TableID FROM TB_Information WHERE EmployeeID like "."'".$DataSource[0]."'"."";

     	$execQuery=odbc_exec($connection, $SQLstring);

		while(odbc_fetch_row($execQuery)){
		$tableID=odbc_result($execQuery, odbc_field_name($execQuery, 1));

		}

		$ClassConnection -> Close_connection($connection); 

		$connection= $ClassConnection -> Open_connection(1);

		$SQLstring="INSERT INTO TB_Credentials (TableID,NetworkID,CompanyEmail) VALUES (?,?,?)";

		$prepExec=odbc_prepare($connection,$SQLstring);

		$execQuery=odbc_execute($prepExec,array($tableID,strtoupper(html_entity_decode(htmlentities($DataSource[13]))),html_entity_decode(htmlentities($DataSource[14]))));


		$ClassConnection -> Close_connection($connection); 

		$connection= $ClassConnection -> Open_connection(1);

		$SQLstring="INSERT INTO TB_Hierarchy (TableID,Supervisor1) VALUES (?,?)";

		$prepExec=odbc_prepare($connection,$SQLstring);

		$execQuery=odbc_execute($prepExec,array($tableID,$_SESSION['LastName'].", ".$_SESSION['FirstName']." ".$_SESSION['MiddleName']));


		$ClassConnection -> Close_connection($connection); 

		$connection= $ClassConnection -> Open_connection(1);



		$SQLstring="INSERT INTO TB_State (TableID,Billable,Tenurity,TenureStatus,CurrentStatus,HistoryRemarks) VALUES (?,?,?,?,?,?)";

		$prepExec=odbc_prepare($connection,$SQLstring);

		if($DataSource[7]=="Associate-Customer Support" || $DataSource[7]=="Agent"){
			$TenureStatus="1";
		}else{
			$TenureStatus="3";
		}
		$Remarks="New Hire-".$DataSource[5]." ".date('Y-m-d h:m:s');
		$execQuery=odbc_execute($prepExec,array($tableID,"2","1",$TenureStatus,"Active",$Remarks));

		$ClassConnection -> Close_connection($connection); 


		$connection= $ClassConnection -> Open_connection(1);

		$SQLstring="INSERT INTO TB_ProfilePhoto (TableID) VALUES (?)";

		$prepExec=odbc_prepare($connection,$SQLstring);

		$execQuery=odbc_execute($prepExec,array($tableID));

		$ClassConnection -> Close_connection($connection); 

		echo json_encode(1);

     }

 	}else{

 		echo json_encode(2);
 	}

	}catch(Exception $e){

		echo json_encode(0);
	}

}



?>