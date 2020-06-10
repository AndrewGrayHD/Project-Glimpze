<?php
include "database_engine.php";
include "UpdateInfoClass.php";
  session_start();

    $functionNumber=$_POST['functionNumber'];

     switch ($functionNumber) {

    	case 1:
   	 		getProcessthatAllAgentbaseInAccess();		
     	 break;

     	 case 2:
     	 		getCategoryFilter($_POST['IfProcessHaveData']);		
     	 break;

     	 case 3:
     	 		filterAgentList($_POST['EndorsementProcessModalC'],$_POST['EndorsementHiredFromModalC'],$_POST['EndorsementHiredtoModalC'],$_POST['EndorsementCategoryModalC']);		
     	 break;

     	 case 4:
     	 		getallTrainer($_POST['ProcessFilter']);		
     	 break;

     	 case 5:

     			echo json_encode(EndorsementForTraining($_POST['dataFieldVal'],$_POST['EnorsementSavingProcess']));	


      	break;

      	case 6:
     			getProcessthatAllAgent();	
      	break;

      	case 7:
      			GetProcessforFilterInNestingAndOperation($_POST['STRCode1']);		
  	   	break;

      	case 8:
      			GetTrainerforFilterInNestingAndOperation($_POST['IfProcessHaveData2'],$_POST['STRCode2']);
      	break;

      	case 9:
      			GetBatchforFilterInNestingAndOperation($_POST['IfProcessHaveData3'],$_POST['IfTrainerHaveDataVal'],$_POST['STRCode3']);
      	break;
      	case 10:
      			filterNestingList_Operation($_POST['EndorsementProcessModalC2'],$_POST['EndorsementCategoryModalC2'],$_POST['EndorsementBatchModalC2'],$_POST['STRCode4']);
  		break;	
  //filterNestingList_Operation("Gcash Mnl","Reyes, Argee Zamora","Batch-31",1);
    	 	case 11:
      			filterNestingList_Operation($_POST['EndorsementProcessModalC2'],$_POST['EndorsementCategoryModalC2'],$_POST['EndorsementBatchModalC2'],$_POST['STRCode4']);
      	break;

      	case 12:
      			echo json_encode(EndorsementForNestingAndOperation($_POST['dataFieldVal2'],$_POST['STRCode5'],$_POST['EnorsementSavingProcess2']));
// //EndorsementForNestingAndOperation(array("679454/679462/679458","Gcash Mnl","Reyes, Argee Zamora","05/22/2020","3","Batch-31"),2);
      	break;


     }


function getProcessthatAllAgent(){

try{

$ClassConnection=new DB_Connection();
$connection= $ClassConnection -> Open_connection(1);

$SQLstring="";

$dataValue[]=null;
$index=0;


if($connection){



		$SQLstring="SELECT a.Process FROM TB_Information a JOIN TB_PositionCategory b ON a.Position=b.Code WHERE b.PositionCategoryVal like "."'"."Associate-Customer Support"."'"."  ORDER BY a.Process ASC";

		$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			$loopProcess=explode("/", $fieldValue);

			for($a=0;$a < count($loopProcess);$a++){

			if(in_array ($loopProcess[$a], $dataValue)==false){
			$dataValue[$index]=$loopProcess[$a];
			$index++;
	
			  }

		 }
	 }




echo json_encode($dataValue);
$ClassConnection -> Close_connection($connection);	

}

}catch(Exception $e){

}


}

function getProcessthatAllAgentbaseInAccess(){

try{

$ClassConnection=new DB_Connection();
$connection= $ClassConnection -> Open_connection(1);

$SQLstring="";

$dataValue[]=null;
$index=0;


if($connection){

if($_SESSION['AccesType']=="Supervisor" || $_SESSION['AccesType']=="Supervisor2" || $_SESSION['AccesType']=="Manager"){
		
		$userProcess=$_SESSION['Process'];
		$dataValue=explode("/", $userProcess);


}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="HumanResources" || $_SESSION['AccesType']=="SuperAdmin"){

		$SQLstring="SELECT a.Process FROM TB_Information a JOIN TB_PositionCategory b ON a.Position=b.Code WHERE b.PositionCategoryVal like "."'"."Associate-Customer Support"."'"."  ORDER BY a.Process ASC";

		$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			$loopProcess=explode("/", $fieldValue);

			for($a=0;$a < count($loopProcess);$a++){

			if(in_array ($loopProcess[$a], $dataValue)==false){
			$dataValue[$index]=$loopProcess[$a];
			$index++;
	
			  }

		 }
	 }

}



echo json_encode($dataValue);
$ClassConnection -> Close_connection($connection);	

}

}catch(Exception $e){

}

}



