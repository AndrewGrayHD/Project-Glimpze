<?php


include "database_engine.php";
session_start();


$functionNumber=$_POST['functionNumber'];

switch ($functionNumber) {

	case 1:
		getTheOptionListForNotification();
	break;

	case 2:
		getTheOptionListForEndorsementInitial($_POST['SelectedOption1']);
	break;

	case 3:
		getTheOptionListForEndorsementBatch($_POST['SelectedOption2'],$_POST['SelectedOption3']);
	break;

	case 4:
		proceedFilterInMyRecord($_POST['DataVal']);
	break;
	
	
}




 			
      

function getTheOptionListForNotification(){

	try {
		
		$SQLstring="";
		$DataValue[]=null;
		$index=0;

		$ClassConnection=new DB_Connection();

	

		  	$SQLstring="SELECT CASE WHEN Stat_Remarks like 'Active' THEN 'Back to work' ELSE Stat_Remarks END FROM TB_Status WHERE Stat_Category NOT IN ('Leave with Pay')";

		  	$connection= $ClassConnection -> Open_connection(1);
		  	$execQuery=odbc_exec($connection, $SQLstring);

		  	while(odbc_fetch_row($execQuery)){

			$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));

			
			$DataValue[$index]=$fieldValue;
			$index++;

		
			}

		  	$ClassConnection -> Close_connection($connection);	
		  	echo json_encode($DataValue);


          

         

		} catch (Exception $e) {
			
		}	

}

function getTheOptionListForEndorsementInitial($Selection){

		try {	
				$SQLstring="";
				$DataValue[]=null;
				$index=0;

				$table=['TB_Endorsement_Training','TB_Endorsement_Nesting','TB_Endorsement_Operation'];

				$ClassConnection=new DB_Connection();

				
 					
				if($Selection=="--All--"){

				
				for($ace=0; $ace < count($table); $ace++){
				
				if($_SESSION['AccesType']=="Supervisor"){
					$SQLstring="SELECT b.ProcessName FROM ".$table[$ace]." a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode WHERE a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." ORDER BY b.ProcessName ASC";
				}else if($_SESSION['AccesType']=="Manager" || $_SESSION['AccesType']=="Supervisor2"){

					$FullName=$_SESSION['LastName'].",".$_SESSION['FirstName'];

					if($_SESSION['MiddleName'] !="" && $_SESSION['MiddleName'] !=null){
						$FullName=$FullName." ".$_SESSION['MiddleName'];
					}

					$SQLstring="SELECT b.ProcessName FROM ".$table[$ace]." a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode JOIN  DB_Employee_Management_System.dbo.TB_Information c ON a.UserEmpID like c.EmployeeID +'%'  JOIN DB_Employee_Management_System.dbo.TB_Hierarchy d ON c.TableID=d.TableID WHERE (a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." OR "."'".$FullName."'"." IN (d.Supervisor1,d.Supervisor2,d.Supervisor3,d.Supervisor4,d.Supervisor5))"." ORDER BY b.ProcessName ASC";
				}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="HumanResources"){

					$SQLstring="SELECT b.ProcessName FROM ".$table[$ace]." a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode ORDER BY b.ProcessName ASC";
				}

				

				$connection= $ClassConnection -> Open_connection(2);
		  		$execQuery=odbc_exec($connection, $SQLstring);
		  		while(odbc_fetch_row($execQuery)){
				$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
				if(in_array ($fieldValue, $DataValue)==false){
				$DataValue[$index]=$fieldValue;
				$index++;
				}
				}
		  		$ClassConnection -> Close_connection($connection);	

		  		}

				}



				if($Selection=="Training"){

			
				if($_SESSION['AccesType']=="Supervisor"){
					$SQLstring="SELECT b.ProcessName FROM TB_Endorsement_Training a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode WHERE a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." ORDER BY b.ProcessName ASC";
				}else if($_SESSION['AccesType']=="Manager" || $_SESSION['AccesType']=="Supervisor2"){

					$FullName=$_SESSION['LastName'].",".$_SESSION['FirstName'];

					if($_SESSION['MiddleName'] !="" && $_SESSION['MiddleName'] !=null){
						$FullName=$FullName." ".$_SESSION['MiddleName'];
					}

					$SQLstring="SELECT b.ProcessName FROM TB_Endorsement_Training a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode JOIN  DB_Employee_Management_System.dbo.TB_Information c ON a.UserEmpID like c.EmployeeID +'%' JOIN  DB_Employee_Management_System.dbo.TB_Hierarchy d ON c.TableID=d.TableID WHERE (a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." OR "."'".$FullName."'"." IN (d.Supervisor1,d.Supervisor2,d.Supervisor3,d.Supervisor4,d.Supervisor5))"." ORDER BY b.ProcessName ASC";
				}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="HumanResources"){

					$SQLstring="SELECT b.ProcessName FROM TB_Endorsement_Training a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode ORDER BY b.ProcessName ASC";
				}



				$connection= $ClassConnection -> Open_connection(2);
		  		$execQuery=odbc_exec($connection, $SQLstring);
		  		while(odbc_fetch_row($execQuery)){
				$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
				if(in_array ($fieldValue, $DataValue)==false){
				$DataValue[$index]=$fieldValue;
				$index++;
				}
				}
		  		$ClassConnection -> Close_connection($connection);	

		  		
				}else if($Selection=="Nesting"){

				
				if($_SESSION['AccesType']=="Supervisor"){
					$SQLstring="SELECT b.ProcessName FROM TB_Endorsement_Nesting a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode WHERE a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." ORDER BY b.ProcessName ASC";
				}else if($_SESSION['AccesType']=="Manager" || $_SESSION['AccesType']=="Supervisor2"){

					$FullName=$_SESSION['LastName'].",".$_SESSION['FirstName'];

					if($_SESSION['MiddleName'] !="" && $_SESSION['MiddleName'] !=null){
						$FullName=$FullName." ".$_SESSION['MiddleName'];
					}

					$SQLstring="SELECT b.ProcessName FROM TB_Endorsement_Nesting a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode JOIN  DB_Employee_Management_System.dbo.TB_Information c ON a.UserEmpID like c.EmployeeID +'%' JOIN  DB_Employee_Management_System.dbo.TB_Hierarchy d ON c.TableID=d.TableID WHERE (a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." OR "."'".$FullName."'"." IN (d.Supervisor1,d.Supervisor2,d.Supervisor3,d.Supervisor4,d.Supervisor5))"." ORDER BY b.ProcessName ASC";
				}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="HumanResources"){

					$SQLstring="SELECT b.ProcessName FROM TB_Endorsement_Nesting a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode ORDER BY b.ProcessName ASC";
				}

				$connection= $ClassConnection -> Open_connection(2);
		  		$execQuery=odbc_exec($connection, $SQLstring);
		  		while(odbc_fetch_row($execQuery)){
				$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
				if(in_array ($fieldValue, $DataValue)==false){
				$DataValue[$index]=$fieldValue;
				$index++;
				}
				}
		  		$ClassConnection -> Close_connection($connection);	

				}else if($Selection=="Operation"){


				if($_SESSION['AccesType']=="Supervisor"){
					$SQLstring="SELECT b.ProcessName FROM TB_Endorsement_Operation a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode WHERE a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." ORDER BY b.ProcessName ASC";
				}else if($_SESSION['AccesType']=="Manager" || $_SESSION['AccesType']=="Supervisor2"){

					$FullName=$_SESSION['LastName'].",".$_SESSION['FirstName'];

					if($_SESSION['MiddleName'] !="" && $_SESSION['MiddleName'] !=null){
						$FullName=$FullName." ".$_SESSION['MiddleName'];
					}

					$SQLstring="SELECT b.ProcessName FROM TB_Endorsement_Operation a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode JOIN  DB_Employee_Management_System.dbo.TB_Information c ON a.UserEmpID like c.EmployeeID +'%' JOIN  DB_Employee_Management_System.dbo.TB_Hierarchy d ON c.TableID=d.TableID WHERE (a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." OR "."'".$FullName."'"." IN (d.Supervisor1,d.Supervisor2,d.Supervisor3,d.Supervisor4,d.Supervisor5))"." ORDER BY b.ProcessName ASC";
				}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="HumanResources"){

					$SQLstring="SELECT b.ProcessName FROM TB_Endorsement_Operation a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode ORDER BY b.ProcessName ASC";
				}

				$connection= $ClassConnection -> Open_connection(2);
		  		$execQuery=odbc_exec($connection, $SQLstring);
		  		while(odbc_fetch_row($execQuery)){
				$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
				if(in_array ($fieldValue, $DataValue)==false){
				$DataValue[$index]=$fieldValue;
				$index++;
				}
				}
		  		$ClassConnection -> Close_connection($connection);	

				}

 					



 		} catch (Exception $e) {
			
		}	


}


