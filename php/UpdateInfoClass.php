<?php


class UpdateInfo_Engine{


	function EndorsementUpdateInfo($Data,$ProcessID,$TrainerID,$SQLcode){

		

		$ClassConnectionDB=new DB_Connection();

		 $SQLstring="";

		 $returnVal=0;

		$agentEmpIds=explode("/", $Data[0]);
        $RemarksValue="";
        $NewRemarksValue="";
        $Datavalue[]=null;
  

        for($ace=0;$ace < count($agentEmpIds);$ace++){

        	

        	  $connection= $ClassConnectionDB -> Open_connection(1);
			  $SQLstring="SELECT a.HistoryRemarks FROM TB_State a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'". $agentEmpIds[$ace]."'"."";

			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$RemarksValue=$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			

			}

		   $ClassConnectionDB -> Close_connection($connection);

		  
		   if($RemarksValue!="" && $RemarksValue!=null){
		   		  $NewRemarksValue=$RemarksValue."/";
		   }
		   
		   if($SQLcode==1){

		   $NewRemarksValue=$NewRemarksValue."OnTraining-Start:".date('Y-m-d',strtotime($Data[3]))."-TrainerID:".$Data[2]."-".$Data[1]."-Stamp:".date('Y-m-d h:m:s')."-".$Data[5];
		  //$SQLstring="UPDATE IRemarks SET IRemarks.HistoryRemarks=?,IRemarks.Process=?,IRemarks.Batch=?,IRemarks.TenureStatus=?,IRemarks.Billable=? FROM (SELECT a.EmployeeID,b.HistoryRemarks,a.Process,a.Batch,b.TenureStatus,b.Billable FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace]."'"."";

		     $connection= $ClassConnectionDB -> Open_connection(1);

        	   $SQLstring="SELECT * FROM TB_Information a JOIN TB_State b ON a.TableID=b.TableID JOIN TB_Hierarchy c ON a.TableID=c.TableID WHERE a.Process like "."'".$Data[1]."'"." AND a.Batch like "."'".$Data[5]."'"." AND b.TenureStatus=1 AND c.Supervisor1 like "."'".$Data[2]."'"." AND a.EmployeeID like "."'".$agentEmpIds[$ace]."'"."";

        	$AlreadyUpdate=false;

        	$execQuery=odbc_exec($connection, $SQLstring);

        	if(!odbc_error($connection)){

			while(odbc_fetch_row($execQuery)){
				$AlreadyUpdate=true;
			}

			}else{

				return 0;
			}

			$ClassConnectionDB -> Close_connection($connection);

			if($AlreadyUpdate==false){
			
		   $connection= $ClassConnectionDB -> Open_connection(1);


		   $SQLstring="UPDATE IRemarks SET IRemarks.Process=?,IRemarks.Batch=? FROM (SELECT a.EmployeeID,a.Process,a.Batch FROM TB_Information a) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace]."'"."";

		    $Datavalue[0]=$Data[1];
		    $Datavalue[1]=$Data[5];
		 
		    
		 	
			$prepExec=odbc_prepare($connection,$SQLstring);
			
   	
        	$execQuery=odbc_execute($prepExec,$Datavalue);

        	if(!odbc_error($connection)){
           	
            $returnVal=1;

           	}else{

           	return 0;
           
           	}

           
           	
           $ClassConnectionDB -> Close_connection($connection);
           	
       

		    $connection= $ClassConnectionDB -> Open_connection(1);

		    $SQLstring="UPDATE IRemarks SET IRemarks.HistoryRemarks=?,IRemarks.TenureStatus=?,IRemarks.Billable=? FROM (SELECT a.EmployeeID,b.HistoryRemarks,a.Process,a.Batch,b.TenureStatus,b.Billable FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace]."'"."";

		   $Datavalue[0]=$NewRemarksValue;
		   $Datavalue[1]="1";
		   $billableCount=$Data[4];
		   if($billableCount==0){
		   	 $Datavalue[2]="2";
		   }else{
		   	if($ace <=  $billableCount-1){
				$Datavalue[2]="1";
		   }else{
		   		$Datavalue[2]="2";
		   }
		   }


		   	
			$prepExec=odbc_prepare($connection,$SQLstring);
			
   	
        	$execQuery=odbc_execute($prepExec,$Datavalue);

        	if(!odbc_error($connection)){
           	
           	 $returnVal=1;

           	}else{

           	 return 0;
           
           	}

          
           	
           $ClassConnectionDB -> Close_connection($connection);
           	


          $SQLstring="UPDATE IRemarks SET IRemarks.Supervisor1=? FROM (SELECT a.EmployeeID,b.Supervisor1 FROM TB_Information a JOIN  TB_Hierarchy b ON a.TableID=b.TableID) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace]."'"."";

           $Datavalue[]=null;

           $Datavalue[0]=$Data[2];


            $prepExec=odbc_prepare($connection,$SQLstring);

        	$execQuery=odbc_execute($prepExec,$Datavalue);

        	if(!odbc_error($connection)){
        		
        		$returnVal=1;

        	}else{
        		return 0;
        	}

           	$ClassConnectionDB -> Close_connection($connection);

           }else{

           	 $connection= $ClassConnectionDB -> Open_connection(1);

           	  $SQLstring="UPDATE IRemarks SET IRemarks.Billable=? FROM (SELECT a.EmployeeID,b.HistoryRemarks,a.Process,a.Batch,b.TenureStatus,b.Billable FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace]."'"."";

           $forBillableUpdate[]=null;

           $billableCount=$Data[4];
		   if($billableCount==0){
		   	 $forBillableUpdate[0]="2";
		   }else{
		   	if($ace <=  $billableCount-1){
				$forBillableUpdate[0]="1";
		   }else{
		   		$forBillableUpdate[0]="2";
		   }
		   }


			$prepExec=odbc_prepare($connection,$SQLstring);
        	$execQuery=odbc_execute($prepExec,$forBillableUpdate);
        	$ClassConnectionDB -> Close_connection($connection);

           	$returnVal=1;

           }


         

		  }else if($SQLcode==2){

		   	  $NewRemarksValue=$NewRemarksValue."Nesting-Start:".date('Y-m-d',strtotime($Data[3]))."-TrainerID:".$Data[2]."-".$Data[1]."-Stamp:".date('Y-m-d h:m:s')."-".$Data[5];
		  
		

		     $connection= $ClassConnectionDB -> Open_connection(1);

        	   $SQLstring="SELECT * FROM TB_Information a JOIN TB_State b ON a.TableID=b.TableID JOIN TB_Hierarchy c ON a.TableID=c.TableID WHERE a.Process like "."'".$Data[1]."'"." AND a.Batch like "."'".$Data[5]."'"." AND b.TenureStatus=2 AND c.Supervisor1 like "."'".$Data[2]."'"." AND a.EmployeeID like "."'".$agentEmpIds[$ace]."'"."";

        	$AlreadyUpdate=false;

        	$execQuery=odbc_exec($connection, $SQLstring);
        	if(!odbc_error($connection)){
			while(odbc_fetch_row($execQuery)){
				$AlreadyUpdate=true;
			}

			}else{
        		return 0;
        	}
			$ClassConnectionDB -> Close_connection($connection);
		   

		   ////////////////////////////////////////

			if($AlreadyUpdate==false){
		    $connection= $ClassConnectionDB -> Open_connection(1);

		    $SQLstring="UPDATE IRemarks SET IRemarks.HistoryRemarks=?,IRemarks.TenureStatus=?,IRemarks.Billable=? FROM (SELECT a.EmployeeID,b.HistoryRemarks,a.Process,a.Batch,b.TenureStatus,b.Billable FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace]."'"."";

		   $Datavalue[0]=$NewRemarksValue;
		   $Datavalue[1]="2";
		   $billableCount=$Data[4];
		   if($billableCount==0){
		   	 $Datavalue[2]="2";
		   }else{
		   	if($ace <=  $billableCount-1){
				$Datavalue[2]="1";
		   }else{
		   		$Datavalue[2]="2";
		   }
		   }


		  	
			$prepExec=odbc_prepare($connection,$SQLstring);
			
   	
        	$execQuery=odbc_execute($prepExec,$Datavalue);

        	if(!odbc_error($connection)){
           	
           	$returnVal=1;

           	}else{

           	return 0;
           
           	}

           	
           	
           $ClassConnectionDB -> Close_connection($connection);
           	

           }else{

           $connection= $ClassConnectionDB -> Open_connection(1);

           $SQLstring="UPDATE IRemarks SET IRemarks.Billable=? FROM (SELECT a.EmployeeID,b.HistoryRemarks,a.Process,a.Batch,b.TenureStatus,b.Billable FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace]."'"."";

           $forBillableUpdate[]=null;

           $billableCount=$Data[4];
		   if($billableCount==0){
		   	 $forBillableUpdate[0]="2";
		   }else{
		   	if($ace <=  $billableCount-1){
				$forBillableUpdate[0]="1";
		   }else{
		   		$forBillableUpdate[0]="2";
		   }
		   }


			$prepExec=odbc_prepare($connection,$SQLstring);
        	$execQuery=odbc_execute($prepExec,$forBillableUpdate);
        	$ClassConnectionDB -> Close_connection($connection);
        	
           	$returnVal=1;
           
           }

           

		   }else{

		   	  $NewRemarksValue=$NewRemarksValue."Live-Start:".date('Y-m-d',strtotime($Data[3]))."-TrainerID:".$Data[2]."-".$Data[1]."-Stamp:".date('Y-m-d h:m:s')."-".$Data[5];
			
		   	$connection= $ClassConnectionDB -> Open_connection(1);

	       	$SQLstring="SELECT * FROM TB_Information a JOIN TB_State b ON a.TableID=b.TableID JOIN TB_Hierarchy c ON a.TableID=c.TableID WHERE a.Process like "."'".$Data[1]."'"." AND a.Batch like "."'".$Data[5]."'"." AND b.TenureStatus=3 AND c.Supervisor1 like "."'".$Data[2]."'"." AND a.EmployeeID like "."'".$agentEmpIds[$ace]."'"."";

	   
        	$AlreadyUpdate=false;

        	$execQuery=odbc_exec($connection, $SQLstring);
        	if(!odbc_error($connection)){
			while(odbc_fetch_row($execQuery)){
				$AlreadyUpdate=true;
			}
			}else{
        		return 0;
        	}

			$ClassConnectionDB -> Close_connection($connection);
		   
		   if($AlreadyUpdate===false){


			$connection= $ClassConnectionDB -> Open_connection(1);

		    $SQLstring="UPDATE IRemarks SET IRemarks.HistoryRemarks=?,IRemarks.TenureStatus=?,IRemarks.Billable=? FROM (SELECT a.EmployeeID,b.HistoryRemarks,a.Process,a.Batch,b.TenureStatus,b.Billable FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace]."'"."";

		   $Datavalue[0]=$NewRemarksValue;
		   $Datavalue[1]="3";
		   $billableCount=$Data[4];
		   if($billableCount==0){
		   	 $Datavalue[2]="2";
		   }else{
		   	if($ace <= $billableCount-1){
				$Datavalue[2]="1";
		   }else{
		   		$Datavalue[2]="2";
		   }
		   }


			
			$prepExec=odbc_prepare($connection,$SQLstring);
			
   	
        	$execQuery=odbc_execute($prepExec,$Datavalue);

        	if(!odbc_error($connection)){
           	
           	$returnVal=1;

           	}else{

           	return 0;
           
           	}

           	
           	
           $ClassConnectionDB -> Close_connection($connection);
           	

		   

		   }else{
		   
		  	$connection= $ClassConnectionDB -> Open_connection(1);

           	$SQLstring="UPDATE IRemarks SET IRemarks.Billable=? FROM (SELECT a.EmployeeID,b.HistoryRemarks,a.Process,a.Batch,b.TenureStatus,b.Billable FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace]."'"."";

           $forBillableUpdate[]=null;

           $billableCount=$Data[4];
		   if($billableCount==0){
		   	 $forBillableUpdate[0]="2";
		   }else{
		   	if($ace <=  $billableCount-1){
				$forBillableUpdate[0]="1";
		   }else{
		   		$forBillableUpdate[0]="2";
		   }
		   }


			$prepExec=odbc_prepare($connection,$SQLstring);
        	$execQuery=odbc_execute($prepExec,$forBillableUpdate);
        	$ClassConnectionDB -> Close_connection($connection);
        	
           	$returnVal=1;
		   
		   }
		   
		  

           }


       
        }