function getallTrainer($ProcessVal){

try{

$ClassConnection=new DB_Connection();
$connection= $ClassConnection -> Open_connection(1);

$SQLstring="";

$dataValue[]=null;
$index=0;


if($connection){

$SQLstring="SELECT (a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name FROM TB_Information a JOIN TB_PositionCategory b ON a.Position=b.Code WHERE (b.PositionCategoryVal like "."'%"."Training"."%'"." OR "."b.PositionCategoryVal like "."'%"."Trainer"."%'".") AND a.Process like "."'%".$ProcessVal."%'"."  ORDER BY a.Process ASC";

$execQuery=odbc_exec($connection, $SQLstring);

while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			
			if(in_array ($fieldValue, $dataValue)==false){
			$dataValue[$index]=$fieldValue;
			$index++;
	
	}
}

echo json_encode($dataValue);
$ClassConnection -> Close_connection($connection);	

}

}catch(Exception $e){

}

}

function getCategoryFilter($IfProcessHavaData){

	$SQLstring="";

	$dataValue[]=null;
	$index=0;

	try{


	$supervisorEmpName=$_SESSION['LastName'].", ".$_SESSION['FirstName'];
		if ($_SESSION['MiddleName']!="" && $_SESSION['MiddleName']!=null){

			$supervisorEmpName=$supervisorEmpName." ".$_SESSION['MiddleName'];
		}


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
		
		$ClassConnection=new DB_Connection();
		$connection= $ClassConnection -> Open_connection(1);

		if($connection){

		if($_SESSION['AccesType']=="Supervisor"){

			$SQLstring="SELECT CASE WHEN b.Supervisor1 NOT LIKE '-' AND b.Supervisor1 IS NOT NULL THEN b.Supervisor1 WHEN b.Supervisor2 NOT LIKE '-' AND b.Supervisor2 IS NOT NULL THEN b.Supervisor2 WHEN b.Supervisor3 NOT LIKE '-' AND b.Supervisor3 IS NOT NULL THEN b.Supervisor3 WHEN b.Supervisor4 NOT LIKE '-' AND b.Supervisor4 IS NOT NULL THEN b.Supervisor4 WHEN b.Supervisor5 NOT LIKE '-' AND b.Supervisor5 IS NOT NULL THEN b.Supervisor5 ELSE '-' END FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code JOIN TB_Access d ON a.EmployeeID=d.EmployeeID WHERE "."'".$supervisorEmpName."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5)"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.")";

			if($IfProcessHavaData != ""){
				$SQLstring=$SQLstring." AND a.Process like "."'%".$IfProcessHavaData."%'"." ORDER BY a.Process ASC";
			}

			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $dataValue)==false){
			$dataValue[$index]=$fieldValue;
			$index++;

		
				}

		}

		}else if($_SESSION['AccesType']=="Supervisor2" || $_SESSION['AccesType']=="Manager"){


			if($IfProcessHavaData != ""){

				$SQLstring="SELECT CASE WHEN b.Supervisor1 NOT LIKE '-' AND b.Supervisor1 IS NOT NULL THEN b.Supervisor1 WHEN b.Supervisor2 NOT LIKE '-' AND b.Supervisor2 IS NOT NULL THEN b.Supervisor2 WHEN b.Supervisor3 NOT LIKE '-' AND b.Supervisor3 IS NOT NULL THEN b.Supervisor3 WHEN b.Supervisor4 NOT LIKE '-' AND b.Supervisor4 IS NOT NULL THEN b.Supervisor4 WHEN b.Supervisor5 NOT LIKE '-' AND b.Supervisor5 IS NOT NULL THEN b.Supervisor5 ELSE '-' END FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code JOIN TB_Access d ON a.EmployeeID=d.EmployeeID WHERE a.Process like "."'%".$IfProcessHavaData."%'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.")";

			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $dataValue)==false){
			$dataValue[$index]=$fieldValue;
			$index++;

		
				}
			}

			}else{

			$processName=$_SESSION['Process'];
				
			$loopProcess=explode("/", $processName);
			

			for($a=0;$a < count($loopProcess);$a++){

			$SQLstring="SELECT CASE WHEN b.Supervisor1 NOT LIKE '-' AND b.Supervisor1 IS NOT NULL THEN b.Supervisor1 WHEN b.Supervisor2 NOT LIKE '-' AND b.Supervisor2 IS NOT NULL THEN b.Supervisor2 WHEN b.Supervisor3 NOT LIKE '-' AND b.Supervisor3 IS NOT NULL THEN b.Supervisor3 WHEN b.Supervisor4 NOT LIKE '-' AND b.Supervisor4 IS NOT NULL THEN b.Supervisor4 WHEN b.Supervisor5 NOT LIKE '-' AND b.Supervisor5 IS NOT NULL THEN b.Supervisor5 ELSE '-' END FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code JOIN TB_Access d ON a.EmployeeID=d.EmployeeID WHERE a.Process like "."'%".$loopProcess[$a]."%'"." AND (d.AccessCode >= 1 AND d.AccessCode <= ".$accessValue.")";

				

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

		


		}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="SuperAdmin"){

			$SQLstring="SELECT CASE WHEN b.Supervisor1 NOT LIKE '-' AND b.Supervisor1 IS NOT NULL THEN b.Supervisor1 WHEN b.Supervisor2 NOT LIKE '-' AND b.Supervisor2 IS NOT NULL THEN b.Supervisor2 WHEN b.Supervisor3 NOT LIKE '-' AND b.Supervisor3 IS NOT NULL THEN b.Supervisor3 WHEN b.Supervisor4 NOT LIKE '-' AND b.Supervisor4 IS NOT NULL THEN b.Supervisor4 WHEN b.Supervisor5 NOT LIKE '-' AND b.Supervisor5 IS NOT NULL THEN b.Supervisor5 ELSE '-' END FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code";

			if($IfProcessHavaData != ""){
				$SQLstring=$SQLstring." WHERE a.Process like "."'%".$IfProcessHavaData."%'"." ORDER BY a.Process ASC";
			}

			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $dataValue)==false){
			$dataValue[$index]=$fieldValue;
			$index++;

		
				
			}
		}
	}
	echo json_encode($dataValue);
	$ClassConnection -> Close_connection($connection);	
}

	}catch(Exception $e){

	}

}