function getTheOptionListForEndorsementBatch($Selection,$Selection2){

		try {	
				$SQLstring="";
				$DataValue[]=null;
				$index=0;

				$table=['TB_Endorsement_Training','TB_Endorsement_Nesting','TB_Endorsement_Operation'];

				$ClassConnection=new DB_Connection();

				
 					
				if($Selection=="--All--"){

				
				for($ace=0; $ace < count($table); $ace++){
						

				if($_SESSION['AccesType']=="Supervisor"){
					$SQLstring="SELECT b.UpdatedBatch FROM ".$table[$ace]." a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode WHERE a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." AND b.ProcessName like "."'".$Selection2."'"." ORDER BY b.ProcessName ASC";
				}else if($_SESSION['AccesType']=="Manager" || $_SESSION['AccesType']=="Supervisor2"){

					$FullName=$_SESSION['LastName'].",".$_SESSION['FirstName'];

					if($_SESSION['MiddleName'] !="" && $_SESSION['MiddleName'] !=null){
						$FullName=$FullName." ".$_SESSION['MiddleName'];
					}

					$SQLstring="SELECT b.UpdatedBatch FROM ".$table[$ace]." a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode JOIN  DB_Employee_Management_System.dbo.TB_Information c ON a.UserEmpID like c.EmployeeID +'%'  JOIN DB_Employee_Management_System.dbo.TB_Hierarchy d ON c.TableID=d.TableID WHERE (a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." OR "."'".$FullName."'"." IN (d.Supervisor1,d.Supervisor2,d.Supervisor3,d.Supervisor4,d.Supervisor5))"." AND b.ProcessName like "."'".$Selection2."'"." ORDER BY b.ProcessName ASC";
				}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="HumanResources"){

					$SQLstring="SELECT b.UpdatedBatch FROM ".$table[$ace]." a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode"." WHERE b.ProcessName like "."'".$Selection2."'"." ORDER BY b.ProcessName ASC";
				}


				$connection= $ClassConnection -> Open_connection(2);
		  		$execQuery=odbc_exec($connection, $SQLstring);
		  		while(odbc_fetch_row($execQuery)){
				$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
				if(in_array ($fieldValue, $DataValue)==false){
				$DataValue[$index]=$fieldValue;
				$index++;
				}
				}
		  		$ClassConnection -> Close_connection($connection);	

		  		}
		  		
				}



				if($Selection=="Training"){

			

				if($_SESSION['AccesType']=="Supervisor"){

					$SQLstring="SELECT b.UpdatedBatch FROM TB_Endorsement_Training a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode WHERE a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." AND b.ProcessName like "."'".$Selection2."'"." ORDER BY b.ProcessName ASC";
				}else if($_SESSION['AccesType']=="Manager" || $_SESSION['AccesType']=="Supervisor2"){

					$FullName=$_SESSION['LastName'].",".$_SESSION['FirstName'];

					if($_SESSION['MiddleName'] !="" && $_SESSION['MiddleName'] !=null){
						$FullName=$FullName." ".$_SESSION['MiddleName'];
					}

					$SQLstring="SELECT b.UpdatedBatch FROM TB_Endorsement_Training a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode JOIN  DB_Employee_Management_System.dbo.TB_Information c ON a.UserEmpID like c.EmployeeID +'%' JOIN  DB_Employee_Management_System.dbo.TB_Hierarchy d ON c.TableID=d.TableID WHERE (a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." OR "."'".$FullName."'"." IN (d.Supervisor1,d.Supervisor2,d.Supervisor3,d.Supervisor4,d.Supervisor5))"." AND b.ProcessName like "."'".$Selection2."'"." ORDER BY b.ProcessName ASC";
				}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="HumanResources"){

					$SQLstring="SELECT b.UpdatedBatch FROM TB_Endorsement_Training a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode"." WHERE b.ProcessName like "."'".$Selection2."'"." ORDER BY b.ProcessName ASC";
				}

				$connection= $ClassConnection -> Open_connection(2);
		  		$execQuery=odbc_exec($connection, $SQLstring);
		  		while(odbc_fetch_row($execQuery)){
				$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
				if(in_array ($fieldValue, $DataValue)==false){
				$DataValue[$index]=$fieldValue;
				$index++;
				}
				}
		  		$ClassConnection -> Close_connection($connection);	

		  		
				}else if($Selection=="Nesting"){

				
				if($_SESSION['AccesType']=="Supervisor"){
					$SQLstring="SELECT b.UpdatedBatch FROM TB_Endorsement_Nesting a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode WHERE a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." AND b.ProcessName like "."'".$Selection2."'"." ORDER BY b.ProcessName ASC";
				}else if($_SESSION['AccesType']=="Manager" || $_SESSION['AccesType']=="Supervisor2"){

					$FullName=$_SESSION['LastName'].",".$_SESSION['FirstName'];

					if($_SESSION['MiddleName'] !="" && $_SESSION['MiddleName'] !=null){
						$FullName=$FullName." ".$_SESSION['MiddleName'];
					}

					$SQLstring="SELECT b.UpdatedBatch FROM TB_Endorsement_Nesting a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode  JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.UserEmpID like c.EmployeeID +'%' JOIN  DB_Employee_Management_System.dbo.TB_Hierarchy d ON c.TableID=d.TableID WHERE (a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." OR "."'".$FullName."'"." IN (d.Supervisor1,d.Supervisor2,d.Supervisor3,d.Supervisor4,d.Supervisor5))"." AND b.ProcessName like "."'".$Selection2."'"." ORDER BY b.ProcessName ASC";
				}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="HumanResources"){

					$SQLstring="SELECT b.UpdatedBatch FROM TB_Endorsement_Nesting a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode"." WHERE b.ProcessName like "."'".$Selection2."'"." ORDER BY b.ProcessName ASC";
				}

				$connection= $ClassConnection -> Open_connection(2);
		  		$execQuery=odbc_exec($connection, $SQLstring);
		  		while(odbc_fetch_row($execQuery)){
				$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
				if(in_array ($fieldValue, $DataValue)==false){
				$DataValue[$index]=$fieldValue;
				$index++;
				}
				}
		  		$ClassConnection -> Close_connection($connection);	

				}else if($Selection=="Operation"){

				
				if($_SESSION['AccesType']=="Supervisor"){
					$SQLstring="SELECT b.UpdatedBatch FROM TB_Endorsement_Operation a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode WHERE a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." AND b.ProcessName like "."'".$Selection2."'"." ORDER BY b.ProcessName ASC";
				}else if($_SESSION['AccesType']=="Manager" || $_SESSION['AccesType']=="Supervisor2"){

					$FullName=$_SESSION['LastName'].",".$_SESSION['FirstName'];

					if($_SESSION['MiddleName'] !="" && $_SESSION['MiddleName'] !=null){
						$FullName=$FullName." ".$_SESSION['MiddleName'];
					}

					$SQLstring="SELECT b.UpdatedBatch FROM TB_Endorsement_Operation a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode  JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.UserEmpID like c.EmployeeID +'%' JOIN  DB_Employee_Management_System.dbo.TB_Hierarchy d ON c.TableID=d.TableID WHERE (a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." OR "."'".$FullName."'"." IN (d.Supervisor1,d.Supervisor2,d.Supervisor3,d.Supervisor4,d.Supervisor5))"." AND b.ProcessName like "."'".$Selection2."'"." ORDER BY b.ProcessName ASC";
				}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="HumanResources"){

					$SQLstring="SELECT b.UpdatedBatch FROM TB_Endorsement_Operation a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode"." WHERE b.ProcessName like "."'".$Selection2."'"." ORDER BY b.ProcessName ASC";
				}


				$connection= $ClassConnection -> Open_connection(2);
		  		$execQuery=odbc_exec($connection, $SQLstring);
		  		while(odbc_fetch_row($execQuery)){
				$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
				if(in_array ($fieldValue, $DataValue)==false){
				$DataValue[$index]=$fieldValue;
				$index++;
				}
				}
		  		$ClassConnection -> Close_connection($connection);	

				}

 					



 		} catch (Exception $e) {
			
		}


}