        if( $returnVal==1){

        if($SQLcode==1){

        	 $SQLstring="UPDATE TB_Endorsement_Training SET Lock=1 WHERE AgentsEmpId like "."'".$Data[0]."'"." AND ProcessID=".$ProcessID." AND TrainerEmpID like "."'".$TrainerID."'"." AND TrainingDate="."'".date('Y-m-d',strtotime($Data[3]))."'"." AND UpdatedBatch like "."'".$Data[5]."'"."";

        }else if($SQLcode==2){

        	 $SQLstring="UPDATE TB_Endorsement_Nesting SET Lock=1 WHERE AgentsEmpId like "."'".$Data[0]."'"." AND ProcessID=".$ProcessID." AND TrainerEmpID like "."'".$TrainerID."'"." AND NestingDate="."'".date('Y-m-d',strtotime($Data[3]))."'"." AND UpdatedBatch like "."'".$Data[5]."'"."";



        }else{

        	 $SQLstring="UPDATE TB_Endorsement_Operation SET Lock=1 WHERE AgentsEmpId like "."'".$Data[0]."'"." AND ProcessID=".$ProcessID." AND TrainerEmpID like "."'".$TrainerID."'"." AND LiveDate="."'".date('Y-m-d',strtotime($Data[3]))."'"." AND UpdatedBatch like "."'".$Data[5]."'"."";
        }

        $connection= $ClassConnectionDB -> Open_connection(2);

        $prepExec=odbc_prepare($connection,$SQLstring);
        $execQuery=odbc_execute($prepExec,$Datavalue);

        $ClassConnectionDB -> Close_connection($connection);

    	}

         

      