function filterAgentList($EndorsementProcessModalC,$EndorsementHiredFromModalC,$EndorsementHiredtoModalC,$EndorsementCategoryModalC){
	
	$SQLstring="";

	$dataValue[]=null;
	$index=0;


	try{
		
		$ClassConnection=new DB_Connection();

		$connection= $ClassConnection -> Open_connection(1);

		if($connection){

			$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID";

			if($EndorsementProcessModalC != "" || $EndorsementHiredFromModalC != "" || $EndorsementHiredtoModalC !="" || $EndorsementCategoryModalC != "" ){
				$SQLstring=$SQLstring." WHERE ";

				$data=0;


			if($EndorsementProcessModalC != ""){
				if($data==0){

				$SQLstring=$SQLstring."a.Process like "."'%".$EndorsementProcessModalC."%'"."";

			}else{

				$SQLstring=$SQLstring." AND a.Process like "."'%".$EndorsementProcessModalC."%'"."";
			}
			$data++;

			} 

			if($EndorsementHiredFromModalC != "" && $EndorsementHiredtoModalC != ""){
				if($data==0){

				$SQLstring=$SQLstring."(a.HiredDate between "."'".date('Y-m-d',strtotime($EndorsementHiredFromModalC))."'"." AND "."'".date('Y-m-d',strtotime($EndorsementHiredtoModalC))."'".")";
			}else{
				
					$SQLstring=$SQLstring." AND (a.HiredDate between "."'".date('Y-m-d',strtotime($EndorsementHiredFromModalC))."'"." AND "."'".date('Y-m-d',strtotime($EndorsementHiredtoModalC))."'".")";
			}
			$data++;

			} 

			if($EndorsementCategoryModalC != "" || $EndorsementCategoryModalC != null){
				if($data==0){

				$SQLstring=$SQLstring."'".$EndorsementCategoryModalC."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5)";

			}else{
					$SQLstring=$SQLstring." AND "."'".$EndorsementCategoryModalC."'"." IN (b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5)";
			}
			
			$data++;	
			}

			$SQLstring=$SQLstring." ORDER BY a.LastName ASC";

			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$dataValue[0][$index]=$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			$dataValue[1][$index]=$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 2));
			$index++;
	
			
		}


		echo json_encode($dataValue);
		$ClassConnection -> Close_connection($connection);
	}


}

	}catch(Exception $e){

	}

}






