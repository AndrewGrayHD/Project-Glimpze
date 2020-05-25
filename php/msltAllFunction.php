<?php

include "database_engine.php";
session_start();
//All mslt function





$functionNumber=$_POST['functionNumber'];



$accessValue=0;

switch ($_SESSION['AccesType']) {


	case 'Suser':
		$accessValue=1;
		break;
	case 'Supervisor':
		$accessValue=2;
		break;
	case 'Supervisor2':
		$accessValue=3;
		break;
	case 'Manager':
		$accessValue=4;
		break;
	case 'Administrator':
		$accessValue=5;
		break;
	case 'HumanResources':
		$accessValue=6;
		break;
	case 'SuperAdmin':
		$accessValue=7;
		break;
	
}



switch ($functionNumber) {

	case 1:
		ProcessFilter($_SESSION['AccesType']);
	break;
	case 2:
		PositionFilter($_SESSION['AccesType'],$_POST['selectedProcess']);
	break;
	case 3:
		SupervisorFilter($_SESSION['AccesType'],$_POST['selectedProcess'],$_POST['selectedPosition']);
	break;
	case 4:
		StatusFilter();
	break;
	case 5:
		ExtractMasterlist($_SESSION['AccesType'],$_POST['selectedProcess'],$_POST['selectedPosition'],$_POST['selectedSupervisor'],$_POST['selectedStatus'],$_POST['databaseSelection']);
	break;
	case 6:
		SummaryDetails($_POST['empidSelected']);
	break;
	
	

}


//Filtering function

//process
function ProcessFilter($accessType){


$ClassConnection=new DB_Connection();


$connection= $ClassConnection -> Open_connection(1);

if ($connection){




$dataValue[]=null;

if ($accessType=="Supervisor" || $accessType=="Supervisor2" || $accessType=="Manager" ){

$dataValue=explode("/", $_SESSION['Process']);


}else if($accessType=="Administrator" || $accessType=="HumanResources" ||  $accessType=="SuperAdmin"){

$SQLstring="SELECT a.Process FROM TB_Information a ORDER BY a.Process ASC";

$execQuery=odbc_exec($connection, $SQLstring);

$index=0;


while(odbc_fetch_row($execQuery)){

$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

$TempdataValue=explode("/",$fieldValue);

foreach ($TempdataValue as  $value) {
		
		if(in_array ($value, $dataValue)==false){
			$dataValue[$index]=$value;
			$index++;

		}
	
	}

}



}


$ClassConnection -> Close_connection($connection);	
echo json_encode($dataValue);

}

}