		return $returnVal;

	}

function AirUpdateInfo($Data,$statCode){



			$SQLstring="";
			$RemarksValue="";
        	$NewRemarksValue="";
        	$returnVal=0;
        	$Datavalue[]=null;


			$connection= $ClassConnectionDB -> Open_connection(1);
			$SQLstring="SELECT a.HistoryRemarks FROM TB_State a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";

			$execQuery=odbc_exec($connection, $SQLstring);
			if(!odbc_error($connection)){
			while(odbc_fetch_row($execQuery)){

			$RemarksValue=$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			

			}
			}else{

           	return 2;
           
           	}
		   $ClassConnectionDB -> Close_connection($connection);

		  
		   if($RemarksValue!="" && $RemarksValue!=null){
		   		  $NewRemarksValue=$RemarksValue."/";
		   }

		 $NewRemarksValue=$NewRemarksValue.$Data[6]."-".$Data[8];

		 $connection= $ClassConnectionDB -> Open_connection(1);

		 $SQLstring="UPDATE Info SET Info.Billable,Info.CurrentStatus=?,Info.HistoryRemarks=? FROM (SELECT a.EmployeeID,b.Billable,b.CurrentStatus,b.HistoryRemarks FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as Info WHERE Info.EmployeeID like "."'".$Data[0]."'"."";
;
			
			$Datavalue[0]="2";
			$Datavalue[1]=$Data[6];
			$Datavalue[2]=$NewRemarksValue;
			
			$prepExec=odbc_prepare($connection,$SQLstring);
			
   	
        	$execQuery=odbc_execute($prepExec,$Datavalue);

        	if(!odbc_error($connection)){
           	
        	 $ClassConnectionDB -> Close_connection($connection);

        	 $connection= $ClassConnectionDB -> Open_connection(2);

        	 $SQLstring="UPDATE TB_Air_Notification SET Lock=1 WHERE EmployeeID like "."'".$Data[0]."'"." AND RquestIssuance=".$statCode." AND EffectiveDate="."'".date('Y-m-d',strtotime($Data[8]))."'"."";

        	 $execQuery=odbc_exec($connection, $SQLstring);

        	 $returnVal=1;
       
           	}else{

           	return 2;
           
           	}

           	
           	
           	
  

		 return $returnVal;
}