function EndorsementForTraining($Data,$EnorsementSavingProcess){




		$SQLstring="";

		$returnVal=0;
		$ProcessCodeVal=0;
		$trainerEmpIDVal="";

		$ClassConnection=new DB_Connection();
		$UpdateInfo=new UpdateInfo_Engine();

			$connection= $ClassConnection -> Open_connection(1);

		if($connection){

			$SQLstring="SELECT ProcessCode FROM TB_ProcessList WHERE ProcessName like "."'".$Data[1]."'"."";

			$execQuery=odbc_exec($connection, $SQLstring);

		if(!odbc_error($connection)){

			while(odbc_fetch_row($execQuery)){

			$ProcessCodeVal=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			

		}
		}else{
			return 0;
		}
		$ClassConnection -> Close_connection($connection);
		}
		
		$connection= $ClassConnection -> Open_connection(1);

		if($connection){

					$SQLstring="SELECT EmployeeID FROM TB_Information WHERE (LastName"."+', '+"."FirstName"."+' '+"."MiddleName) like "."'".$Data[2]."'"."";

			$execQuery=odbc_exec($connection, $SQLstring);
		if(!odbc_error($connection)){
			while(odbc_fetch_row($execQuery)){

			$trainerEmpIDVal=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			

		}

		}else{

			return 0;
		}		

		$ClassConnection -> Close_connection($connection);
		}

		$alreadyExist=false;
		$userEmpID="";

		$connection= $ClassConnection -> Open_connection(2);

		if($connection){

		$SQLstring="SELECT UserEmpID FROM TB_Endorsement_Training WHERE ProcessID=".$ProcessCodeVal." AND UpdatedBatch like "."'".$Data[5]."'"."";

		$execQuery=odbc_exec($connection, $SQLstring);

		if(!odbc_error($connection)){
			while(odbc_fetch_row($execQuery)){

			$userEmpID=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			$alreadyExist=true;
			

		}

		}else{

			return 0;
		}	
		$ClassConnection -> Close_connection($connection);

		}

		if($EnorsementSavingProcess=="Insert"){

		if($alreadyExist===false){


		$connection= $ClassConnection -> Open_connection(2);

		$SQLstring="INSERT INTO TB_Endorsement_Training (NotifTimeStamp,AgentsEmpId,ProcessID,TrainerEmpID,NumberBillable,EffectiveDate,UserEmpID,UpdatedBatch,Lock) VALUES (?,?,?,?,?,?,?,?,?)";

		$Datavalue[]=null;
		$Datavalue[0]=date('Y-m-d h:m:s');
		$Datavalue[1]=$Data[0];
		$Datavalue[2]=$ProcessCodeVal;
		$Datavalue[3]=$trainerEmpIDVal;
		$Datavalue[4]=$Data[4];
		$Datavalue[5]=date('Y-m-d',strtotime($Data[3]));
		$Datavalue[6]=$_SESSION['EmployeeID'];
		$Datavalue[7]=$Data[5];
		$Datavalue[8]="0";

		$prepExec=odbc_prepare($connection,$SQLstring);

     	$execQuery=odbc_execute($prepExec,$Datavalue);

       if(!odbc_error($connection)){
       		 $rowAffected=@odbc_num_rows($prepExec);

       	if( $rowAffected > 0){
        	
    	$InfoUpdateData=$Data;
    	
    	$InfoUpdateData[2]=$trainerEmpIDVal;

    	$ClassConnection -> Close_connection($connection);

    	if(date('Y-m-d',strtotime($Data[3])) <= date('Y-m-d')){

    		
    		
    		 $returnVal=$UpdateInfo -> EndorsementUpdateInfo($Data,$ProcessCodeVal,$trainerEmpIDVal,1,$EnorsementSavingProcess);

    	}else{

    		 $returnVal=1;

    	}
    	
    

        }else{

        return 0;

        }

       	}else{

       	 return 0;
       	}

      
       
        
		}else{

		 return 3;

		}


		}else{


		$connection= $ClassConnection -> Open_connection(2);

		$SQLstring="UPDATE TB_Endorsement_Training SET AgentsEmpId=?,ProcessID=?,TrainerEmpID=?,NumberBillable=?,EffectiveDate=?,UserEmpID=?,UpdatedBatch=? WHERE ProcessID=".$ProcessCodeVal." AND TrainingDate="."'".date('Y-m-d',strtotime($Data[3]))."'"." AND UpdatedBatch like "."'".$Data[5]."'"."";

		$Datavalue[]=null;
		
		$Datavalue[0]=$Data[0];
		$Datavalue[1]=$ProcessCodeVal;
		$Datavalue[2]=$trainerEmpIDVal;
		$Datavalue[3]=$Data[4];
		$Datavalue[4]=date('Y-m-d',strtotime($Data[3]));
		if($userEmpID==""){$Datavalue[5]=$_SESSION['EmployeeID'];}else{$Datavalue[5]=$userEmpID."/".$_SESSION['EmployeeID'];}
		$Datavalue[6]=$Data[5];


		$prepExec=odbc_prepare($connection,$SQLstring);

     	$execQuery=odbc_execute($prepExec,$Datavalue);

       if(!odbc_error($connection)){

       		 $rowAffected=@odbc_num_rows($prepExec);

       	if( $rowAffected > 0){
        	
    	$InfoUpdateData=$Data;
    	
    	$InfoUpdateData[2]=$trainerEmpIDVal;

    	$ClassConnection -> Close_connection($connection);

    	$returnVal=$UpdateInfo -> EndorsementUpdateInfo($Data,$ProcessCodeVal,$trainerEmpIDVal,1,$EnorsementSavingProcess);

        }else{

        return 0;

        }

       	}else{

       	 return 0;
       	}


		}

		
		return $returnVal;

}