//position
function PositionFilter($accessType,$processName){


$ClassConnection=new DB_Connection();


$connection= $ClassConnection -> Open_connection(1);

if ($connection){




	$dataValue[]=null;
	$SQLstring="";

	if ($accessType=="Supervisor"){

		$supervisorEmpName=$_SESSION['LastName'].", ".$_SESSION['FirstName'];
		if ($_SESSION['MiddleName']!="" && $_SESSION['MiddleName']!=null){

			$supervisorEmpName=$supervisorEmpName." ".$_SESSION['MiddleName'];
		}

		if($processName=="--All--"){
			
			
			$index=0;

		

			$SQLstring="SELECT c.PositionCategoryVal  FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code JOIN TB_Access d ON a.EmployeeID=d.EmployeeID WHERE "."'".$supervisorEmpName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5) AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.")  ORDER BY c.PositionCategoryVal ASC";
			
			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $dataValue)==false){
			$dataValue[$index]=$fieldValue;
			$index++;

		
				}

		   }

		




		}else{

				$SQLstring="SELECT c.PositionCategoryVal  FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code JOIN TB_Access d ON a.EmployeeID=d.EmployeeID WHERE "."'".$supervisorEmpName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5) AND a.Process like "."'%".$processName."%'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.")  ORDER BY c.PositionCategoryVal ASC";
			
			$execQuery=odbc_exec($connection, $SQLstring);
			$index=0;

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $dataValue)==false){
			$dataValue[$index]=$fieldValue;
			$index++;

		
				}

		   }
			
			
	}

			

	}else if($accessType=="Supervisor2" || $accessType=="Manager"){

		

		if($processName=="--All--"){

			$loopProcess=explode("/", $processName);
			$index=0;

			for($a=0;$a <  count($loopProcess);$a++){

			$SQLstring="SELECT c.PositionCategoryVal  FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code JOIN TB_Access d ON a.EmployeeID=d.EmployeeID WHERE a.Process like "."'%".$loopProcess[a]."%'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY c.PositionCategoryVal ASC";
			
			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $dataValue)==false){
			$dataValue[$index]=$fieldValue;
			$index++;

		
				}

		   }

		}

	}else{

			$SQLstring="SELECT c.PositionCategoryVal  FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code JOIN TB_Access d ON a.EmployeeID=d.EmployeeID WHERE  a.Process like "."'%".$processName."%'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY c.PositionCategoryVal ASC";
			
			$execQuery=odbc_exec($connection, $SQLstring);
			$index=0;

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $dataValue)==false){
			$dataValue[$index]=$fieldValue;
			$index++;

		
				}

		  }

	 }

	}else if($accessType=="Administrator" ||  $accessType=="SuperAdmin" || $accessType=="HumanResources"){



		if($processName=="--All--"){
			$SQLstring="SELECT c.PositionCategoryVal  FROM TB_Information a JOIN TB_PositionCategory c ON a.Position=c.Code ORDER BY c.PositionCategoryVal ASC";
		}else{

			$SQLstring="SELECT c.PositionCategoryVal  FROM TB_Information a  JOIN TB_PositionCategory c ON a.Position=c.Code WHERE a.Process like "."'%".$processName."%'"." ORDER BY c.PositionCategoryVal ASC";

		}

			$execQuery=odbc_exec($connection, $SQLstring);
			$index=0;

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $dataValue)==false){
			$dataValue[$index]=$fieldValue;
			$index++;

		
				}

		  }

}




$ClassConnection -> Close_connection($connection);	
echo json_encode($dataValue);

}


}