function  btwUpdateInfo($Data){


	

			$SQLstring="";
			$RemarksValue="";
        	$NewRemarksValue="";
        	$PositionVal="";
        	$returnVal=0;
        	$Datavalue[]=null;

        	$connection= $ClassConnectionDB -> Open_connection(1);
        	$SQLstring="SELECT a.HistoryRemarks,c.PositionCategoryVal FROM TB_State a JOIN TB_Information b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code WHERE b.EmployeeID like "."'".$Data[0]."'"."";

        	$execQuery=odbc_exec($connection, $SQLstring);
        	if(!odbc_error($connection)){
			while(odbc_fetch_row($connection)){

			$RemarksValue=$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			

			}
			}else{

           	return 2;
           
           	}

		   $ClassConnectionDB -> Close_connection($connection);

		  
		   if($RemarksValue!="" && $RemarksValue!=null){
		   		  $NewRemarksValue=$RemarksValue."/";
		   }

		   	$connection= $ClassConnectionDB -> Open_connection(1);

		   	$SQLstring="SELECT * FROM TB_DefaultValues";

		   	$execQuery=odbc_exec($connection, $SQLstring);
		   	if(!odbc_error($connection)){
			while(odbc_fetch_row($connection)){

			$PositionforValid=$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			$TenureStatusValid=$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 2));

			}
			}else{

           	return 2;
           
           	}

		   $ClassConnectionDB -> Close_connection($connection);

		    $NewRemarksValue=$NewRemarksValue."Back to work-".$Data[6];

		    $connection= $ClassConnectionDB -> Open_connection(1);

		     $SQLstring="UPDATE Info SET Info.Billable,Info.CurrentStatus=?,Info.HistoryRemarks=? FROM (SELECT a.EmployeeID,b.Billable,b.CurrentStatus,b.HistoryRemarks FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as Info WHERE Info.EmployeeID like "."'".$Data[0]."'"."";