function GetProcessforFilterInNestingAndOperation($SQLstrCode){

	$SQLstring="";
	$dataValue[]=null;
	$index=0;



	try{

		$ClassConnection=new DB_Connection();
		
		$connection= $ClassConnection -> Open_connection(2);


		if($_SESSION['AccesType']=="Supervisor" ){

		$SQLstring="SELECT a.AgentsEmpId FROM TB_Endorsement_Training a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode  TrainerEmpID like "."'".$_SESSION['EmployeeID']."'"." ORDER BY b.ProcessName ASC";


		}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="HumanResources" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="Supervisor2" || $_SESSION['AccesType']=="Manager"){

		$SQLstring="SELECT a.AgentsEmpId FROM TB_Endorsement_Training a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode ORDER BY b.ProcessName ASC";

		}


		$tempDataValue[]=null;
		$tempindex=0;

		$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $tempDataValue)==false){
			$tempDataValue[$tempindex]=$fieldValue;
			$tempindex++;

		
				
			}
		}

		$ClassConnection -> Close_connection($connection);

		for($aceIndex=0;$aceIndex < count($tempDataValue);$aceIndex++){

			$splitValue=explode("/",$tempDataValue[$aceIndex]);

			for($a=0;$a < count($splitValue);$a++){

				$connection= $ClassConnection -> Open_connection(1);
				if($SQLstrCode==1){
						$SQLstring="SELECT a.Process FROM TB_Information a JOIN TB_State b ON a.TableID=b.TableID WHERE a.EmployeeID like "."'".$splitValue[$a]."'"." AND b.TenureStatus=1 ORDER BY a.Process ASC";
				}else{
							$SQLstring="SELECT a.Process FROM TB_Information a JOIN TB_State b ON a.TableID=b.TableID WHERE a.EmployeeID like "."'".$splitValue[$a]."'"." AND (b.TenureStatus=1 OR b.TenureStatus=2) ORDER BY a.Process ASC";
				}	
			

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

	}catch(Exception $e){

	}


}