//supervisor
function SupervisorFilter($accessType,$processName,$positionName){

	
$ClassConnection=new DB_Connection();


$connection= $ClassConnection -> Open_connection(1);

if ($connection){



	$dataValue[]=null;
	$SQLstring="";

	$supervisorEmpName=$_SESSION['LastName'].", ".$_SESSION['FirstName'];
		if ($_SESSION['MiddleName']!="" && $_SESSION['MiddleName']!=null){

			$supervisorEmpName=$supervisorEmpName." ".$_SESSION['MiddleName'];
		}



if($accessType=="Supervisor"){

		if ($processName=="--All--" && $positionName=="--All--"){

			$index=0;

			$SQLstring="SELECT CASE WHEN b.Supervisor1 NOT LIKE '-' AND b.Supervisor1 IS NOT NULL THEN b.Supervisor1 WHEN b.Supervisor2 NOT LIKE '-' AND b.Supervisor2 IS NOT NULL THEN b.Supervisor2 WHEN b.Supervisor3 NOT LIKE '-' AND b.Supervisor3 IS NOT NULL THEN b.Supervisor3 WHEN b.Supervisor4 NOT LIKE '-' AND b.Supervisor4 IS NOT NULL THEN b.Supervisor4 WHEN b.Supervisor5 NOT LIKE '-' AND b.Supervisor5 IS NOT NULL THEN b.Supervisor5 ELSE '-' END FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code JOIN TB_Access d ON a.EmployeeID=d.EmployeeID WHERE "."'".$supervisorEmpName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5)"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $dataValue)==false){
			$dataValue[$index]=$fieldValue;
			$index++;

		
				}

		}


	}else if($processName=="--All--" && $positionName !="--All--"){

	
			$index=0;

			$SQLstring="SELECT CASE WHEN b.Supervisor1 NOT LIKE '-' AND b.Supervisor1 IS NOT NULL THEN b.Supervisor1 WHEN b.Supervisor2 NOT LIKE '-' AND b.Supervisor2 IS NOT NULL THEN b.Supervisor2 WHEN b.Supervisor3 NOT LIKE '-' AND b.Supervisor3 IS NOT NULL THEN b.Supervisor3 WHEN b.Supervisor4 NOT LIKE '-' AND b.Supervisor4 IS NOT NULL THEN b.Supervisor4 WHEN b.Supervisor5 NOT LIKE '-' AND b.Supervisor5 IS NOT NULL THEN b.Supervisor5 ELSE '-' END FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code JOIN TB_Access d ON a.EmployeeID=d.EmployeeID WHERE "."'".$supervisorEmpName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5) AND c.PositionCategoryVal like "."'".$positionName."'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $dataValue)==false){
			$dataValue[$index]=$fieldValue;
			$index++;

		
			}

		}
	
	}else if($processName != "--All--" && $positionName == "--All--"){


			$index=0;

			$SQLstring="SELECT CASE WHEN b.Supervisor1 NOT LIKE '-' AND b.Supervisor1 IS NOT NULL THEN b.Supervisor1 WHEN b.Supervisor2 NOT LIKE '-' AND b.Supervisor2 IS NOT NULL THEN b.Supervisor2 WHEN b.Supervisor3 NOT LIKE '-' AND b.Supervisor3 IS NOT NULL THEN b.Supervisor3 WHEN b.Supervisor4 NOT LIKE '-' AND b.Supervisor4 IS NOT NULL THEN b.Supervisor4 WHEN b.Supervisor5 NOT LIKE '-' AND b.Supervisor5 IS NOT NULL THEN b.Supervisor5 ELSE '-' END FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code JOIN TB_Access d ON a.EmployeeID=d.EmployeeID WHERE "."'".$supervisorEmpName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5) AND a.Process like "."'%".$processName."%'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $dataValue)==false){
			$dataValue[$index]=$fieldValue;
			$index++;

		
			}

		}

	}else{


			$index=0;

			$SQLstring="SELECT CASE WHEN b.Supervisor1 NOT LIKE '-' AND b.Supervisor1 IS NOT NULL THEN b.Supervisor1 WHEN b.Supervisor2 NOT LIKE '-' AND b.Supervisor2 IS NOT NULL THEN b.Supervisor2 WHEN b.Supervisor3 NOT LIKE '-' AND b.Supervisor3 IS NOT NULL THEN b.Supervisor3 WHEN b.Supervisor4 NOT LIKE '-' AND b.Supervisor4 IS NOT NULL THEN b.Supervisor4 WHEN b.Supervisor5 NOT LIKE '-' AND b.Supervisor5 IS NOT NULL THEN b.Supervisor5 ELSE '-' END FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code JOIN TB_Access d ON a.EmployeeID=d.EmployeeID WHERE "."'".$supervisorEmpName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5) AND a.Process like "."'%".$processName."%'"." AND c.PositionCategoryVal like "."'".$positionName."'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $dataValue)==false){
			$dataValue[$index]=$fieldValue;
			$index++;

		
			}

		}

	}

	}else if($accessType=="Supervisor2" || $accessType=="Manager"){


		if ($processName=="--All--" && $positionName=="--All--"){

			$loopProcess=explode("/", $processName);
			$index=0;

			for($a=0;$a < count($loopProcess);$a++){

			$SQLstring="SELECT CASE WHEN b.Supervisor1 NOT LIKE '-' AND b.Supervisor1 IS NOT NULL THEN b.Supervisor1 WHEN b.Supervisor2 NOT LIKE '-' AND b.Supervisor2 IS NOT NULL THEN b.Supervisor2 WHEN b.Supervisor3 NOT LIKE '-' AND b.Supervisor3 IS NOT NULL THEN b.Supervisor3 WHEN b.Supervisor4 NOT LIKE '-' AND b.Supervisor4 IS NOT NULL THEN b.Supervisor4 WHEN b.Supervisor5 NOT LIKE '-' AND b.Supervisor5 IS NOT NULL THEN b.Supervisor5 ELSE '-' END FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code JOIN TB_Access d ON a.EmployeeID=d.EmployeeID WHERE a.Process like "."'%".$loopProcess[a]."%'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $dataValue)==false){
			$dataValue[$index]=$fieldValue;
			$index++;

		
				}
			}
		}


	}else if($processName=="--All--" && $positionName !="--All--"){

			$loopProcess=explode("/", $processName);
			$index=0;

			for($a=0;$a < count($loopProcess);$a++){

			$SQLstring="SELECT CASE WHEN b.Supervisor1 NOT LIKE '-' AND b.Supervisor1 IS NOT NULL THEN b.Supervisor1 WHEN b.Supervisor2 NOT LIKE '-' AND b.Supervisor2 IS NOT NULL THEN b.Supervisor2 WHEN b.Supervisor3 NOT LIKE '-' AND b.Supervisor3 IS NOT NULL THEN b.Supervisor3 WHEN b.Supervisor4 NOT LIKE '-' AND b.Supervisor4 IS NOT NULL THEN b.Supervisor4 WHEN b.Supervisor5 NOT LIKE '-' AND b.Supervisor5 IS NOT NULL THEN b.Supervisor5 ELSE '-' END FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code JOIN TB_Access d ON a.EmployeeID=d.EmployeeID WHERE a.Process like "."'%".$loopProcess[a]."%'"." AND c.PositionCategoryVal like "."'".$positionName."'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $dataValue)==false){
			$dataValue[$index]=$fieldValue;
			$index++;

		
			}
		}
	}
	
	}else if($processName != "--All--" && $positionName == "--All--"){


			$index=0;

			$SQLstring="SELECT CASE WHEN b.Supervisor1 NOT LIKE '-' AND b.Supervisor1 IS NOT NULL THEN b.Supervisor1 WHEN b.Supervisor2 NOT LIKE '-' AND b.Supervisor2 IS NOT NULL THEN b.Supervisor2 WHEN b.Supervisor3 NOT LIKE '-' AND b.Supervisor3 IS NOT NULL THEN b.Supervisor3 WHEN b.Supervisor4 NOT LIKE '-' AND b.Supervisor4 IS NOT NULL THEN b.Supervisor4 WHEN b.Supervisor5 NOT LIKE '-' AND b.Supervisor5 IS NOT NULL THEN b.Supervisor5 ELSE '-' END FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code JOIN TB_Access d ON a.EmployeeID=d.EmployeeID WHERE a.Process like "."'%".$processName."%'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $dataValue)==false){
			$dataValue[$index]=$fieldValue;
			$index++;

		
			}

		}

	}else{


			$index=0;

			$SQLstring="SELECT CASE WHEN b.Supervisor1 NOT LIKE '-' AND b.Supervisor1 IS NOT NULL THEN b.Supervisor1 WHEN b.Supervisor2 NOT LIKE '-' AND b.Supervisor2 IS NOT NULL THEN b.Supervisor2 WHEN b.Supervisor3 NOT LIKE '-' AND b.Supervisor3 IS NOT NULL THEN b.Supervisor3 WHEN b.Supervisor4 NOT LIKE '-' AND b.Supervisor4 IS NOT NULL THEN b.Supervisor4 WHEN b.Supervisor5 NOT LIKE '-' AND b.Supervisor5 IS NOT NULL THEN b.Supervisor5 ELSE '-' END FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code JOIN TB_Access d ON a.EmployeeID=d.EmployeeID WHERE a.Process like "."'%".$processName."%'"." AND c.PositionCategoryVal like "."'".$positionName."'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $dataValue)==false){
			$dataValue[$index]=$fieldValue;
			$index++;

		
			}

		}

	}


	}else if($accessType=="Administrator"  || $accessType=="SuperAdmin" || $accessType=="HumanResources"){


		if ($processName == "--All--" && $positionName == "--All--"){

			
			$index=0;

			$SQLstring="SELECT CASE WHEN b.Supervisor1 NOT LIKE '-' AND b.Supervisor1 IS NOT NULL THEN b.Supervisor1 WHEN b.Supervisor2 NOT LIKE '-' AND b.Supervisor2 IS NOT NULL THEN b.Supervisor2 WHEN b.Supervisor3 NOT LIKE '-' AND b.Supervisor3 IS NOT NULL THEN b.Supervisor3 WHEN b.Supervisor4 NOT LIKE '-' AND b.Supervisor4 IS NOT NULL THEN b.Supervisor4 WHEN b.Supervisor5 NOT LIKE '-' AND b.Supervisor5 IS NOT NULL THEN b.Supervisor5 ELSE '-' END FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $dataValue)==false){
			$dataValue[$index]=$fieldValue;
			$index++;

		
				
			}
		}


	}else if($processName == "--All--" && $positionName != "--All--"){

			
			$index=0;

			
			$SQLstring="SELECT CASE WHEN b.Supervisor1 NOT LIKE '-' AND b.Supervisor1 IS NOT NULL THEN b.Supervisor1 WHEN b.Supervisor2 NOT LIKE '-' AND b.Supervisor2 IS NOT NULL THEN b.Supervisor2 WHEN b.Supervisor3 NOT LIKE '-' AND b.Supervisor3 IS NOT NULL THEN b.Supervisor3 WHEN b.Supervisor4 NOT LIKE '-' AND b.Supervisor4 IS NOT NULL THEN b.Supervisor4 WHEN b.Supervisor5 NOT LIKE '-' AND b.Supervisor5 IS NOT NULL THEN b.Supervisor5 ELSE '-' END FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code WHERE c.Category like "."'".$positionName."'"." ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $dataValue)==false){
			$dataValue[$index]=$fieldValue;
			$index++;

		
			
		}
	}
	
	}else if($processName != "--All--" && $positionName == "--All--"){


			$index=0;

			$SQLstring="SELECT CASE WHEN b.Supervisor1 NOT LIKE '-' AND b.Supervisor1 IS NOT NULL THEN b.Supervisor1 WHEN b.Supervisor2 NOT LIKE '-' AND b.Supervisor2 IS NOT NULL THEN b.Supervisor2 WHEN b.Supervisor3 NOT LIKE '-' AND b.Supervisor3 IS NOT NULL THEN b.Supervisor3 WHEN b.Supervisor4 NOT LIKE '-' AND b.Supervisor4 IS NOT NULL THEN b.Supervisor4 WHEN b.Supervisor5 NOT LIKE '-' AND b.Supervisor5 IS NOT NULL THEN b.Supervisor5 ELSE '-' END FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code WHERE a.Process like "."'%".$processName."%'"." ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $dataValue)==false){
			$dataValue[$index]=$fieldValue;
			$index++;

		
			}

		}

	}else{


			$index=0;

			$SQLstring="SELECT CASE WHEN b.Supervisor1 NOT LIKE '-' AND b.Supervisor1 IS NOT NULL THEN b.Supervisor1 WHEN b.Supervisor2 NOT LIKE '-' AND b.Supervisor2 IS NOT NULL THEN b.Supervisor2 WHEN b.Supervisor3 NOT LIKE '-' AND b.Supervisor3 IS NOT NULL THEN b.Supervisor3 WHEN b.Supervisor4 NOT LIKE '-' AND b.Supervisor4 IS NOT NULL THEN b.Supervisor4 WHEN b.Supervisor5 NOT LIKE '-' AND b.Supervisor5 IS NOT NULL THEN b.Supervisor5 ELSE '-' END FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code WHERE a.Process like "."'%".$processName."%'"." AND c.PositionCategoryVal like "."'".$positionName."'"." ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $dataValue)==false){
			$dataValue[$index]=$fieldValue;
			$index++;

		
				}

			}

		}

	}


	$ClassConnection -> Close_connection($connection);	
	echo json_encode($dataValue);

}

}