function proceedFilterInMyRecord($Data){



		try {

				$SQLstring="";
				$dataValue[][]=null;
				$index=0;

				$ClassConnection=new DB_Connection();

				if($Data[0]=="Notification"){

					if($Data[1]=="--All--"){



						if($_SESSION['AccesType']=="Supervisor"){


							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,'Resigned',a.EffectiveDate,a.Lock  FROM TB_Resignation_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID WHERE a.EffectiveDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." AND SenderEmpID like "."'".$_SESSION['EmployeeID']."%'"." ORDER BY a.DateRequest DESC";


						}else if($_SESSION['AccesType']=="Manager" || $_SESSION['AccesType']=="Supervisor2"){

							$FullName=$_SESSION['LastName'].",".$_SESSION['FirstName'];

							if($_SESSION['MiddleName'] !="" && $_SESSION['MiddleName'] !=null){
							$FullName=$FullName." ".$_SESSION['MiddleName'];
							}

							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,'Resigned',a.EffectiveDate,a.Lock  FROM TB_Resignation_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.SenderEmpID like c.EmployeeID + '%' JOIN DB_Employee_Management_System.dbo.TB_Hierarchy d ON c.TableID=d.TableID WHERE a.EffectiveDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." AND (SenderEmpID like "."'".$_SESSION['EmployeeID']."%'"." OR "."'".$FullName."'"." IN (d.Supervisor1,d.Supervisor2,d.Supervisor3,d.Supervisor4,d.Supervisor5)".") ORDER BY a.DateRequest DESC";


						}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="HumanResources"){


							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,'Resigned',a.EffectiveDate,a.Lock  FROM TB_Resignation_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID WHERE a.EffectiveDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." ORDER BY a.DateRequest DESC";


						}


							$connection= $ClassConnection -> Open_connection(2);

							$execQuery=odbc_exec($connection, $SQLstring);

							
							while(odbc_fetch_row($execQuery)){

								for($a=1;$a <= odbc_num_fields($execQuery);$a++){
								if($a==1){
								$dataValue[$a-1][$index]=date("Y-m-d",odbc_result($execQuery, odbc_field_name($execQuery, $a)));
								}else{
								$dataValue[$a-1][$index]=odbc_result($execQuery, odbc_field_name($execQuery, $a));	
								}
								
								}

								$index++;
							}

							$ClassConnection -> Close_connection($connection);



			

						if($_SESSION['AccesType']=="Supervisor"){


							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,c.Stat_Remarks,a.EffectiveDate,a.Lock  FROM TB_autoSeparate_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_Status c ON a.StatusCode=c.Stat_Num WHERE a.EffectiveDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." AND SenderEmpID like "."'".$_SESSION['EmployeeID']."%'"." ORDER BY a.DateRequest DESC";


						}else if($_SESSION['AccesType']=="Manager" || $_SESSION['AccesType']=="Supervisor2"){

							$FullName=$_SESSION['LastName'].",".$_SESSION['FirstName'];

							if($_SESSION['MiddleName'] !="" && $_SESSION['MiddleName'] !=null){
							$FullName=$FullName." ".$_SESSION['MiddleName'];
							}

							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,e.Stat_Remarks,a.EffectiveDate,a.Lock  FROM TB_autoSeparate_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.SenderEmpID like c.EmployeeID + '%' JOIN DB_Employee_Management_System.dbo.TB_Hierarchy d ON c.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON a.StatusCode=e.Stat_Num WHERE a.EffectiveDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." AND (SenderEmpID like "."'".$_SESSION['EmployeeID']."%'"." OR "."'".$FullName."'"." IN (d.Supervisor1,d.Supervisor2,d.Supervisor3,d.Supervisor4,d.Supervisor5)".") ORDER BY a.DateRequest DESC";


						}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="HumanResources"){


							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,c.Stat_Remarks,a.EffectiveDate,a.Lock  FROM TB_autoSeparate_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_Status c ON a.StatusCode=c.Stat_Num WHERE a.EffectiveDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." ORDER BY a.DateRequest DESC";


						}

							$connection= $ClassConnection -> Open_connection(2);

							$execQuery=odbc_exec($connection, $SQLstring);

							
							while(odbc_fetch_row($execQuery)){

								for($a=1;$a <= odbc_num_fields($execQuery);$a++){
								if($a==1){
								$dataValue[$a-1][$index]=date("Y-m-d",odbc_result($execQuery, odbc_field_name($execQuery, $a)));
								}else{
								$dataValue[$a-1][$index]=odbc_result($execQuery, odbc_field_name($execQuery, $a));	
								}
								}

								$index++;
							}

							$ClassConnection -> Close_connection($connection);



						if($_SESSION['AccesType']=="Supervisor"){


							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,c.Stat_Remarks,a.EffectiveDate,a.Lock  FROM TB_Air_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_Status c ON a.StatusCode=c.Stat_Num WHERE a.EffectiveDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." AND SenderEmpID like "."'".$_SESSION['EmployeeID']."%'"." ORDER BY a.DateRequest DESC";


						}else if($_SESSION['AccesType']=="Manager" || $_SESSION['AccesType']=="Supervisor2"){

							$FullName=$_SESSION['LastName'].",".$_SESSION['FirstName'];

							if($_SESSION['MiddleName'] !="" && $_SESSION['MiddleName'] !=null){
							$FullName=$FullName." ".$_SESSION['MiddleName'];
							}

							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,e.Stat_Remarks,a.EffectiveDate,a.Lock  FROM TB_Air_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.SenderEmpID like c.EmployeeID + '%' JOIN DB_Employee_Management_System.dbo.TB_Hierarchy d ON c.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON a.StatusCode=e.Stat_Num WHERE a.EffectiveDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." AND (SenderEmpID like "."'".$_SESSION['EmployeeID']."%'"." OR "."'".$FullName."'"." IN (d.Supervisor1,d.Supervisor2,d.Supervisor3,d.Supervisor4,d.Supervisor5)".") ORDER BY a.DateRequest DESC";


						}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="HumanResources"){


							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,c.Stat_Remarks,a.EffectiveDate,a.Lock  FROM TB_Air_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_Status c ON a.StatusCode=c.Stat_Num WHERE a.EffectiveDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." ORDER BY a.DateRequest DESC";


						}

							$connection= $ClassConnection -> Open_connection(2);

							$execQuery=odbc_exec($connection, $SQLstring);

							
							while(odbc_fetch_row($execQuery)){

								for($a=1;$a <= odbc_num_fields($execQuery);$a++){
								if($a==1){
								$dataValue[$a-1][$index]=date("Y-m-d",odbc_result($execQuery, odbc_field_name($execQuery, $a)));
								}else{
								$dataValue[$a-1][$index]=odbc_result($execQuery, odbc_field_name($execQuery, $a));	
								}
								}

								$index++;
							}

							$ClassConnection -> Close_connection($connection);


						if($_SESSION['AccesType']=="Supervisor"){


							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,'Back to work',a.ReturnDate,a.Lock  FROM TB_BackToWork_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID WHERE a.ReturnDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." AND SenderEmpID like "."'".$_SESSION['EmployeeID']."%'"." ORDER BY a.DateRequest DESC";


						}else if($_SESSION['AccesType']=="Manager" || $_SESSION['AccesType']=="Supervisor2"){

							$FullName=$_SESSION['LastName'].",".$_SESSION['FirstName'];

							if($_SESSION['MiddleName'] !="" && $_SESSION['MiddleName'] !=null){
							$FullName=$FullName." ".$_SESSION['MiddleName'];
							}

							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,'Back to work',a.ReturnDate,a.Lock  FROM TB_BackToWork_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.SenderEmpID like c.EmployeeID + '%' JOIN DB_Employee_Management_System.dbo.TB_Hierarchy d ON c.TableID=d.TableID WHERE a.ReturnDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." AND (SenderEmpID like "."'".$_SESSION['EmployeeID']."%'"." OR "."'".$FullName."'"." IN (d.Supervisor1,d.Supervisor2,d.Supervisor3,d.Supervisor4,d.Supervisor5)".") ORDER BY a.DateRequest DESC";


						}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="HumanResources"){


							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,'Back to work',a.ReturnDate,a.Lock  FROM TB_BackToWork_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID WHERE a.ReturnDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." ORDER BY a.DateRequest DESC";


						}



							$connection= $ClassConnection -> Open_connection(2);

							$execQuery=odbc_exec($connection, $SQLstring);

							
							while(odbc_fetch_row($execQuery)){

								for($a=1;$a <= odbc_num_fields($execQuery);$a++){
								if($a==1){
								$dataValue[$a-1][$index]=date("Y-m-d",odbc_result($execQuery, odbc_field_name($execQuery, $a)));
								}else{
								$dataValue[$a-1][$index]=odbc_result($execQuery, odbc_field_name($execQuery, $a));	
								}
								}

								$index++;
							}

							$ClassConnection -> Close_connection($connection);


					}else{

						if($DataVal[1]=="Resigned"){

					

						if($_SESSION['AccesType']=="Supervisor"){


							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,'Resigned',a.EffectiveDate,a.Lock  FROM TB_Resignation_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID WHERE a.EffectiveDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." AND SenderEmpID like "."'".$_SESSION['EmployeeID']."%'"." ORDER BY a.DateRequest DESC";


						}else if($_SESSION['AccesType']=="Manager" || $_SESSION['AccesType']=="Supervisor2"){

							$FullName=$_SESSION['LastName'].",".$_SESSION['FirstName'];

							if($_SESSION['MiddleName'] !="" && $_SESSION['MiddleName'] !=null){
							$FullName=$FullName." ".$_SESSION['MiddleName'];
							}

							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,'Resigned',a.EffectiveDate,a.Lock  FROM TB_Resignation_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.SenderEmpID like c.EmployeeID + '%' JOIN DB_Employee_Management_System.dbo.TB_Hierarchy d ON c.TableID=d.TableID WHERE a.EffectiveDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." AND (SenderEmpID like "."'".$_SESSION['EmployeeID']."%'"." OR "."'".$FullName."'"." IN (d.Supervisor1,d.Supervisor2,d.Supervisor3,d.Supervisor4,d.Supervisor5)".") ORDER BY a.DateRequest DESC";


						}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="HumanResources"){


							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,'Resigned',a.EffectiveDate,a.Lock  FROM TB_Resignation_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID WHERE a.EffectiveDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." ORDER BY a.DateRequest DESC";


						}


							$connection= $ClassConnection -> Open_connection(2);

							$execQuery=odbc_exec($connection, $SQLstring);

							
							while(odbc_fetch_row($execQuery)){

								for($a=1;$a <= odbc_num_fields($execQuery);$a++){
								if($a==1){
								$dataValue[$a-1][$index]=date("Y-m-d",odbc_result($execQuery, odbc_field_name($execQuery, $a)));
								}else{
								$dataValue[$a-1][$index]=odbc_result($execQuery, odbc_field_name($execQuery, $a));	
								}
								}

								$index++;
							}

							$ClassConnection -> Close_connection($connection);

						}else if($DataVal[1]=="Back to work"){

						

						if($_SESSION['AccesType']=="Supervisor"){


							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,'Back to work',a.ReturnDate,a.Lock  FROM TB_BackToWork_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID WHERE a.ReturnDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." AND SenderEmpID like "."'".$_SESSION['EmployeeID']."%'"." ORDER BY a.DateRequest DESC";


						}else if($_SESSION['AccesType']=="Manager" || $_SESSION['AccesType']=="Supervisor2"){

							$FullName=$_SESSION['LastName'].",".$_SESSION['FirstName'];

							if($_SESSION['MiddleName'] !="" && $_SESSION['MiddleName'] !=null){
							$FullName=$FullName." ".$_SESSION['MiddleName'];
							}

							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,'Back to work',a.ReturnDate,a.Lock  FROM TB_BackToWork_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.SenderEmpID like c.EmployeeID + '%' JOIN DB_Employee_Management_System.dbo.TB_Hierarchy d ON c.TableID=d.TableID WHERE a.ReturnDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." AND (SenderEmpID like "."'".$_SESSION['EmployeeID']."%'"." OR "."'".$FullName."'"." IN (d.Supervisor1,d.Supervisor2,d.Supervisor3,d.Supervisor4,d.Supervisor5)".") ORDER BY a.DateRequest DESC";


						}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="HumanResources"){


							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,'Back to work',a.ReturnDate,a.Lock  FROM TB_BackToWork_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID WHERE a.ReturnDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." ORDER BY a.DateRequest DESC";


						}

							$connection= $ClassConnection -> Open_connection(2);

							$execQuery=odbc_exec($connection, $SQLstring);

							
							while(odbc_fetch_row($execQuery)){

								for($a=1;$a <= odbc_num_fields($execQuery);$a++){
								if($a==1){
								$dataValue[$a-1][$index]=date("Y-m-d",odbc_result($execQuery, odbc_field_name($execQuery, $a)));
								}else{
								$dataValue[$a-1][$index]=odbc_result($execQuery, odbc_field_name($execQuery, $a));	
								}
								}

								$index++;
							}

							$ClassConnection -> Close_connection($connection);

						}else{

							$SQLstring="SELECT Stat_Category,Stat_Num FROM TB_Status WHERE Stat_Remarks like "."'".$Data[1]."'"."";
							$connection= $ClassConnection -> Open_connection(1);

							$execQuery=odbc_exec($connection, $SQLstring);

							
							while(odbc_fetch_row($execQuery)){

							$StatCat=odbc_result($execQuery, odbc_field_name($execQuery, 1));
							$StatNum=odbc_result($execQuery, odbc_field_name($execQuery, 2));
							}

							$ClassConnection -> Close_connection($connection);

						if($StatCat=="Leave of absences"){


						if($_SESSION['AccesType']=="Supervisor"){


							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,c.Stat_Remarks,a.EffectiveDate,a.Lock  FROM TB_Air_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_Status c ON a.StatusCode=c.Stat_Num WHERE a.EffectiveDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." AND SenderEmpID like "."'".$_SESSION['EmployeeID']."%'"." AND c.Stat_Remarks like "."'".$Data[1]."'"." ORDER BY a.DateRequest DESC";


						}else if($_SESSION['AccesType']=="Manager" || $_SESSION['AccesType']=="Supervisor2"){

							$FullName=$_SESSION['LastName'].",".$_SESSION['FirstName'];

							if($_SESSION['MiddleName'] !="" && $_SESSION['MiddleName'] !=null){
							$FullName=$FullName." ".$_SESSION['MiddleName'];
							}

							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,e.Stat_Remarks,a.EffectiveDate,a.Lock  FROM TB_Air_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.SenderEmpID like c.EmployeeID + '%' JOIN DB_Employee_Management_System.dbo.TB_Hierarchy d ON c.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON a.StatusCode=e.Stat_Num WHERE a.EffectiveDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." AND (SenderEmpID like "."'".$_SESSION['EmployeeID']."%'"." OR "."'".$FullName."'"." IN (d.Supervisor1,d.Supervisor2,d.Supervisor3,d.Supervisor4,d.Supervisor5)".") AND c.Stat_Remarks like "."'".$Data[1]."'"." ORDER BY a.DateRequest DESC";


						}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="HumanResources"){


							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,c.Stat_Remarks,a.EffectiveDate,a.Lock  FROM TB_Air_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_Status c ON a.StatusCode=c.Stat_Num WHERE a.EffectiveDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." AND c.Stat_Remarks like "."'".$Data[1]."'"." ORDER BY a.DateRequest DESC";


						}


							$connection= $ClassConnection -> Open_connection(2);

							$execQuery=odbc_exec($connection, $SQLstring);

							
							while(odbc_fetch_row($execQuery)){

								for($a=1;$a <= odbc_num_fields($execQuery);$a++){
								if($a==1){
								$dataValue[$a-1][$index]=date("Y-m-d",odbc_result($execQuery, odbc_field_name($execQuery, $a)));
								}else{
								$dataValue[$a-1][$index]=odbc_result($execQuery, odbc_field_name($execQuery, $a));	
								}
								}

								$index++;
							}

							$ClassConnection -> Close_connection($connection);

						}else if($StatCat=="Separated"){

						
						if($_SESSION['AccesType']=="Supervisor"){


							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,c.Stat_Remarks,a.EffectiveDate,a.Lock  FROM TB_autoSeparate_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_Status c ON a.StatusCode=c.Stat_Num WHERE a.EffectiveDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." AND SenderEmpID like "."'".$_SESSION['EmployeeID']."%'"." AND c.Stat_Remarks like "."'".$Data[1]."'"." ORDER BY a.DateRequest DESC";


						}else if($_SESSION['AccesType']=="Manager" || $_SESSION['AccesType']=="Supervisor2"){

							$FullName=$_SESSION['LastName'].",".$_SESSION['FirstName'];

							if($_SESSION['MiddleName'] !="" && $_SESSION['MiddleName'] !=null){
							$FullName=$FullName." ".$_SESSION['MiddleName'];
							}

							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,e.Stat_Remarks,a.EffectiveDate,a.Lock  FROM TB_autoSeparate_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.SenderEmpID like c.EmployeeID + '%' JOIN DB_Employee_Management_System.dbo.TB_Hierarchy d ON c.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Status e ON a.StatusCode=e.Stat_Num WHERE a.EffectiveDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." AND (SenderEmpID like "."'".$_SESSION['EmployeeID']."%'"." OR "."'".$FullName."'"." IN (d.Supervisor1,d.Supervisor2,d.Supervisor3,d.Supervisor4,d.Supervisor5)".") AND c.Stat_Remarks like "."'".$Data[1]."'"." ORDER BY a.DateRequest DESC";


						}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="HumanResources"){


							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,c.Stat_Remarks,a.EffectiveDate,a.Lock  FROM TB_autoSeparate_Notification a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_Status c ON a.StatusCode=c.Stat_Num WHERE a.EffectiveDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." AND c.Stat_Remarks like "."'".$Data[1]."'"." ORDER BY a.DateRequest DESC";


						}

					
							$connection= $ClassConnection -> Open_connection(2);

							$execQuery=odbc_exec($connection, $SQLstring);

							
							while(odbc_fetch_row($execQuery)){

								for($a=1;$a <= odbc_num_fields($execQuery);$a++){
								if($a==1){
								$dataValue[$a-1][$index]=date("Y-m-d",odbc_result($execQuery, odbc_field_name($execQuery, $a)));
								}else{
								$dataValue[$a-1][$index]=odbc_result($execQuery, odbc_field_name($execQuery, $a));	
								}
								}

								$index++;
							}

							$ClassConnection -> Close_connection($connection);

							}



						}

						

					}

				}else if($Data[0]=="Process Modification"){ 




					if($Data[1]=="--All--"){

							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,a.NewProcess,a.EffectiveDate,a.Lock  FROM TB_Process_Modification_Request a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID WHERE a.EffectiveDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." ORDER BY a.DateRequest DESC";

					}else{

							$SQLstring="SELECT Stat_Num FROM TB_Status WHERE Stat_Remarks like "."'".$Data[1]."'"."";
							
							$connection= $ClassConnection -> Open_connection(1);

							$execQuery=odbc_exec($connection, $SQLstring);

							
							while(odbc_fetch_row($execQuery)){

							
							$StatNum2=odbc_result($execQuery, odbc_field_name($execQuery, 1));
							}

							$ClassConnection -> Close_connection($connection);

							$SQLstring="SELECT a.DateRequest,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,a.NewProcess,a.EffectiveDate,a.Lock  FROM TB_Process_Modification_Request a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.EmployeeID=b.EmployeeID WHERE a.EffectiveDate between "."'".date('Y-m-d',strtotime($Data[2]))."'"." AND "."'".date('Y-m-d',strtotime($Data[3]))."'"." AND NewProcess like "."'%".$StatNum2."%'"." ORDER BY a.DateRequest DESC";

					}


							$connection= $ClassConnection -> Open_connection(2);

							$execQuery=odbc_exec($connection, $SQLstring);

							
							while(odbc_fetch_row($execQuery)){

								for($a=1;$a <= odbc_num_fields($execQuery);$a++){
								if($a==1){
								$dataValue[$a-1][$index]=date("Y-m-d",odbc_result($execQuery, odbc_field_name($execQuery, $a)));
								}else{
								$dataValue[$a-1][$index]=odbc_result($execQuery, odbc_field_name($execQuery, $a));	
								}
								}

								$index++;
							}

							$ClassConnection -> Close_connection($connection);

				}else if($Data[0]=="Endorsement"){

				if($Data[1]=="--All--"){


				$table=['TB_Endorsement_Training','TB_Endorsement_Nesting','TB_Endorsement_Operation'];
				$effectivedDate=['TrainingDate','NestingDate','LiveDate'];

				for($ace=0; $ace < count($table); $ace++){
						

				if($_SESSION['AccesType']=="Supervisor"){

					$SQLstring="SELECT a.NotifTimeStamp,c.ProcessName,a.UpdatedBatch,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,a.".$effectivedDate[$ace].",a.Lock FROM ".$table[$ace]." a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.TrainerEmpID=b.EmployeeID JOIN TB_ProcessList c ON a.ProcessID=c.ProcessCode WHERE a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." AND c.ProcessName like "."'".$Data[2]."'"." AND a.UpdatedBatch like "."'".$Data[3]."'"." ORDER BY a.NotifTimeStamp DESC";

				}else if($_SESSION['AccesType']=="Manager" || $_SESSION['AccesType']=="Supervisor2"){

					$FullName=$_SESSION['LastName'].",".$_SESSION['FirstName'];

					if($_SESSION['MiddleName'] !="" && $_SESSION['MiddleName'] !=null){
						$FullName=$FullName." ".$_SESSION['MiddleName'];
					}

					$SQLstring="SELECT a.NotifTimeStamp,b.ProcessName,a.UpdatedBatch,(e.LastName"."+', '+"."e.FirstName"."+' '+"."e.MiddleName) as Name,a.".$effectivedDate[$ace].",a.Lock FROM ".$table[$ace]." a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode  JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.UserEmpID like c.EmployeeID + '%'  JOIN DB_Employee_Management_System.dbo.TB_Hierarchy d ON c.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Information e ON a.TrainerEmpID=e.EmployeeID WHERE (a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." OR "."'".$FullName."'"." IN (d.Supervisor1,d.Supervisor2,d.Supervisor3,d.Supervisor4,d.Supervisor5))"." AND b.ProcessName like "."'".$Data[2]."'"." AND a.UpdatedBatch like "."'".$Data[3]."'"." ORDER BY a.NotifTimeStamp DESC";
					
				}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="HumanResources"){

					$SQLstring="SELECT a.NotifTimeStamp,b.ProcessName,a.UpdatedBatch,(c.LastName"."+', '+"."c.FirstName"."+' '+"."c.MiddleName) as Name,a.".$effectivedDate[$ace].",a.Lock FROM ".$table[$ace]." a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.TrainerEmpID=c.EmployeeID"." WHERE b.ProcessName like "."'".$Data[2]."'"." AND a.UpdatedBatch like "."'".$Data[3]."'"." ORDER BY a.NotifTimeStamp DESC";
				}


					$connection= $ClassConnection -> Open_connection(2);

							$execQuery=odbc_exec($connection, $SQLstring);

							
							while(odbc_fetch_row($execQuery)){

								for($a=1;$a <= odbc_num_fields($execQuery);$a++){
								if($a==1){
								$dataValue[$a-1][$index]=date("Y-m-d",odbc_result($execQuery, odbc_field_name($execQuery, $a)));
								}else{
								$dataValue[$a-1][$index]=odbc_result($execQuery, odbc_field_name($execQuery, $a));	
								}
								}

								$index++;
							}

							$ClassConnection -> Close_connection($connection);

		  		}

				}else{

				if($Data[1]=="Training"){

				if($_SESSION['AccesType']=="Supervisor"){

					$SQLstring="SELECT a.NotifTimeStamp,c.ProcessName,a.UpdatedBatch,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,a.TrainingDate,a.Lock FROM TB_Endorsement_Training a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.TrainerEmpID=b.EmployeeID JOIN TB_ProcessList c ON a.ProcessID=c.ProcessCode WHERE a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." AND c.ProcessName like "."'".$Data[2]."'"." AND a.UpdatedBatch like "."'".$Data[3]."'"." ORDER BY a.NotifTimeStamp DESC";

				}else if($_SESSION['AccesType']=="Manager" || $_SESSION['AccesType']=="Supervisor2"){

					$FullName=$_SESSION['LastName'].",".$_SESSION['FirstName'];

					if($_SESSION['MiddleName'] !="" && $_SESSION['MiddleName'] !=null){
						$FullName=$FullName." ".$_SESSION['MiddleName'];
					}

					$SQLstring="SELECT a.NotifTimeStamp,b.ProcessName,a.UpdatedBatch,(e.LastName"."+', '+"."e.FirstName"."+' '+"."e.MiddleName) as Name,a.TrainingDate,a.Lock FROM TB_Endorsement_Training a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode  JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.UserEmpID like c.EmployeeID + '%'  JOIN DB_Employee_Management_System.dbo.TB_Hierarchy d ON c.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Information e ON a.TrainerEmpID=e.EmployeeID WHERE (a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." OR "."'".$FullName."'"." IN (d.Supervisor1,d.Supervisor2,d.Supervisor3,d.Supervisor4,d.Supervisor5))"." AND b.ProcessName like "."'".$Data[2]."'"." AND a.UpdatedBatch like "."'".$Data[3]."'"." ORDER BY a.NotifTimeStamp DESC";
					
				}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="HumanResources"){

					$SQLstring="SELECT a.NotifTimeStamp,b.ProcessName,a.UpdatedBatch,(c.LastName"."+', '+"."c.FirstName"."+' '+"."c.MiddleName) as Name,a.TrainingDate,a.Lock FROM TB_Endorsement_Training a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.TrainerEmpID=c.EmployeeID"." WHERE b.ProcessName like "."'".$Data[2]."'"." AND a.UpdatedBatch like "."'".$Data[3]."'"." ORDER BY a.NotifTimeStamp DESC";
				}

							$connection= $ClassConnection -> Open_connection(2);

							$execQuery=odbc_exec($connection, $SQLstring);

							
							while(odbc_fetch_row($execQuery)){

								for($a=1;$a <= odbc_num_fields($execQuery);$a++){
								if($a==1){
								$dataValue[$a-1][$index]=date("Y-m-d",odbc_result($execQuery, odbc_field_name($execQuery, $a)));
								}else{
								$dataValue[$a-1][$index]=odbc_result($execQuery, odbc_field_name($execQuery, $a));	
								}
								}

								$index++;
							}

							$ClassConnection -> Close_connection($connection);

				}else if($Data[1]=="Nesting"){

				if($_SESSION['AccesType']=="Supervisor"){

					$SQLstring="SELECT a.NotifTimeStamp,c.ProcessName,a.UpdatedBatch,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,a.NestingDate,a.Lock FROM TB_Endorsement_Nesting a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.TrainerEmpID=b.EmployeeID JOIN TB_ProcessList c ON a.ProcessID=c.ProcessCode WHERE a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." AND c.ProcessName like "."'".$Data[2]."'"." AND a.UpdatedBatch like "."'".$Data[3]."'"." ORDER BY a.NotifTimeStamp DESC";

				}else if($_SESSION['AccesType']=="Manager" || $_SESSION['AccesType']=="Supervisor2"){

					$FullName=$_SESSION['LastName'].",".$_SESSION['FirstName'];

					if($_SESSION['MiddleName'] !="" && $_SESSION['MiddleName'] !=null){
						$FullName=$FullName." ".$_SESSION['MiddleName'];
					}

					$SQLstring="SELECT a.NotifTimeStamp,b.ProcessName,a.UpdatedBatch,(e.LastName"."+', '+"."e.FirstName"."+' '+"."e.MiddleName) as Name,a.NestingDate,a.Lock FROM TB_Endorsement_Nesting a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode  JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.UserEmpID like c.EmployeeID + '%'  JOIN DB_Employee_Management_System.dbo.TB_Hierarchy d ON c.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Information e ON a.TrainerEmpID=e.EmployeeID WHERE (a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." OR "."'".$FullName."'"." IN (d.Supervisor1,d.Supervisor2,d.Supervisor3,d.Supervisor4,d.Supervisor5))"." AND b.ProcessName like "."'".$Data[2]."'"." AND a.UpdatedBatch like "."'".$Data[3]."'"." ORDER BY a.NotifTimeStamp DESC";
					
				}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="HumanResources"){

					$SQLstring="SELECT a.NotifTimeStamp,b.ProcessName,a.UpdatedBatch,(c.LastName"."+', '+"."c.FirstName"."+' '+"."c.MiddleName) as Name,a.NestingDate,a.Lock FROM TB_Endorsement_Nesting a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.TrainerEmpID=c.EmployeeID"." WHERE b.ProcessName like "."'".$Data[2]."'"." AND a.UpdatedBatch like "."'".$Data[3]."'"." ORDER BY a.NotifTimeStamp DESC";
				}

							$connection= $ClassConnection -> Open_connection(2);

							$execQuery=odbc_exec($connection, $SQLstring);

							
							while(odbc_fetch_row($execQuery)){

								for($a=1;$a <= odbc_num_fields($execQuery);$a++){
								if($a==1){
								$dataValue[$a-1][$index]=date("Y-m-d",odbc_result($execQuery, odbc_field_name($execQuery, $a)));
								}else{
								$dataValue[$a-1][$index]=odbc_result($execQuery, odbc_field_name($execQuery, $a));	
								}
								}

								$index++;
							}

							$ClassConnection -> Close_connection($connection);

				}else if($Data[1]=="Operation"){


				if($_SESSION['AccesType']=="Supervisor"){

					$SQLstring="SELECT a.NotifTimeStamp,c.ProcessName,a.UpdatedBatch,(b.LastName"."+', '+"."b.FirstName"."+' '+"."b.MiddleName) as Name,a.LiveDate,a.Lock FROM TB_Endorsement_Operation a JOIN DB_Employee_Management_System.dbo.TB_Information b ON a.TrainerEmpID=b.EmployeeID JOIN TB_ProcessList c ON a.ProcessID=c.ProcessCode WHERE a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." AND c.ProcessName like "."'".$Data[2]."'"." AND a.UpdatedBatch like "."'".$Data[3]."'"." ORDER BY a.NotifTimeStamp DESC";

				}else if($_SESSION['AccesType']=="Manager" || $_SESSION['AccesType']=="Supervisor2"){

					$FullName=$_SESSION['LastName'].",".$_SESSION['FirstName'];

					if($_SESSION['MiddleName'] !="" && $_SESSION['MiddleName'] !=null){
						$FullName=$FullName." ".$_SESSION['MiddleName'];
					}

					$SQLstring="SELECT a.NotifTimeStamp,b.ProcessName,a.UpdatedBatch,(e.LastName"."+', '+"."e.FirstName"."+' '+"."e.MiddleName) as Name,a.LiveDate,a.Lock FROM TB_Endorsement_Operation a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode  JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.UserEmpID like c.EmployeeID + '%'  JOIN DB_Employee_Management_System.dbo.TB_Hierarchy d ON c.TableID=d.TableID JOIN DB_Employee_Management_System.dbo.TB_Information e ON a.TrainerEmpID=e.EmployeeID WHERE (a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." OR "."'".$FullName."'"." IN (d.Supervisor1,d.Supervisor2,d.Supervisor3,d.Supervisor4,d.Supervisor5))"." AND b.ProcessName like "."'".$Data[2]."'"." AND a.UpdatedBatch like "."'".$Data[3]."'"." ORDER BY a.NotifTimeStamp DESC";
					
				}else if($_SESSION['AccesType']=="Administrator" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="HumanResources"){

					$SQLstring="SELECT a.NotifTimeStamp,b.ProcessName,a.UpdatedBatch,(c.LastName"."+', '+"."c.FirstName"."+' '+"."c.MiddleName) as Name,a.LiveDate,a.Lock FROM TB_Endorsement_Operation a JOIN DB_Employee_Management_System.dbo.TB_ProcessList b ON a.ProcessID=b.ProcessCode JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.TrainerEmpID=c.EmployeeID"." WHERE b.ProcessName like "."'".$Data[2]."'"." AND a.UpdatedBatch like "."'".$Data[3]."'"." ORDER BY a.NotifTimeStamp DESC";
				}

							$connection= $ClassConnection -> Open_connection(2);

							$execQuery=odbc_exec($connection, $SQLstring);

							
							while(odbc_fetch_row($execQuery)){

								for($a=1;$a <= odbc_num_fields($execQuery);$a++){
								if($a==1){
								$dataValue[$a-1][$index]=date("Y-m-d",odbc_result($execQuery, odbc_field_name($execQuery, $a)));
								}else{
								$dataValue[$a-1][$index]=odbc_result($execQuery, odbc_field_name($execQuery, $a));	
								}
								}

								$index++;
							}

							$ClassConnection -> Close_connection($connection);
				}
						
				
				}


				
				}else if($Data[0]=="Leave Filed & Approval"){
					
				}

		} catch (Exception $e) {
			
		}	
}


?>