function GetTrainerforFilterInNestingAndOperation($ifHavePrcess,$SQLstrCode){


	$SQLstring="";
	$dataValue[]=null;
	$index=0;

	try{

		$ClassConnection=new DB_Connection();
		
		$connection= $ClassConnection -> Open_connection(2);


		if($_SESSION['AccesType']=="Supervisor" ){

		if($ifHavePrcess != "" || $ifHavePrcess != null){

			$SQLstring="SELECT a.AgentsEmpId as Name FROM TB_Endorsement_Training a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode WHERE TrainerEmpID like "."'".$_SESSION['EmployeeID']."'"." AND b.ProcessName like "."'".$ifHavePrcess."'"." ORDER BY b.ProcessName ASC";

		}
		

		}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="HumanResources" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="Supervisor2" || $_SESSION['AccesType']=="Manager"){

			if($ifHavePrcess != "" || $ifHavePrcess != null){

			$SQLstring="SELECT a.AgentsEmpId as Name FROM TB_Endorsement_Training a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode WHERE b.ProcessName like "."'".$ifHavePrcess."'"." ORDER BY b.ProcessName ASC";

	
			}	

		}


		$tempDataValue[]=null;
		$tempindex=0;

		$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $tempDataValue)==false){
			$tempDataValue[$tempindex]=$fieldValue;
			$tempindex++;

		
				
			}
		}

		$ClassConnection -> Close_connection($connection);

		for($aceIndex=0;$aceIndex < count($tempDataValue);$aceIndex++){

			$splitValue=explode("/",$tempDataValue[$aceIndex]);

			for($a=0;$a < count($splitValue);$a++){

				$connection= $ClassConnection -> Open_connection(1);

			if($SQLstrCode==1){
				$SQLstring="SELECT c.Supervisor1 FROM TB_Information a JOIN TB_State b ON a.TableID=b.TableID JOIN TB_Hierarchy c ON a.TableID=c.TableID  WHERE a.EmployeeID like "."'".$splitValue[$a]."'"." AND b.TenureStatus=1 ORDER BY c.Supervisor1 ASC";
			
			}else{

				$SQLstring="SELECT c.Supervisor1 FROM TB_Information a JOIN TB_State b ON a.TableID=b.TableID JOIN TB_Hierarchy c ON a.TableID=c.TableID  WHERE a.EmployeeID like "."'".$splitValue[$a]."'"." AND b.TenureStatus=2 ORDER BY c.Supervisor1 ASC";
				
			}
	
				

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

	}catch(Exception $e){

	}

}



function GetBatchforFilterInNestingAndOperation($ifHavePrcess,$ifTrainerName,$SQLstrCode){

	$SQLstring="";
	$dataValue[]=null;
	$index=0;

	try{

		$ClassConnection=new DB_Connection();
		
		$connection= $ClassConnection -> Open_connection(2);


		if($_SESSION['AccesType']=="Supervisor" ){

		if(($ifHavePrcess != "" || $ifHavePrcess != null) && ($ifTrainerName != "" || $ifTrainerName != null)){

			$SQLstring="SELECT a.AgentsEmpId as Name FROM TB_Endorsement_Training a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode  WHERE TrainerEmpID like "."'".$_SESSION['EmployeeID']."'"." AND b.ProcessName like "."'".$ifHavePrcess."'"." ORDER BY b.ProcessName ASC";

		}
		

		}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="HumanResources" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="Supervisor2" || $_SESSION['AccesType']=="Manager"){

			if($ifHavePrcess != "" || $ifHavePrcess != null){

			$SQLstring="SELECT a.AgentsEmpId as Name FROM TB_Endorsement_Training a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.TrainerEmpID=c.EmployeeID WHERE b.ProcessName like "."'".$ifHavePrcess."'"." AND (c.LastName"."+', '+"."c.FirstName"."+' '+"."c.MiddleName) like "."'".$ifTrainerName."'"." ORDER BY b.ProcessName ASC";

			}	

		}


		
		$tempDataValue[]=null;
		$tempindex=0;

		$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			if(in_array ($fieldValue, $tempDataValue)==false){
			$tempDataValue[$tempindex]=$fieldValue;
			$tempindex++;

		
				
			}
		}

		$ClassConnection -> Close_connection($connection);

		for($aceIndex=0;$aceIndex < count($tempDataValue);$aceIndex++){

			$splitValue=explode("/",$tempDataValue[$aceIndex]);

			for($a=0;$a < count($splitValue);$a++){

				$connection= $ClassConnection -> Open_connection(1);

			if($SQLstrCode==1){

			$SQLstring="SELECT a.Batch FROM TB_Information a JOIN TB_State b ON a.TableID=b.TableID JOIN TB_Hierarchy c ON a.TableID=c.TableID  WHERE a.EmployeeID like "."'".$splitValue[$a]."'"." AND b.TenureStatus=1 ORDER BY c.Supervisor1 ASC";

			}else{
				$SQLstring="SELECT a.Batch FROM TB_Information a JOIN TB_State b ON a.TableID=b.TableID JOIN TB_Hierarchy c ON a.TableID=c.TableID  WHERE a.EmployeeID like "."'".$splitValue[$a]."'"." AND b.TenureStatus=2 ORDER BY c.Supervisor1 ASC";
			}

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

	}catch(Exception $e){

	}
	
}



