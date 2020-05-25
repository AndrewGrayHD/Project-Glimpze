<?php

include "database_engine.php";
include "C:\\xampp\\php\\pear\\PEAR\\config.php";
 session_start();
 //empInfoAllFunction all function


 $functionNumber=$_POST['functionNumber'];

 switch ($functionNumber) {

	case 1:
 		 getBandwidthList($_POST['selctedString'],$_POST['Wherecolumn']);
 	break;
	
 	case 2:
	getProfilePhoto($_POST['EmpId']);
	
 	break;
 	case 3:
 		ProcessModificationRequest($_POST['implodeDataArray']);
 	break;
 	case 4:
 		ProcessUpdatePrimaryInfo($_POST['DataArray1']);
		
 	break;
 	case 5:

 		ProcessUpdateCredentialsInfo($_POST['DataArray2'],$_POST['EmpIDIndi']);
		
 	break;
 	case 6:

 		ProcessUpdateHierarchyInfo($_POST['DataArray3'],$_POST['EmpIDIndi2']);
 	break;

 	case 7:

 		ProcessOptionList();
 	break;

 	case 8:

 		notifAutofill($_POST['EmpIDforNotif']);
 	break;
 	case 9:

 		checkstatusRules($_POST['EmpIDStatInfo'],$_POST['checlstatusCat']);
 	break;
 	case 10:

 		getPhotoExtension($_POST['EmpId2']);
 	break;
 }