;
			
			if($PositionVal=$PositionforValid){
				if($TenureStatusValid==1){
					$Datavalue[0]="2";
				}else{
					$Datavalue[0]="1";
				}
			}else{
					$Datavalue[0]="2";
			}
			
			$Datavalue[1]="Active";
			$Datavalue[2]=$NewRemarksValue;
			
			$prepExec=odbc_prepare($connection,$SQLstring);
			
        	$execQuery=odbc_execute($prepExec,$Datavalue);

        	if(!odbc_error($connection)){
           	
        	 $ClassConnectionDB -> Close_connection($connection);

        	 $connection= $ClassConnectionDB -> Open_connection(2);

        	 $SQLstring="UPDATE TB_BackToWork_Notification SET Lock=1 WHERE EmployeeID like "."'".$Data[0]."'"." AND ReturnDate="."'".date('Y-m-d',strtotime($Data[6]))."'"."";

        	 $execQuery=odbc_exec($connection, $SQLstring);
        	 
        	 $returnVal=1;

           	}else{

           	return 2;
           
           	}

           	

	

	return $returnVal;
}


function autoseperationUpdateInfo($Data,$statcode){



			$SQLstring="";
			$RemarksValue="";
        	$NewRemarksValue="";
        	$returnVal=0;
        	$Datavalue[]=null;

        	$connection= $ClassConnectionDB -> Open_connection(1);
        	$SQLstring="SELECT a.HistoryRemarks FROM TB_State a JOIN TB_Information b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code WHERE b.EmployeeID like "."'".$Data[0]."'"."";

        	$execQuery=odbc_exec($connection, $SQLstring);
        	if(!odbc_error($connection)){
			while(odbc_fetch_row($execQuery)){

			$RemarksValue=$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			

			}
			}else{

           	return 2;
           
           	}

		   $ClassConnectionDB -> Close_connection($connection);

		  
		   if($RemarksValue!="" && $RemarksValue!=null){
		   		  $NewRemarksValue=$RemarksValue."/";
		   }

		      $NewRemarksValue=$NewRemarksValue."Terminated-".$Data[6];

		    $connection= $ClassConnectionDB -> Open_connection(1);

		     $SQLstring="UPDATE Info SET Info.Billable,Info.CurrentStatus=?,Info.HistoryRemarks=? FROM (SELECT a.EmployeeID,b.Billable,b.CurrentStatus,b.HistoryRemarks FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as Info WHERE Info.EmployeeID like "."'".$Data[0]."'"."";
;
			
		
			$Datavalue[0]="2";
			$Datavalue[1]=$Data[6];
			$Datavalue[2]=$NewRemarksValue;
			
			$prepExec=odbc_prepare($connection,$SQLstring);
		
   	
        	$execQuery=odbc_execute($prepExec,$Datavalue);

        	if(!odbc_error($connection)){
           	
        	 $ClassConnectionDB -> Close_connection($connection);

        	 $connection= $ClassConnectionDB -> Open_connection(2);

        	 $SQLstring="UPDATE TB_autoSeparate_Notification SET Lock=1,LastUpdate="."'".date('Y-m-d h:m:s')."'"." WHERE EmployeeID like "."'".$Data[0]."'"." AND EffectiveDate="."'".date('Y-m-d',strtotime($Data[5]))."'"." AND StatusCode=".$statcode."";

        	 $execQuery=odbc_exec($connection, $SQLstring);
        	

        	 	 $ClassConnectionDB -> Close_connection($connection);
        	 	 
        	 	  $connection= $ClassConnectionDB -> Open_connection(1);

        	 	  $SQLstring="DELETE a FROM TB_State a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 		 $execQuery=odbc_exec($connection, $SQLstring);
        	 		  $ClassConnectionDB -> Close_connection($connection);

        	 		  $connection= $ClassConnectionDB -> Open_connection(1);
        	 		  $SQLstring="DELETE a FROM TB_Hierarchy a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 		 $execQuery=odbc_exec($connection, $SQLstring);
        	 		 $ClassConnectionDB -> Close_connection($connection);

        	 		  $connection= $ClassConnectionDB -> Open_connection(1);
        	 		  $SQLstring="DELETE a FROM TB_Credentials a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 		 $execQuery=odbc_exec($connection, $SQLstring);
        	 		 $ClassConnectionDB -> Close_connection($connection);

        	 		  $connection= $ClassConnectionDB -> Open_connection(1);
        	 		  $SQLstring="DELETE a FROM TB_ProfilePhoto a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 		 $execQuery=odbc_exec($connection, $SQLstring);
        	 		 $ClassConnectionDB -> Close_connection($connection);

        	 		 $connection= $ClassConnectionDB -> Open_connection(1);
        	 		  $SQLstring="DELETE FROM TB_Information WHERE EmployeeID like "."'".$Data[0]."'"."";
        	 		 $execQuery=odbc_exec($connection, $SQLstring);
        	 		 $ClassConnectionDB -> Close_connection($connection);


        	 	  	$returnVal=1;
        	

         	

           	}else{

           	return 2;
           
           	}

           	
       
	

	return $returnVal;
}