function filterNestingList_Operation($EndorsementNestingOperationProcess,$EndorsementNestingOperationTrainer,$EndorsementNestingOperationBatch,$SQLstrCode){
	
	$SQLstring="";

	$dataValue[]=null;
	$index=0;

	$ProcessCodeVal="";
	$trainerEmpIDVal="";


	try{
		
		$ClassConnection=new DB_Connection();

		$connection= $ClassConnection -> Open_connection(1);
		
		if($SQLstrCode==1){

		$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as name FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_State c ON a.TableID=c.TableID WHERE a.Process like "."'%".$EndorsementNestingOperationProcess."%'"." AND b.Supervisor1 like "."'".$EndorsementNestingOperationTrainer."'"." AND a.Batch like "."'".$EndorsementNestingOperationBatch."'"." AND c.TenureStatus=1"." ORDER BY a.LastName ASC";
		}else{
		$SQLstring="SELECT a.EmployeeID,(a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as name FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_State c ON a.TableID=c.TableID WHERE a.Process like "."'%".$EndorsementNestingOperationProcess."%'"." AND b.Supervisor1 like "."'".$EndorsementNestingOperationTrainer."'"." AND a.Batch like "."'".$EndorsementNestingOperationBatch."'"." AND c.TenureStatus=2"." ORDER BY a.LastName ASC";
		}

			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$dataValue[0][$index]=$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			$dataValue[1][$index]=$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 2));
			$index++;
	
			
		}

		$ClassConnection -> Close_connection($connection);
		echo json_encode($dataValue);
		

	

	}catch(Exception $e){

	}

	}