//status
function StatusFilter(){

$ClassConnection=new DB_Connection();


$connection= $ClassConnection -> Open_connection(1);

if (!$connection){

echo '<script type="text/javascript">alert("Error : Failed to connect on database");</script>';

}else{

	$dataValue[]=null;
	$SQLstring="";

		$SQLstring="SELECT Stat_Category FROM TB_Status WHERE Stat_Remarks NOT IN ('Resigned','Terminated','Fall out','Transfer') ORDER BY Stat_Remarks ASC";

		$index=0;

		$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $dataValue)==false){
			$dataValue[$index]=$fieldValue;
			$index++;

		
				}

			}

	$ClassConnection -> Close_connection($connection);	
	echo json_encode($dataValue);

}

}

//extraction
function ExtractMasterlist($accessType,$processName,$positionName,$supervisorName,$statusVal,$FilterDatabaseName){

$ClassConnection=new DB_Connection();


$connection= $ClassConnection -> Open_connection(1);

if ($connection){



	$dataValue[][]=null;
	$SQLstring="";
	$ace=0;


if($accessType=="Supervisor"){

		if ($processName=="--All--" && $positionName=="--All--" && $supervisorName=="--All--" && $statusVal=="--All--"){

			$index=0;

			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode  WHERE "."'".$supervisorName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5) AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}
		



	}else if($processName=="--All--" && $positionName=="--All--" && $supervisorName=="--All--" && $statusVal!="--All--"){

	
			$index=0;

			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode WHERE "."'".$supervisorName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5) AND e.Stat_Category like "."'".$statusVal."'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}
		
	
	}else if($processName=="--All--" && $positionName=="--All--" && $supervisorName!="--All--" && $statusVal!="--All--"){


			$index=0;

			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode WHERE "."'".$supervisorName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5) AND c.PositionCategoryVal like "."'".$positionName."'"." AND e.Stat_Category like "."'".$statusVal."'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY a.Process";



			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}
		

	}else if($processName=="--All--" && $positionName!="--All--" && $supervisorName!="--All--" && $statusVal!="--All--"){


			$index=0;

			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode WHERE "."'".$supervisorName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5) AND e.Stat_Category like "."'".$statusVal."'"." AND c.PositionCategoryVal like "."'".$positionName."'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}
	}else if($processName!="--All--" && $positionName=="--All--" && $supervisorName=="--All--" && $statusVal=="--All--"){

		$index=0;

			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode  WHERE "."'".$supervisorName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5) AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") AND a.Process like "."'%".$processName."%'"." ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}


	}else if($processName!="--All--" && $positionName!="--All--" && $supervisorName=="--All--" && $statusVal=="--All--"){


		$index=0;

			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode  WHERE "."'".$supervisorName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5) AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") AND a.Process like "."'%".$processName."%'"." AND c.PositionCategoryVal like "."'".$positionName."'"." ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}


	}else if($processName!="--All--" && $positionName!="--All--" && $supervisorName!="--All--" && $statusVal=="--All--"){

			$index=0;

			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode  WHERE "."'".$supervisorName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5) AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") AND a.Process like "."'%".$processName."%'"." AND c.PositionCategoryVal like "."'".$positionName."'"." ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			
		
				}

				$index++;
				$ace++;
			}


	}else{

		$index=0;

			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode WHERE "."'".$supervisorName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5) AND e.Stat_Category like "."'".$statusVal."'"." AND c.PositionCategoryVal like "."'".$positionName."'"." AND a.Process like "."'%".$processName."%'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}
		

	}

	}else if($accessType=="Supervisor2" || $accessType=="Manager"){


		if ($processName=="--All--" && $positionName=="--All--" && $supervisorName=="--All--" && $statusVal=="--All--"){

			$loopProcess=explode("/", $processName);
			$index=0;

			for($a=0;$a < count($loopProcess);$a++){

			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode WHERE b.Process like "."'%".$loopProcess[a]."%'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}
		
		
		}


	}else if($processName=="--All--" && $positionName=="--All--" && $supervisorName=="--All--" && $statusVal!="--All--"){

			$loopProcess=explode("/", $processName);
			$index=0;

			for($a=0;$a < count($loopProcess);$a++){

				$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode WHERE b.Process like "."'%".$loopProcess[a]."%'"." AND e.Stat_Category like "."'".$statusVal."'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}
		
	}
	
	}else if($processName=="--All--" && $positionName=="--All--" && $supervisorName!="--All--" && $statusVal!="--All--"){


			$loopProcess=explode("/", $processName);
			$index=0;

			for($a=0;$a < count($loopProcess);$a++){

			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode WHERE b.Process like "."'%".$loopProcess[a]."%'"." AND e.Stat_Category like "."'".$statusVal."'"." AND "."'".$supervisorName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5)"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY a.Process";

			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}
		

		}

	}else if($processName=="--All--" && $positionName!="--All--" && $supervisorName!="--All--" && $statusVal!="--All--"){


			$loopProcess=explode("/", $processName);
			$index=0;

			for($a=0;$a < count($loopProcess);$a++){

			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode WHERE b.Process like "."'%".$loopProcess[a]."%'"." AND e.Stat_Category like "."'".$statusVal."'"." AND "."'".$supervisorName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5) AND c.PositionCategoryVal like "."'".$positionName."'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);
			
			while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}

		}

	}else if($processName!="--All--" && $positionName=="--All--" && $supervisorName=="--All--" && $statusVal=="--All--"){

				$index=0;

			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode WHERE b.Process like "."'%".$processName."%'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}

	}else if($processName!="--All--" && $positionName!="--All--" && $supervisorName=="--All--" && $statusVal=="--All--"){

			$index=0;

			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode WHERE b.Process like "."'%".$processName."%'"." AND c.PositionCategoryVal like "."'".$positionName."'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}

	}else if($processName!="--All--" && $positionName!="--All--" && $supervisorName=="--All--" && $statusVal=="--All--"){

		$index=0;

			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode WHERE b.Process like "."'%".$processName."%'"." AND "."'".$supervisorName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5) AND c.PositionCategoryVal like "."'".$positionName."'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}

	}else{

			$index=0;

			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode WHERE b.Process like "."'%".$processName."%'"." AND e.Stat_Category like "."'".$statusVal."'"." AND "."'".$supervisorName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5) AND c.PositionCategoryVal like "."'".$positionName."'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.") ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}

	}


	}else if($accessType=="Administrator"  || $accessType=="SuperAdmin" || $accessType=="HumanResources"){


		if ($processName=="--All--" && $positionName=="--All--" && $supervisorName=="--All--" && $statusVal=="--All--"){

			
			$index=0;

			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode ORDER BY a.Process,e.Stat_Code";



			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}


	}else if($processName=="--All--" && $positionName=="--All--" && $supervisorName=="--All--" && $statusVal!="--All--"){

			
			$index=0;

			
			
			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode WHERE e.Stat_Category like "."'".$statusVal."'"." ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}
	
	}else if($processName=="--All--" && $positionName=="--All--" && $supervisorName!="--All--" && $statusVal!="--All--"){


			$index=0;

			
			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode WHERE e.Stat_Category like "."'".$statusVal."'"." AND "."'".$supervisorName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5)"." ORDER BY a.Process";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}

	}else if($processName=="--All--" && $positionName!="--All--" && $supervisorName!="--All--" && $statusVal!="--All--"){


			$index=0;

			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode WHERE e.Stat_Category like "."'".$statusVal."'"." AND "."'".$supervisorName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5)"." AND c.PositionCategoryVal like "."'".$positionName."'"." ORDER BY a.Process";

			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}
	}else if($processName!="--All--" && $positionName=="--All--" && $supervisorName=="--All--" && $statusVal=="--All--"){

				$index=0;

			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode WHERE a.Process like "."'%".$processName."%'"." ORDER BY a.Process";

			$execQuery=odbc_exec($connection, $SQLstring);

				while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}

	}else if($processName!="--All--" && $positionName!="--All--" && $supervisorName=="--All--" && $statusVal=="--All--"){

				$index=0;

			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode WHERE c.PositionCategoryVal like "."'".$positionName."'"." AND a.Process like "."'%".$processName."%'"." ORDER BY a.Process";

			$execQuery=odbc_exec($connection, $SQLstring);

				while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}

	}else if($processName!="--All--" && $positionName!="--All--" && $supervisorName!="--All--" && $statusVal=="--All--"){

		$index=0;

			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode WHERE "."'".$supervisorName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5)"." AND c.PositionCategoryVal like "."'".$positionName."'"." AND a.Process like "."'%".$processName."%'"." ORDER BY a.Process";

			$execQuery=odbc_exec($connection, $SQLstring);

				while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}


		}else{

			$index=0;

			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,h.AssignmentName,c.PositionCategoryVal,a.Location,i.Channel,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,f.UserID,f.AVAYAID,f.IEX_Medallia,f.BadgeID,f.NetworkID,f.CompanyEmail,f.OtherEmail,(CASE WHEN d.Billable=1 THEN "."'"."Yes"."'"." ELSE "."'"."No"."'"." END),e.Stat_Code FROM ".$FilterDatabaseName.".dbo.TB_Information a JOIN ".$FilterDatabaseName.".dbo.TB_Hierarchy b ON a.TableID=b.TableID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory c ON a.Position=c.Code JOIN ".$FilterDatabaseName.".dbo.TB_State d ON a.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON e.Stat_Remarks=d.CurrentStatus JOIN ".$FilterDatabaseName.".dbo.TB_Credentials f ON a.TableID=f.TableID JOIN DB_Employee_Management_System.dbo.TB_Access g ON a.EmployeeID=g.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_AssignmentList h ON a.Assignment_Role=h.AssignmentCode JOIN DB_Employee_Management_System.dbo.TB_Channel i ON a.Channel=i.ChannelCode  WHERE e.Stat_Category like "."'".$statusVal."'"." AND "."'".$supervisorName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5)"." AND c.PositionCategoryVal like "."'".$positionName."'"." AND a.Process like "."'%".$processName."%'"." ORDER BY a.Process";

			$execQuery=odbc_exec($connection, $SQLstring);

				while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1][$index]=$fieldValue;
			

		
				}

				$index++;
				$ace++;
			}

		}

	}


	$ClassConnection -> Close_connection($connection);	
	$_SESSION['msltDatable']=$dataValue;
	$_SESSION['msltDatableIterate']=$ace;
	echo json_encode(1);

}

}