function ResignationUpdateInfo($Data){

	

			$SQLstring="";
			$RemarksValue="";
        	$NewRemarksValue="";
        	$returnVal=0;
        	$Datavalue[]=null;

        	$connection= $ClassConnectionDB -> Open_connection(1);
        	$SQLstring="SELECT a.HistoryRemarks FROM TB_State a JOIN TB_Information b ON a.TableID=b.TableID JOIN TB_PositionCategory c ON a.Position=c.Code WHERE b.EmployeeID like "."'".$Data[0]."'"."";

        	$execQuery=odbc_exec($connection, $SQLstring);
        	if(!odbc_error($connection)){
			while(odbc_fetch_row($execQuery)){

			$RemarksValue=$fieldValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			

			}

			}else{

           	return 2;
           
           	}

		   $ClassConnectionDB -> Close_connection($connection);

		  
		   if($RemarksValue!="" && $RemarksValue!=null){
		   		  $NewRemarksValue=$RemarksValue."/";
		   }

		      $NewRemarksValue=$NewRemarksValue."Resignation-".$Data[6];

		    $connection= $ClassConnectionDB -> Open_connection(1);

		     $SQLstring="UPDATE Info SET Info.Billable,Info.CurrentStatus=?,Info.HistoryRemarks=? FROM (SELECT a.EmployeeID,b.Billable,b.CurrentStatus,b.HistoryRemarks FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as Info WHERE Info.EmployeeID like "."'".$Data[0]."'"."";
;
			
		
			$Datavalue[0]="2";
			$Datavalue[1]="Resigned";
			$Datavalue[2]=$NewRemarksValue;
			
			$prepExec=odbc_prepare($connection,$SQLstring);
			
   	
        	$execQuery=odbc_execute($prepExec,$Datavalue);

        	if(!odbc_error($connection)){
           	
        	 $ClassConnectionDB -> Close_connection($connection);

        	 $connection= $ClassConnectionDB -> Open_connection(2);

        	 $SQLstring="UPDATE TB_Resignation_Notification SET Lock=1,LastUpdate="."'".date('Y-m-d h:m:s')."'"." WHERE EmployeeID like "."'".$Data[0]."'"." AND EffectiveDate="."'".date('Y-m-d',strtotime($Data[6]))."'"." AND Date_Received=".$statcode."'".date('Y-m-d',strtotime($Data[4]))."'"."";

        	 $execQuery=odbc_exec($connection, $SQLstring);
        	

        	 	 $ClassConnectionDB -> Close_connection($connection);
        	 	 
        	 	  $connection= $ClassConnectionDB -> Open_connection(1);

        	 	  $SQLstring="DELETE a FROM TB_State a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 		 $execQuery=odbc_exec($connection, $SQLstring);
        	 		  $ClassConnectionDB -> Close_connection($connection);

        	 		  $connection= $ClassConnectionDB -> Open_connection(1);
        	 		  $SQLstring="DELETE a FROM TB_Hierarchy a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 		 $execQuery=odbc_exec($connection, $SQLstring);
        	 		 $ClassConnectionDB -> Close_connection($connection);

        	 		  $connection= $ClassConnectionDB -> Open_connection(1);
        	 		  $SQLstring="DELETE a FROM TB_Credentials a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 		 $execQuery=odbc_exec($connection, $SQLstring);
        	 		 $ClassConnectionDB -> Close_connection($connection);

        	 		  $connection= $ClassConnectionDB -> Open_connection(1);
        	 		  $SQLstring="DELETE a FROM TB_ProfilePhoto a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 		 $execQuery=odbc_exec($connection, $SQLstring);
        	 		 $ClassConnectionDB -> Close_connection($connection);

        	 		 $connection= $ClassConnectionDB -> Open_connection(1);
        	 		  $SQLstring="DELETE FROM TB_Information WHERE EmployeeID like "."'".$Data[0]."'"."";
        	 		 $execQuery=odbc_exec($connection, $SQLstring);
        	 		 $ClassConnectionDB -> Close_connection($connection);


        	 	  	$returnVal=1;
        

           	}else{

           	return 2;
           
           	}

          


	

	return $returnVal;
}




}


?>