function getBandwidthList($StringNumber,$WhereColumn1Val){


$ClassConnection=new DB_Connection();


$connection= $ClassConnection -> Open_connection(1);

$accessType=$_SESSION['AccesType'];

$accessTypeValue=0;


    switch ($accessType) {

                case 'Suser':
                $accessTypeValue=1;
                break;
                case 'Supervisor':
                $accessTypeValue=2;
                break;
                case 'Supervisor2':
                $accessTypeValue=3;
                break;
                case 'Manager':
                $accessTypeValue=4;
                break;
                case 'Administrator':
                $accessTypeValue=5;
                break;
                case 'HumanResources':
                $accessTypeValue=6;
                break;
                case 'SuperAdmin':
                $accessTypeValue=7;
                break;
   
    
        }



				if ($connection){


				$dataValue[]=null;


				$SQLstring="";

    
                switch($StringNumber){

                    case 1:
                      
                   $SQLstring="SELECT BandwidthCategoryVal FROM TB_BandwidthCategory";
                    break;

                    case 2:
                    
                     
                   $SQLstring="SELECT distinct b.PositionCategoryVal FROM TB_Information a JOIN TB_PositionCategory b ON a.Position=b.Code where a.Process like '%".$WhereColumn1Val."%' ORDER BY b.PositionCategoryVal ASC";
                  
                    break;

                    case 3:
                 
                     
                  $SQLstring="SELECT distinct c.AssignmentName FROM TB_Information a JOIN TB_ProcessList b ON a.Process like '%' + b.ProcessName + '%' JOIN TB_AssignmentList c ON b.ProcessCode=c.AssignmentProcessCode WHERE a.Process like '". $WhereColumn1Val ."' ORDER BY c.AssignmentName";
                    
                    break;
                    
                    case 4:
                    
                    $SQLstring="SELECT distinct BaseCity FROM TB_LocationDetails";

                    break;
                    case 5:
                     
                   $SQLstring="SELECT Location FROM TB_LocationDetails";
                    break;
                    case 6:
                     
                    $SQLstring="SELECT Floor FROM TB_Floor ORDER BY Code ASC";
                    break;
                    case 7:
                    $SQLstring="SELECT Channel FROM TB_Channel";
                    break;
                    case 8:

                    $SQLstring="SELECT Distinct b.Supervisor1 FROM TB_Information a JOIN  TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_Access c ON a.EmployeeID=c.EmployeeID WHERE a.Process like "."'%". $WhereColumn1Val ."%'"." AND (c.AccessCode >= 1 AND c.AccessCode <= ".$accessTypeValue.") ORDER BY b.Supervisor1 ASC";
                     
                    break;
                    case 9:
                   
                     
                    $SQLstring="SELECT Distinct b.Supervisor2 FROM TB_Information a JOIN  TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_Access c ON a.EmployeeID=c.EmployeeID WHERE a.Process like "."'%". $WhereColumn1Val ."%'"." AND (c.AccessCode >= 1 AND c.AccessCode <= ".$accessTypeValue.") ORDER BY b.Supervisor2 ASC";
                     
                    break;
                    case 10:
                    
                    
                    $SQLstring="SELECT Distinct b.Supervisor3 FROM TB_Information a JOIN  TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_Access c ON a.EmployeeID=c.EmployeeID WHERE a.Process like "."'%". $WhereColumn1Val ."%'"." AND (c.AccessCode >= 1 AND c.AccessCode <= ".$accessTypeValue.") ORDER BY b.Supervisor3 ASC";
                     
                    break;
                    case 11:
                    
                     
                    $SQLstring="SELECT Distinct b.Supervisor4 FROM TB_Information a JOIN  TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_Access c ON a.EmployeeID=c.EmployeeID WHERE a.Process like "."'%".$WhereColumn1Val ."%'"." AND (c.AccessCode >= 1 AND c.AccessCode <= ".$accessTypeValue.") ORDER BY b.Supervisor4 ASC";
                     
                    break;
                    case 12:
                    
                    
                    $SQLstring="SELECT Distinct b.Supervisor5 FROM TB_Information a JOIN  TB_Hierarchy b ON a.TableID=b.TableID JOIN TB_Access c ON a.EmployeeID=c.EmployeeID WHERE a.Process like "."'%". $WhereColumn1Val ."%'"." AND (c.AccessCode >= 1 AND c.AccessCode <= ".$accessTypeValue.") ORDER BY b.Supervisor5 ASC";
                     
                    break;
                    case 13:
                    $dataValue=array("Active","Inactive");
                    break;
                    case 14:
                    $dataValue=array("Yes","No");
                    break;
                    case 15:
                    $dataValue=array("T1","T2","T3","T4","T5","T6");
                    break;
                    case 16:
                     $dataValue=array("Core","Clemency","Training");
                    break;

					                   
                }

            if($StringNumber >=1 && $StringNumber <= 12){
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


function getPhotoExtension($empIDVal){

$ClassConnection=new DB_Connection();
$connection= $ClassConnection -> Open_connection(1);

if($connection){ 

$SQLstring="SELECT b.Photoextension FROM TB_Information a JOIN  TB_ProfilePhoto b ON a.TableID=b.TableID WHERE a.EmployeeID like '".$empIDVal."'";

	$execQuery=odbc_exec($connection, $SQLstring);

	while(odbc_fetch_row($execQuery)){

		
		$PhotoExtension = odbc_result($execQuery, odbc_field_name($execQuery, 1));
			//$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			//$image_Source=$fieldValue;

	}
	$ClassConnection -> Close_connection($connection);	
	echo json_encode($PhotoExtension);

}

}

function getProfilePhoto($empIDVal){

$ClassConnection=new DB_Connection();
$connection= $ClassConnection -> Open_connection(1);

if($connection){ 
$image_Source=null;
$SQLstring="SELECT b.PhotoValue FROM TB_Information a JOIN  TB_ProfilePhoto b ON a.TableID=b.TableID WHERE a.EmployeeID like '".$empIDVal."'";

	$execQuery=odbc_exec($connection, $SQLstring);

	while(odbc_fetch_row($execQuery)){

		odbc_binmode($execQuery, ODBC_BINMODE_RETURN);
		$image_Source = odbc_result($execQuery, 1);
			//$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			//$image_Source=$fieldValue;

	}
	$ClassConnection -> Close_connection($connection);	
	echo base64_encode($image_Source);

}

}


function ProcessModificationRequest($DataImplode){


$ClassConnection=new DB_Connection();


$connection= $ClassConnection -> Open_connection(1);



$ProcessImplode="";

$ProcessToken=explode("/",$DataImplode[1]);
$SQLstring="";

$dataValue[][]=null;

if($connection){

	

	$SQLstring="SELECT ProcessCode,ProcessName  FROM TB_ProcessList";

	$execQuery=odbc_exec($connection, $SQLstring);
	$index=0;
	while(odbc_fetch_row($execQuery)){

	$dataValue[0][$index]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
	$dataValue[1][$index]=odbc_result($execQuery, odbc_field_name($execQuery, 2));		
	$index++;
	}



$ClassConnection -> Close_connection($connection);	

}



for($a=0;$a < count($ProcessToken);$a++ ){

$iterate=true;
$indexIter=0;

while($iterate){

	
	if($dataValue[1][$indexIter]==$ProcessToken[$a]){

	if($a==0){

		$ProcessImplode=(string)($dataValue[0][$indexIter]);

	}else{

		$ProcessImplode=(string)($ProcessImplode."/".(string)($dataValue[0][$indexIter]));

	}

	$iterate=false;

	

	}else{

		
	$indexIter++;
				

	}



	}


}




$ClassConnection2=new DB_Connection();
$connection2= $ClassConnection2 -> Open_connection(2);



if($connection2){

$SQLstring="INSERT INTO TB_Process_Modification_Request (EmployeeID,NewProcess,EffectiveDate,RequestorEmpid,ShrtRemarks) VALUES(?,?,?,?,?)";

$prepExec=odbc_prepare($connection2,$SQLstring);


$execQuery2=odbc_execute($prepExec,array($DataImplode[0],$ProcessImplode,date("Y-m-d",strtotime($DataImplode[2])),$DataImplode[3],$DataImplode[4]));

$rowAffected=odbc_num_rows($prepExec);


if($rowAffected > 0){

echo json_encode(1);

}else{

echo json_encode(0);

}

$ClassConnection2 -> Close_connection($connection2);	

}


}


function ProcessUpdatePrimaryInfo($DataArray){


$ClassConnection=new DB_Connection();

$connection= $ClassConnection -> Open_connection(1);
	

	$SQLstring="";

	if($connection){

		$SQLstring="SELECT Code FROM  TB_BandwidthCategory WHERE BandwidthCategoryVal like '".$DataArray[4]."'";

		$execQuery=odbc_exec($connection,$SQLstring);

		while(odbc_fetch_row($execQuery)){

		$DataArray[4]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
		

		}





		$SQLstring="SELECT Code FROM  TB_PositionCategory WHERE PositionCategoryVal like '".$DataArray[5]."'";

		$execQuery=odbc_exec($connection,$SQLstring);

		while(odbc_fetch_row($execQuery)){

		$DataArray[5]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
		

		}



		$SQLstring="SELECT AssignmentCode FROM  TB_AssignmentList WHERE AssignmentName like '".$DataArray[6]."'";

		$execQuery=odbc_exec($connection,$SQLstring);

		while(odbc_fetch_row($execQuery)){

		$DataArray[6]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
		

		}


	$ClassConnection -> Close_connection($connection);	

	}

	
	$ClassConnection2=new DB_Connection();
	$connection2= $ClassConnection2 -> Open_connection(1);
	

	if($connection2){      

		$SQLstring="UPDATE TB_Information SET EmployeeID=?,FirstName=?,MiddleName=?,LastName=?,Bandwidth=?,Position=?,Assignment_Role=?,HiredDate=?,Location=?,Batch=?,Channel=? WHERE EmployeeID like "."'".$DataArray[0]."'"."";

		$DataArray[7]=(string)(date("Y-m-d",strtotime($DataArray[7])));
		
		$prepExec2=odbc_prepare($connection2,$SQLstring);

		$execQuery2=odbc_execute($prepExec2,$DataArray);

		$rowAffected=odbc_num_rows($prepExec2);


		
	$ClassConnection2 -> Close_connection($connection2);	
		

	$getIndiInfo=SummaryDetails($DataArray[0]);
	echo json_encode($getIndiInfo);
	$_SESSION['IndividualInfo']=$getIndiInfo;


	}

}



function ProcessUpdateCredentialsInfo($DataArray,$IndiEmpId){

$ClassConnection=new DB_Connection();

$connection= $ClassConnection -> Open_connection(1);
	
	$SQLstring="";

	if($connection){

		$SQLstring="UPDATE credentialsInfo set credentialsInfo.NetworkID=?,credentialsInfo.UserID=?,credentialsInfo.AVAYAID=?,credentialsInfo.IEX_Medallia=?,credentialsInfo.BadgeID=?,credentialsInfo.CompanyEmail=?,credentialsInfo.OtherEmail=? FROM (SELECT b.NetworkID,b.UserID,b.AVAYAID,b.IEX_Medallia,b.BadgeID,b.CompanyEmail,b.OtherEmail FROM TB_Information a JOIN TB_Credentials b ON a.TableID=b.TableID WHERE a.EmployeeID like '".$IndiEmpId."') as credentialsInfo";

		$prepExec=odbc_prepare($connection,$SQLstring);

		$execQuery=odbc_execute($prepExec,$DataArray);

		$rowAffected=odbc_num_rows($prepExec);
		

		$ClassConnection -> Close_connection($connection);	

	$getIndiInfo=SummaryDetails($IndiEmpId);
	echo json_encode($getIndiInfo);
	$_SESSION['IndividualInfo']=$getIndiInfo;

	}

}

function ProcessUpdateHierarchyInfo($DataArray,$IndiEmpId){

$ClassConnection=new DB_Connection();

$connection= $ClassConnection -> Open_connection(1);
	
	$SQLstring="";

	if($connection){

		$SQLstring="UPDATE HierarchyInfo set HierarchyInfo.Supervisor1=?,HierarchyInfo.Supervisor2=?,HierarchyInfo.Supervisor3=?,HierarchyInfo.Supervisor4=?,HierarchyInfo.Supervisor5=? FROM (SELECT b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5 FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID WHERE a.EmployeeID like '".$IndiEmpId."') as HierarchyInfo";


		$prepExec=odbc_prepare($connection,$SQLstring);

		$execQuery=odbc_execute($prepExec,$DataArray);

		$rowAffected=odbc_num_rows($prepExec);
		

		$ClassConnection -> Close_connection($connection);

	$getIndiInfo=SummaryDetails($IndiEmpId);
	echo json_encode($getIndiInfo);
	$_SESSION['IndividualInfo']=$getIndiInfo;
	}
}

function ProcessOptionList(){


                     
	$ClassConnection=new DB_Connection();
    $connection= $ClassConnection -> Open_connection(1);

    $dataValue[]=null;
    $index=0;
                    
    $SQLstring="SELECT ProcessName FROM TB_ProcessList ORDER BY ProcessName ASC";

     $execQuery=odbc_exec($connection, $SQLstring);

     While(odbc_fetch_row($execQuery)){

     $fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
     $dataValue[$index]=$fieldValue;
     $index++;
     }
     $ClassConnection -> Close_connection($connection); 
     echo json_encode($dataValue);


}


function SummaryDetails($employeeIDVal){


$ClassConnection=new DB_Connection();

$connection3= $ClassConnection -> Open_connection(1);

	$SQLstring="";

	if($connection3){

	$dataValue[]=null;
	
	
	$SQLstring="SELECT a.EmployeeID,a.FirstName,a.MiddleName,a.LastName,l.AccountName,a.Process,c.BandwidthCategoryVal,d.PositionCategoryVal,k.AssignmentName,a.HiredDate,a.Location,a.Batch,a.Channel,b.NetworkID,b.UserID,b.AVAYAID,b.IEX_Medallia,b.BadgeID,b.CompanyEmail,b.OtherEmail,e.Supervisor1,e.Supervisor2,e.Supervisor3,e.Supervisor4,e.Supervisor5,(CASE WHEN f.CurrentStatus="."'"."Active"."'"." THEN 1 ELSE 0 END),f.Billable,h.TenurityCategoryVal,i.TenureStatusCategoryVal,f.HistoryRemarks,j.Stat_Remarks FROM TB_Information a JOIN TB_Credentials b ON a.TableID=b.TableID JOIN TB_BandwidthCategory c ON a.Bandwidth=c.Code JOIN TB_PositionCategory d ON a.Position=d.Code JOIN TB_Hierarchy e ON a.TableID=e.TableID JOIN TB_State f ON a.TableID=f.TableID JOIN TB_BillableCategory g ON f.Billable=g.Code JOIN TB_TenurityCategory h ON f.Tenurity=h.Code JOIN TB_TenureStatusCategory i ON f.TenureStatus=i.Code JOIN TB_Status j ON f.CurrentStatus=j.Stat_Remarks JOIN TB_AssignmentList k ON a.Assignment_Role=k.AssignmentCode JOIN TB_AccountList l ON a.Account_Name=l.AccountCode WHERE a.EmployeeID like "."'".$employeeIDVal."'"."";


			$execQuery3=odbc_exec($connection3, $SQLstring);

			while(odbc_fetch_row($execQuery3)){

			for($a=1;$a <= odbc_num_fields($execQuery3);$a++){

			$fieldValue=odbc_result($execQuery3, odbc_field_name($execQuery3, $a));
			
			$dataValue[$a-1]=$fieldValue;
			
				
				}
	
			}

			$ClassConnection -> Close_connection($connection3);
			return $dataValue;

	}

}



function notifAutofill($EmployeeID){

$ClassConnection=new DB_Connection();

$connection= $ClassConnection -> Open_connection(1);

$SQLstring="";

	if($connection){

		$dataValue[]=null;

		$SQLstring="SELECT (a.LastName"."+', '+"."a.FirstName"."+' '+"."a.MiddleName) as Name,a.Process,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5,a.HiredDate FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID WHERE a.EmployeeID like "."'".$EmployeeID."'"."";

	$execQuery=odbc_exec($connection, $SQLstring);

     While(odbc_fetch_row($execQuery)){


     $dataValue[0]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
     $dataValue[1]=odbc_result($execQuery, odbc_field_name($execQuery, 2));
     $dataValue[2]=odbc_result($execQuery, odbc_field_name($execQuery, 3));
     $dataValue[3]=odbc_result($execQuery, odbc_field_name($execQuery, 4));
     $dataValue[4]=odbc_result($execQuery, odbc_field_name($execQuery, 5));
     $dataValue[5]=odbc_result($execQuery, odbc_field_name($execQuery, 6));
     $dataValue[6]=odbc_result($execQuery, odbc_field_name($execQuery, 7));
     $dataValue[7]=odbc_result($execQuery, odbc_field_name($execQuery, 8));
     }
     $ClassConnection -> Close_connection($connection); 
     echo json_encode($dataValue);


	}

}

function checkstatusRules($EmpID,$stat){

$ClassConnection=new DB_Connection();

$connection= $ClassConnection -> Open_connection(1);

$SQLstring="";
$dataValue="";
$dataValue2="";

	if($connection){

		$SQLstring="SELECT Stat_Category,Stat_Num FROM TB_Status WHERE Stat_Remarks like "."'".$stat."'"."";

		
		$execQuery=odbc_exec($connection, $SQLstring);

     while(odbc_fetch_row($execQuery)){


     $dataValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
     $dataValue2=odbc_result($execQuery, odbc_field_name($execQuery, 2));
     }
     $ClassConnection -> Close_connection($connection); 
     
	}

	$connection= $ClassConnection -> Open_connection(2);

	$returnData[]=null;
	$returnData[0]=$dataValue;

	if($dataValue=="Leave of absences" || $dataValue=="Request for RTWO"){

		if($connection){
		$SQLstring="SELECT LWD,EffectiveDate,ExpectedBacktoWork FROM TB_Air_Notification WHERE EmployeeID like "."'".$EmpID."'"." AND RquestIssuance=".$dataValue2." ORDER BY LastUpdate ASC";

		$execQuery=odbc_exec($connection, $SQLstring);
		 while(odbc_fetch_row($execQuery)){
		
		$returnData[1]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
		$returnData[2]=odbc_result($execQuery, odbc_field_name($execQuery, 2));
		$returnData[3]=odbc_result($execQuery, odbc_field_name($execQuery, 3));
	}
	echo json_encode($returnData);
	$ClassConnection -> Close_connection($connection); 
	}

	}else if($dataValue=="Separated"){

	if($connection){
		
	if($stat=="Resigned"){
		$SQLstring="SELECT LWD,EffectiveDate,LastUpdate FROM TB_Resignation_Notification WHERE EmployeeID like "."'".$EmpID."'"." ORDER BY LastUpdate ASC";
	}else{
		$SQLstring="SELECT LWD,EffectiveDate,LastUpdate FROM TB_autoSeparate_Notification WHERE EmployeeID like "."'".$EmpID."'"." AND StatusCode=".$dataValue2." ORDER BY LastUpdate ASC";
	}
		$execQuery=odbc_exec($connection, $SQLstring);
		 while(odbc_fetch_row($execQuery)){
		
		$returnData[1]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
		$returnData[2]=odbc_result($execQuery, odbc_field_name($execQuery, 2));
		$returnData[3]=odbc_result($execQuery, odbc_field_name($execQuery, 3));
	}
	
	echo json_encode($returnData);
	$ClassConnection -> Close_connection($connection); 

	}

	}else{


	}


}

?>