function EndorsementForNestingAndOperation($Data,$SQLstrCode,$EnorsementSavingProcess){


		$SQLstring="";

		$returnVal=0;
		$ProcessCodeVal=0;
		$trainerEmpIDVal="";

		$ClassConnection=new DB_Connection();
		$UpdateInfo=new UpdateInfo_Engine();

			$connection= $ClassConnection -> Open_connection(1);

			if($connection){

					$SQLstring="SELECT ProcessCode FROM TB_ProcessList WHERE ProcessName like "."'".$Data[1]."'"."";

			$execQuery=odbc_exec($connection, $SQLstring);
		if(!odbc_error($connection)){
			while(odbc_fetch_row($execQuery)){

			$ProcessCodeVal=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			

		}

		}else{
			return 0;
		}
		$ClassConnection -> Close_connection($connection);
		}
		
		$connection= $ClassConnection -> Open_connection(1);

			if($connection){

					$SQLstring="SELECT EmployeeID FROM TB_Information WHERE (LastName"."+', '+"."FirstName"."+' '+"."MiddleName) like "."'".$Data[2]."'"."";

			$execQuery=odbc_exec($connection, $SQLstring);
		if(!odbc_error($connection)){
			while(odbc_fetch_row($execQuery)){

			$trainerEmpIDVal=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			

		}
		}else{
			return 0;
		}
		$ClassConnection -> Close_connection($connection);
		}

		$alreadyExist=false;
		$userEmpID="";

		$connection= $ClassConnection -> Open_connection(2);

		if($connection){

			if($SQLstrCode==1){
			$SQLstring="SELECT UserEmpID FROM TB_Endorsement_Nesting WHERE ProcessID=".$ProcessCodeVal." AND UpdatedBatch like "."'".$Data[5]."'"."";
			}else{

			$SQLstring="SELECT UserEmpID FROM TB_Endorsement_Operation WHERE ProcessID=".$ProcessCodeVal." AND UpdatedBatch like "."'".$Data[5]."'"."";

			}

		$execQuery=odbc_exec($connection, $SQLstring);

		if(!odbc_error($connection)){
			while(odbc_fetch_row($execQuery)){
			$userEmpID=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			$alreadyExist=true;
			

		}

		}else{
			return 0;
		}

		$ClassConnection -> Close_connection($connection);

		}


		if($EnorsementSavingProcess=="Insert"){

		if($alreadyExist===false){

		$connection= $ClassConnection -> Open_connection(2);

		if($SQLstrCode==1){
		$SQLstring="INSERT INTO TB_Endorsement_Nesting (NotifTimeStamp,AgentsEmpId,ProcessID,TrainerEmpID,NumberBillable,EffectiveDate,UserEmpID,UpdatedBatch,Lock) VALUES (?,?,?,?,?,?,?,?,?)";
		}else{
		$SQLstring="INSERT INTO TB_Endorsement_Operation (NotifTimeStamp,AgentsEmpId,ProcessID,TrainerEmpID,NumberBillable,EffectiveDate,UserEmpID,UpdatedBatch,Lock) VALUES (?,?,?,?,?,?,?,?,?)";
		}


		$Datavalue[]=null;
		$Datavalue[0]=date('Y-m-d h:m:s');
		$Datavalue[1]=$Data[0];
		$Datavalue[2]=$ProcessCodeVal;
		$Datavalue[3]=$trainerEmpIDVal;
		$Datavalue[4]=$Data[4];
		$Datavalue[5]=date('Y-m-d',strtotime($Data[3]));
		$Datavalue[6]=$_SESSION['EmployeeID'];
		$Datavalue[7]=$Data[5];
		$Datavalue[8]="0";
		
		$prepExec=odbc_prepare($connection,$SQLstring);

       
        $execQuery=odbc_execute($prepExec,$Datavalue);

       if(!odbc_error($connection)){

       	$rowAffected=@odbc_num_rows($prepExec);

       	if( $rowAffected > 0){
        	
    	$InfoUpdateData=$Data;
    	
    	$InfoUpdateData[2]=$trainerEmpIDVal;

    	$ClassConnection -> Close_connection($connection);

    	if(date('Y-m-d',strtotime($Data[3])) <= date('Y-m-d')){

    		
    		if($SQLstrCode==1){
    		
    			$returnVal=$UpdateInfo -> EndorsementUpdateInfo($Data,$ProcessCodeVal,$trainerEmpIDVal,2,$EnorsementSavingProcess);
    			 
    		}else{

    			 $returnVal=$UpdateInfo -> EndorsementUpdateInfo($Data,$ProcessCodeVal,$trainerEmpIDVal,3,$EnorsementSavingProcess);
    		
    		}

    		

    	}else{

    		$returnVal=1;

    	}
    	
    

        }else{

        return 0;

        }

       	}else{

        return 0;

       	}

       

	   }else{

		 return 3;

	   }

	   }else{

	   	$connection= $ClassConnection -> Open_connection(2);
		
		if($SQLstrCode==1){
		$SQLstring="UPDATE TB_Endorsement_Nesting SET AgentsEmpId=?,ProcessID=?,TrainerEmpID=?,NumberBillable=?,EffectiveDate=?,UserEmpID=?,UpdatedBatch=? WHERE ProcessID=".$ProcessCodeVal." AND NestingDate="."'".date('Y-m-d',strtotime($Data[3]))."'"." AND UpdatedBatch like "."'".$Data[5]."'"."";
		}else{
		$SQLstring="UPDATE TB_Endorsement_Operation SET AgentsEmpId=?,ProcessID=?,TrainerEmpID=?,NumberBillable=?,EffectiveDate=?,UserEmpID=?,UpdatedBatch=? WHERE ProcessID=".$ProcessCodeVal." AND LiveDate="."'".date('Y-m-d',strtotime($Data[3]))."'"." AND UpdatedBatch like "."'".$Data[5]."'"."";
		
		}


		$Datavalue[]=null;

		$Datavalue[0]=$Data[0];
		$Datavalue[1]=$ProcessCodeVal;
		$Datavalue[2]=$trainerEmpIDVal;
		$Datavalue[3]=$Data[4];
		$Datavalue[4]=date('Y-m-d',strtotime($Data[3]));
		if($userEmpID==""){$Datavalue[5]=$_SESSION['EmployeeID'];}else{$Datavalue[5]=$userEmpID."/".$_SESSION['EmployeeID'];}
		$Datavalue[6]=$Data[5];
	
		
		$prepExec=odbc_prepare($connection,$SQLstring);

       
        $execQuery=odbc_execute($prepExec,$Datavalue);

       if(!odbc_error($connection)){

       	$rowAffected=@odbc_num_rows($prepExec);

       	if( $rowAffected > 0){
        	
    	$InfoUpdateData=$Data;
    	
    	$InfoUpdateData[2]=$trainerEmpIDVal;

    	$ClassConnection -> Close_connection($connection);

    		
    		if($SQLstrCode==1){
    		
    			$returnVal=$UpdateInfo -> EndorsementUpdateInfo($Data,$ProcessCodeVal,$trainerEmpIDVal,2,$EnorsementSavingProcess);
    			 
    		}else{

    			 $returnVal=$UpdateInfo -> EndorsementUpdateInfo($Data,$ProcessCodeVal,$trainerEmpIDVal,3,$EnorsementSavingProcess);
    		
    		}

        }else{

        return 0;

        }

       	}else{

        return 0;

       	}

	   }

	   return $returnVal;


}



?>