function SummaryDetails($employeeIDVal){


$ClassConnection=new DB_Connection();


$connection= $ClassConnection -> Open_connection(1);

if ($connection){



	$dataValue[]=null;
	$SQLstring="";
	
	$SQLstring="SELECT a.EmployeeID,a.FirstName,a.MiddleName,a.LastName,l.AccountName,a.Process,c.BandwidthCategoryVal,d.PositionCategoryVal,k.AssignmentName,a.HiredDate,a.Location,a.Batch,m.Channel,b.NetworkID,b.UserID,b.AVAYAID,b.IEX_Medallia,b.BadgeID,b.CompanyEmail,b.OtherEmail,e.Supervisor1,e.Supervisor2,e.Supervisor3,e.Supervisor4,e.Supervisor5,(CASE WHEN f.CurrentStatus="."'"."Active"."'"." THEN 1 ELSE 0 END),f.Billable,h.TenurityCategoryVal,i.TenureStatusCategoryVal,f.HistoryRemarks,j.Stat_Remarks FROM TB_Information a JOIN TB_Credentials b ON a.TableID=b.TableID JOIN TB_BandwidthCategory c ON a.Bandwidth=c.Code JOIN TB_PositionCategory d ON a.Position=d.Code JOIN TB_Hierarchy e ON a.TableID=e.TableID JOIN TB_State f ON a.TableID=f.TableID JOIN TB_BillableCategory g ON f.Billable=g.Code JOIN TB_TenurityCategory h ON f.Tenurity=h.Code JOIN TB_TenureStatusCategory i ON f.TenureStatus=i.Code JOIN TB_Status j ON f.CurrentStatus=j.Stat_Remarks JOIN TB_AssignmentList k ON a.Assignment_Role=k.AssignmentCode JOIN TB_AccountList l ON a.Account_Name=l.AccountCode JOIN TB_Channel m ON a.Channel=m.ChannelCode WHERE a.EmployeeID like "."'".$employeeIDVal."'"."";


			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			for($a=1;$a <= odbc_num_fields($execQuery);$a++){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, $a));
			
			$dataValue[$a-1]=$fieldValue;
			
				
				}
	
			}

	}

$ClassConnection -> Close_connection($connection);	
$_SESSION['IndividualInfo']=$dataValue;
echo json_encode($_SESSION['IndividualInfo']);

}

?>