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

       
        $execQuery=odbc_exec($connection,$Datavalue);

        $ClassConnectionDB -> Close_connection($connection);

    	}
         

      

		return $returnVal;

	}

function AirUpdateInfo($Data,$statCode,$whatTodo){


			$ClassConnectionDB=new DB_Connection();

			$SQLstring="";
			$RemarksValue="";
        	$NewRemarksValue="";
        	$returnVal=0;
        	$Datavalue[]=null;

        	$LastUpdate="";
        	$LastEffectivedDate="";

        	$getTrackingColumn[]=null;

        	 $connection= $ClassConnectionDB -> Open_connection(3);

        	  $SQLstring="SELECT TOP 1 a.LastTableID,b.Table_Name,c.Stat_Category FROM TB_NotificationTracking a JOIN TB_TableLinkNotification b ON a.StatusID=b.Stat_Num JOIN DB_Employee_Management_System.dbo.TB_Status c ON a.StatusID=c.Stat_Num WHERE a.EmployeeID like "."'".$Data[0]."'"." ORDER BY DateTimeStamp DESC";

        	 $execQuery=odbc_exec($connection, $SQLstring);

        	

        	 while(odbc_fetch_row($execQuery)){

				$getTrackingColumn[0]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
				$getTrackingColumn[1]=odbc_result($execQuery, odbc_field_name($execQuery, 2));
				$getTrackingColumn[2]=odbc_result($execQuery, odbc_field_name($execQuery, 3));
			}

			 $ClassConnectionDB -> Close_connection($connection);

			$connection= $ClassConnectionDB -> Open_connection(1);
			$SQLstring="SELECT a.HistoryRemarks,c.EffectiveDate,c.LastUpdate FROM TB_State a JOIN TB_Information b ON a.TableID=b.TableID LEFT JOIN DB_Employee_Management_System_Notification.dbo.".$getTrackingColumn[1]." c ON b.EmployeeID=c.EmployeeID WHERE b.EmployeeID like "."'".$Data[0]."'"." AND c.TableID=".$getTrackingColumn[0]."";

			$execQuery=odbc_exec($connection, $SQLstring);
			if(!odbc_error($connection)){
			while(odbc_fetch_row($execQuery)){

			$RemarksValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			$LastEffectivedDate=odbc_result($execQuery, odbc_field_name($execQuery, 2));
			$LastUpdate=odbc_result($execQuery, odbc_field_name($execQuery, 3));

			}
			}else{

           	return 2;
           
           	}

		   $ClassConnectionDB -> Close_connection($connection);

		  
		   if($RemarksValue!="" && $RemarksValue!=null){
		   		  $NewRemarksValue=$RemarksValue."/";
		   }



		 $NewRemarksValue=$NewRemarksValue.$Data[6].":".date('Y-m-d',strtotime($Data[8])).":LastUpdate-".date('Y-m-d h:m:s');

		 if($whatTodo=="Insert"){

		 $connection= $ClassConnectionDB -> Open_connection(1);

		 $SQLstring="UPDATE Info SET Info.Billable=?,Info.CurrentStatus=?,Info.HistoryRemarks=? FROM (SELECT a.EmployeeID,b.Billable,b.CurrentStatus,b.HistoryRemarks FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as Info WHERE Info.EmployeeID like "."'".$Data[0]."'"."";
;
			
			$Datavalue[0]="2";
			$Datavalue[1]=$Data[6];
			$Datavalue[2]=$NewRemarksValue;
			
			$prepExec=odbc_prepare($connection,$SQLstring);
			   	
        	$execQuery=odbc_execute($prepExec,$Datavalue);

        	if(!odbc_error($connection)){
           	
        	 $ClassConnectionDB -> Close_connection($connection);

        	

			 $connection= $ClassConnectionDB -> Open_connection(2);

        	 $SQLstring="UPDATE ".$getTrackingColumn[1]." SET Lock=1 WHERE TableID=".$getTrackingColumn[0]." WHERE EmployeeID like "."'".$Data[0]."'"."";


        	 $execQuery=odbc_exec($connection, $SQLstring);

        	  if(!odbc_error($connection)){
        	 
        	 $connection= $ClassConnectionDB -> Open_connection(2);

        	 $SQLstring="SELECT TOP 1 EmployeeID,StatusCode,TableID FROM TB_Air_Notification WHERE EmployeeID like "."'".$Data[0]."'"." ORDER BY DateRequest DESC"


        	 $execQuery=odbc_exec($connection, $SQLstring);

        	 $getTrackingToInsert[0]=date('Y-m-d h:m:s');

        	 while(odbc_fetch_row($execQuery)){

				$getTrackingToInsert[1]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
				$getTrackingToInsert[2]=odbc_result($execQuery, odbc_field_name($execQuery, 2));
				$getTrackingToInsert[3]=odbc_result($execQuery, odbc_field_name($execQuery, 3));
			}

        	 $ClassConnectionDB -> Close_connection($connection);

        	$connection= $ClassConnectionDB -> Open_connection(3);

        	$SQLstring="INSERT INTO TB_NotificationTracking (DateTimeStamp,EmployeeID,StatusID,LastTableID) VALUES (?,?,?,?)";

        	$prepExec=odbc_prepare($connection,$SQLstring);
			   	
        	$execQuery=odbc_execute($prepExec,$getTrackingToInsert); 

        	if(!odbc_error($connection)){

        		 $returnVal=1;
        		 $ClassConnectionDB -> Close_connection($connection);

        	}else{

        	 return 2;
        	 
        	}

        	}else{

        	return 2;
        	 
        	}

 
           	}else{

           	return 2;
           
           	}

		 }else{

		 
		 $explodeRemarksVal=explode("/",$RemarksValue); 

		  $remarksPos=0;

		 for($a=0;$a < count ($explodeRemarksVal);$a++){

		 	$LastUpdate="";
        	$LastEffectivedDate="";

		 	if($explodeRemarksVal[$a]===$Data[6].":".date('Y-m-d',strtotime($LastEffectivedDate)).":LastUpdate-".date('Y-m-d h:m:s',strtotime($LastUpdate))){

		 		 $remarksPos=$a;

		 	}
		 }
		 	
		 if(date('Y-m-d',strtotime($DataVal[8]))<=date('Y-m-d')){
 				
		 $connection= $ClassConnectionDB -> Open_connection(1);

		 $SQLstring="UPDATE Info SET Info.HistoryRemarks=? FROM (SELECT a.EmployeeID,b.Billable,b.CurrentStatus,b.HistoryRemarks FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as Info WHERE Info.EmployeeID like "."'".$Data[0]."'"."";
		 
		 
		 for($i=0;$i < count ($explodeRemarksVal);$i++){

		 	if($i != $remarksPos){
		 	
		 	if($i==0){
		 	$Datavalue[0]=$explodeRemarksVal[$i];

		 	}else{
		 	$Datavalue[0]=$Datavalue[0]."/".$explodeRemarksVal[$i]
		 	}

		 	}
		 
		 }

		 if( $Datavalue[0]!="" &&  $Datavalue[0]!=null){
		   		$Datavalue[0]=$Datavalue[0]."/";
		 }
		 $Datavalue[0]=$Datavalue[0].$Data[6].":".date('Y-m-d',strtotime($Data[8])).":LastUpdate-".date('Y-m-d h:m:s');

		 $prepExec=odbc_prepare($connection,$SQLstring);
			   	
         $execQuery=odbc_execute($prepExec,$Datavalue);

          if(!odbc_error($connection)){

          	 $returnVal=1;

          }else{

          	return 2;

          }

 		 }else if(date('Y-m-d',strtotime($DataVal[8])) > date('Y-m-d')){
            
          $SQLstring="WITH T AS (SELECT TOP 1 * FROM TB_NotificationTracking WHERE EmployeeID like "."'".$Data[0]."'"." ORDER BY DateTimeStamp DESC) DELETE FROM T";

          $connection= $ClassConnectionDB -> Open_connection(3);

          $execQuery=odbc_exec($connection, $SQLstring);

          if(!odbc_error($connection)){

          $ClassConnectionDB -> Close_connection($connection);

          $getTheLatestNotifData[]=null;

     

           	$SQLstring="SELECT TOP 1 b.Stat_Remarks,d.PositionCategoryVal FROM TB_NotificationTracking a JOIN DB_Employee_Management_System.dbo.TB_Status b ON a.StatusID=b.Stat_Num JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.EmployeeID=c.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory d ON c.Position=d.Code WHERE a.EmployeeID like "."'".$Data[0]."'"." ORDER BY a.DateTimeStamp DESC";

           

           $connection= $ClassConnectionDB -> Open_connection(3);

           $execQuery=odbc_exec($connection, $SQLstring);

            while(odbc_fetch_row($execQuery)){

			$getTheLatestNotifData[0]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			$getTheLatestNotifData[1]=odbc_result($execQuery, odbc_field_name($execQuery, 2));
			}

		  $ClassConnectionDB -> Close_connection($connection);



		  $connection= $ClassConnectionDB -> Open_connection(1);

			$SQLstring="UPDATE Info SET Info.Billable=?,Info.CurrentStatus=?,Info.HistoryRemarks=? FROM (SELECT a.EmployeeID,b.Billable,b.CurrentStatus,b.HistoryRemarks FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as Info WHERE Info.EmployeeID like "."'".$Data[0]."'"."";


			if($getTheLatestNotifData[0]=="Active"){

				if($getTheLatestNotifData[1]==$_SESSION['defaultPosition']){
				$Datavalue[0]="1";
				}else{
				$Datavalue[0]="2";
				}

			}else{

				$Datavalue[0]="2";
			}
			
			$Datavalue[1]=$getTheLatestNotifData[0];

			
			for($i=0;$i < count ($explodeRemarksVal);$i++){

		 	if($i != $remarksPos){
		 	
		 	if($i==0){
		 	$Datavalue[2]=$explodeRemarksVal[$i];

		 	}else{
		 	$Datavalue[2]=$Datavalue[2]."/".$explodeRemarksVal[$i]
		 	}

		 	}
		 
		 	}

		 if( $Datavalue[2]=="" &&  $Datavalue[2]==null){
		   		$Datavalue[2]="";
		 }
		
			$prepExec=odbc_prepare($connection,$SQLstring);
			   	
        	$execQuery=odbc_execute($prepExec,$Datavalue);

          if(!odbc_error($connection)){
          
           $ClassConnectionDB -> Close_connection($connection);

           $connection= $ClassConnectionDB -> Open_connection(3);

        	 $SQLstring="SELECT TOP 1 a.LastTableID,b.Table_Name FROM TB_NotificationTracking a JOIN TB_TableLinkNotification b ON a.StatusID=b.Stat_Num WHERE a.EmployeeID like "."'".$Data[0]."'"." ORDER BY DateTimeStamp DESC";

        	 $execQuery=odbc_exec($connection, $SQLstring);

        	 $getTrackingColumn2[]=null;
        	 
        	 while(odbc_fetch_row($execQuery)){

				$getTrackingColumn2[0]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
				$getTrackingColumn2[1]=odbc_result($execQuery, odbc_field_name($execQuery, 2));

			}

			 $ClassConnectionDB -> Close_connection($connection);


			 $connection= $ClassConnectionDB -> Open_connection(2);

        	 $SQLstring="UPDATE ".$getTrackingColumn2[1]." SET Lock=0 WHERE TableID=".$getTrackingColumn2[0]." WHERE EmployeeID like "."'".$Data[0]."'"."";


        	 $execQuery=odbc_exec($connection, $SQLstring);

          if(!odbc_error($connection)){

          	$returnVal=1;

          }else{

           return 2;
          }

          }else{

           return 2;
          }

          }else{

           return 2;
          }



        }

	}

	

         	
           	
  

		 return $returnVal;
}

function  btwUpdateInfo($Data,$whatTodo){


			$ClassConnectionDB=new DB_Connection();

			$SQLstring="";
			$RemarksValue="";
        	$NewRemarksValue="";
        	$PositionVal="";
        	$DefauktstatusCode="";
        	$returnVal=0;
        	$Datavalue[]=null;


        	$LastUpdate="";
        	$LastEffectivedDate="";


        	 $connection= $ClassConnectionDB -> Open_connection(3);

        	 $SQLstring="SELECT TOP 1 a.LastTableID,b.Table_Name,c.Stat_Category FROM TB_NotificationTracking a JOIN TB_TableLinkNotification b ON a.StatusID=b.Stat_Num JOIN DB_Employee_Management_System.dbo.TB_Status c ON a.StatusID=c.Stat_Num WHERE a.EmployeeID like "."'".$Data[0]."'"." ORDER BY DateTimeStamp DESC";

        	 $execQuery=odbc_exec($connection, $SQLstring);

        	

        	 while(odbc_fetch_row($execQuery)){

				$getTrackingColumn[0]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
				$getTrackingColumn[1]=odbc_result($execQuery, odbc_field_name($execQuery, 2));
				$getTrackingColumn[2]=odbc_result($execQuery, odbc_field_name($execQuery, 3));
			}

			$ClassConnectionDB -> Close_connection($connection);


        	$connection= $ClassConnectionDB -> Open_connection(1);

			$SQLstring="SELECT a.HistoryRemarks,c.EffectiveDate,c.LastUpdate FROM TB_State a JOIN TB_Information b ON a.TableID=b.TableID LEFT JOIN DB_Employee_Management_System_Notification.dbo.".$getTrackingColumn[1]." c ON b.EmployeeID=c.EmployeeID WHERE b.EmployeeID like "."'".$Data[0]."'"." AND c.TableID=".$getTrackingColumn[0]."";

			$execQuery=odbc_exec($connection, $SQLstring);
			if(!odbc_error($connection)){
			while(odbc_fetch_row($execQuery)){

			$RemarksValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			$LastEffectivedDate=odbc_result($execQuery, odbc_field_name($execQuery, 2));
			$LastUpdate=odbc_result($execQuery, odbc_field_name($execQuery, 3));

			}
			}else{

           	return 2;
           
           	}

		   $ClassConnectionDB -> Close_connection($connection);

		  
		   if($RemarksValue!="" && $RemarksValue!=null){
		   		  $NewRemarksValue=$RemarksValue."/";
		   }

			

           $SQLstring="SELECT FROM TB_Information a JOIN TB_PositionCategory b ON a.Position=b.Code WHERE a.EmployeeID like "."'".$Data[0]."'"."";

           $connection= $ClassConnectionDB -> Open_connection(1);

           $execQuery=odbc_exec($connection, $SQLstring);

            while(odbc_fetch_row($execQuery)){

			$PositionVal=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			
			}

		  	$ClassConnectionDB -> Close_connection($connection);

		   $SQLstring="SELECT PositionBillable,statusDefault FROM TB_DefaultValues";

           $connection= $ClassConnectionDB -> Open_connection(1);

           $execQuery=odbc_exec($connection, $SQLstring);

            while(odbc_fetch_row($execQuery)){

			$PositionForValid=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			$DefauktstatusCode=odbc_result($execQuery, odbc_field_name($execQuery, 2));
			}

		  	$ClassConnectionDB -> Close_connection($connection);



		    $NewRemarksValue=$NewRemarksValue."Back to work:".date('Y-m-d',strtotime($Data[6])).":LastUpdate-".date('Y-m-d h:m:s');

		    if($whatTodo=="Insert"){

		  
		    $connection= $ClassConnectionDB -> Open_connection(1);

		     $SQLstring="UPDATE Info SET Info.Billable,Info.CurrentStatus=?,Info.HistoryRemarks=? FROM (SELECT a.EmployeeID,b.Billable,b.CurrentStatus,b.HistoryRemarks FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as Info WHERE Info.EmployeeID like "."'".$Data[0]."'"."";
;
			
			if($PositionVal==$PositionForValid){
										
					$Datavalue[0]="1";
			
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

        	 $SQLstring="UPDATE ".$getTrackingColumn[1]." SET Lock=1 WHERE TableID=".$getTrackingColumn[0]." WHERE EmployeeID like "."'".$Data[0]."'"."";

        	 $execQuery=odbc_exec($connection, $SQLstring);

        	  if(!odbc_error($connection)){
        	 
        	 $connection= $ClassConnectionDB -> Open_connection(2);

        	 $SQLstring="SELECT TOP 1 EmployeeID,TableID FROM TB_BackToWork_Notification WHERE EmployeeID like "."'".$Data[0]."'"." ORDER BY DateRequest DESC"


        	 $execQuery=odbc_exec($connection, $SQLstring);

        	 $getTrackingToInsert[0]=date('Y-m-d h:m:s');

        	 while(odbc_fetch_row($execQuery)){

				$getTrackingToInsert[1]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
				$getTrackingToInsert[2]=$DefauktstatusCode;
				$getTrackingToInsert[3]=odbc_result($execQuery, odbc_field_name($execQuery, 3));
			}

        	 $ClassConnectionDB -> Close_connection($connection);

        	$connection= $ClassConnectionDB -> Open_connection(3);

        	$SQLstring="INSERT INTO TB_NotificationTracking (DateTimeStamp,EmployeeID,StatusID,LastTableID) VALUES (?,?,?,?)";

        	$prepExec=odbc_prepare($connection,$SQLstring);
			   	
        	$execQuery=odbc_execute($prepExec,$getTrackingToInsert); 

        	if(!odbc_error($connection)){

        		 $returnVal=1;
        		 $ClassConnectionDB -> Close_connection($connection);

        	}else{

        	 return 2;
        	 
        	}

        	}else{

        	return 2;
        	 
        	}


           	}else{

           	return 2;
           
           	}

          }else{

          	 $explodeRemarksVal=explode("/",$RemarksValue); 

          	 $remarksPos=0;

		     for($a=0;$a < count ($explodeRemarksVal);$a++){

		 	 $LastUpdate="";
        	 $LastEffectivedDate="";

		 	 if($explodeRemarksVal[$a]==="Back to work:".date('Y-m-d',strtotime($LastEffectivedDate)).":LastUpdate-".date('Y-m-d h:m:s',strtotime($LastUpdate))){

		 		 $remarksPos=$a;

		 	 }
		  }

		   if(date('Y-m-d',strtotime($DataVal[6]))<=date('Y-m-d')){

		    $connection= $ClassConnectionDB -> Open_connection(1);

		 $SQLstring="UPDATE Info SET Info.HistoryRemarks=? FROM (SELECT a.EmployeeID,b.Billable,b.CurrentStatus,b.HistoryRemarks FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as Info WHERE Info.EmployeeID like "."'".$Data[0]."'"."";
		 
		 
		 for($i=0;$i < count ($explodeRemarksVal);$i++){

		 	if($i != $remarksPos){
		 	
		 	if($i==0){
		 	$Datavalue[0]=$explodeRemarksVal[$i];

		 	}else{
		 	$Datavalue[0]=$Datavalue[0]."/".$explodeRemarksVal[$i]
		 	}

		 	}
		 
		 }

		 if( $Datavalue[0]!="" &&  $Datavalue[0]!=null){
		   		$Datavalue[0]=$Datavalue[0]."/";
		 }
		 $Datavalue[0]=$Datavalue[0].$Data[6].":".date('Y-m-d',strtotime($Data[6])).":LastUpdate-".date('Y-m-d h:m:s');

		 $prepExec=odbc_prepare($connection,$SQLstring);
			   	
         $execQuery=odbc_execute($prepExec,$Datavalue);

          if(!odbc_error($connection)){

          	 $returnVal=1;

          }else{

          	return 2;

          }

		  }else if(date('Y-m-d',strtotime($DataVal[6])) > date('Y-m-d')){


		  $SQLstring="WITH T AS (SELECT TOP 1 * FROM TB_NotificationTracking WHERE EmployeeID like "."'".$Data[0]."'"." ORDER BY DateTimeStamp DESC) DELETE FROM T";

          $connection= $ClassConnectionDB -> Open_connection(3);

          $execQuery=odbc_exec($connection, $SQLstring);

          if(!odbc_error($connection)){

          $ClassConnectionDB -> Close_connection($connection);

          $getTheLatestNotifData[]=null;

  

           	$SQLstring="SELECT TOP 1 b.Stat_Remarks,d.PositionCategoryVal FROM TB_NotificationTracking a JOIN DB_Employee_Management_System.dbo.TB_Status b ON a.StatusID=b.Stat_Num JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.EmployeeID=c.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory d ON c.Position=d.Code WHERE a.EmployeeID like "."'".$Data[0]."'"." ORDER BY a.DateTimeStamp DESC";

           

           

           $connection= $ClassConnectionDB -> Open_connection(3);

           $execQuery=odbc_exec($connection, $SQLstring);

            while(odbc_fetch_row($execQuery)){

			$getTheLatestNotifData[0]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			$getTheLatestNotifData[1]=odbc_result($execQuery, odbc_field_name($execQuery, 2));
			}

		  $ClassConnectionDB -> Close_connection($connection);



		  $connection= $ClassConnectionDB -> Open_connection(1);

			$SQLstring="UPDATE Info SET Info.Billable=?,Info.CurrentStatus=?,Info.HistoryRemarks=? FROM (SELECT a.EmployeeID,b.Billable,b.CurrentStatus,b.HistoryRemarks FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as Info WHERE Info.EmployeeID like "."'".$Data[0]."'"."";


			if($getTheLatestNotifData[0]=="Active"){

				if($getTheLatestNotifData[1]==$_SESSION['defaultPosition']){
				$Datavalue[0]="1";
				}else{
				$Datavalue[0]="2";
				}

			}else{

				$Datavalue[0]="2";
			}
			
			$Datavalue[1]=$getTheLatestNotifData[0];

			
			for($i=0;$i < count ($explodeRemarksVal);$i++){

		 	if($i != $remarksPos){
		 	
		 	if($i==0){
		 	$Datavalue[2]=$explodeRemarksVal[$i];

		 	}else{
		 	$Datavalue[2]=$Datavalue[2]."/".$explodeRemarksVal[$i]
		 	}

		 	}
		 
		 	}

		 if( $Datavalue[2]=="" &&  $Datavalue[2]==null){
		   		$Datavalue[2]="";
		 }
		
		  $prepExec=odbc_prepare($connection,$SQLstring);
			   	
          $execQuery=odbc_execute($prepExec,$Datavalue);

          if(!odbc_error($connection)){
          
           $ClassConnectionDB -> Close_connection($connection);

           $connection= $ClassConnectionDB -> Open_connection(3);

           $SQLstring="SELECT TOP 1 a.LastTableID,b.Table_Name FROM TB_NotificationTracking a JOIN TB_TableLinkNotification b ON a.StatusID=b.Stat_Num WHERE a.EmployeeID like "."'".$Data[0]."'"." ORDER BY DateTimeStamp DESC";

        	 $execQuery=odbc_exec($connection, $SQLstring);

        	 $getTrackingColumn2[]=null;
        	 
        	 while(odbc_fetch_row($execQuery)){

				$getTrackingColumn2[0]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
				$getTrackingColumn2[1]=odbc_result($execQuery, odbc_field_name($execQuery, 2));

			}

			 $ClassConnectionDB -> Close_connection($connection);


			 $connection= $ClassConnectionDB -> Open_connection(2);

        	 $SQLstring="UPDATE ".$getTrackingColumn2[1]." SET Lock=0 WHERE TableID=".$getTrackingColumn2[0]." WHERE EmployeeID like "."'".$Data[0]."'"."";


        	 $execQuery=odbc_exec($connection, $SQLstring);

          if(!odbc_error($connection)){

          	$returnVal=1;

          }else{

           return 2;
          }

          }else{

           return 2;
          }

          }else{

           return 2;

          }


		  }

	
		}
	

	return $returnVal;
}


function autoseperationUpdateInfo($Data,$statcode){



			$SQLstring="";
			$RemarksValue="";
        	$NewRemarksValue="";
        	$returnVal=0;
        	$Datavalue[]=null;

        	$LastUpdate="";
        	$LastEffectivedDate="";

        	$getTrackingColumn[]=null;

        	$connection= $ClassConnectionDB -> Open_connection(3);

        	 $SQLstring="SELECT TOP 1 a.LastTableID,b.Table_Name,c.Stat_Category FROM TB_NotificationTracking a JOIN TB_TableLinkNotification b ON a.StatusID=b.Stat_Num JOIN DB_Employee_Management_System.dbo.TB_Status c ON a.StatusID=c.Stat_Num WHERE a.EmployeeID like "."'".$Data[0]."'"." ORDER BY DateTimeStamp DESC";

        	 $execQuery=odbc_exec($connection, $SQLstring);

        	

        	 while(odbc_fetch_row($execQuery)){

				$getTrackingColumn[0]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
				$getTrackingColumn[1]=odbc_result($execQuery, odbc_field_name($execQuery, 2));
				$getTrackingColumn[2]=odbc_result($execQuery, odbc_field_name($execQuery, 3));
			}


			$ClassConnectionDB -> Close_connection($connection);

			$connection= $ClassConnectionDB -> Open_connection(1);
			$SQLstring="SELECT a.HistoryRemarks,c.EffectiveDate,c.LastUpdate FROM TB_State a JOIN TB_Information b ON a.TableID=b.TableID LEFT JOIN DB_Employee_Management_System_Notification.dbo.".$getTrackingColumn[1]." c ON b.EmployeeID=c.EmployeeID WHERE b.EmployeeID like "."'".$Data[0]."'"." AND c.TableID=".$getTrackingColumn[0]."";

			$execQuery=odbc_exec($connection, $SQLstring);
			if(!odbc_error($connection)){
			while(odbc_fetch_row($execQuery)){

			$RemarksValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			$LastEffectivedDate=odbc_result($execQuery, odbc_field_name($execQuery, 2));
			$LastUpdate=odbc_result($execQuery, odbc_field_name($execQuery, 3));

			}
			}else{

           	return 2;
           
           	}

		   $ClassConnectionDB -> Close_connection($connection);

		  
		   if($RemarksValue!="" && $RemarksValue!=null){
		   		  $NewRemarksValue=$RemarksValue."/";
		   }



		   $NewRemarksValue=$NewRemarksValue.$Data[6].":".date('Y-m-d',strtotime($Data[5])).":LastUpdate-".date('Y-m-d h:m:s');

		   if($whatTodo=="Insert"){


		  $connection= $ClassConnectionDB -> Open_connection(1);

		  $SQLstring="UPDATE Info SET Info.Billable=?,Info.CurrentStatus=?,Info.HistoryRemarks=? FROM (SELECT a.EmployeeID,b.Billable,b.CurrentStatus,b.HistoryRemarks FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as Info WHERE Info.EmployeeID like "."'".$Data[0]."'"."";
;
			
			$Datavalue[0]="2";
			$Datavalue[1]=$Data[6];
			$Datavalue[2]=$NewRemarksValue;
			
			$prepExec=odbc_prepare($connection,$SQLstring);
			   	
        	$execQuery=odbc_execute($prepExec,$Datavalue);

        	if(!odbc_error($connection)){
           	
        	 $ClassConnectionDB -> Close_connection($connection);

        	

			 $connection= $ClassConnectionDB -> Open_connection(2);

        	 $SQLstring="UPDATE ".$getTrackingColumn[1]." SET Lock=1 WHERE TableID=".$getTrackingColumn[0]." WHERE EmployeeID like "."'".$Data[0]."'"."";


        	 $execQuery=odbc_exec($connection, $SQLstring);

        	  if(!odbc_error($connection)){
        	 
        	 $connection= $ClassConnectionDB -> Open_connection(2);

        	 $SQLstring="SELECT TOP 1 EmployeeID,StatusCode,TableID FROM TB_autoSeparate_Notification WHERE EmployeeID like "."'".$Data[0]."'"." ORDER BY DateRequest DESC"


        	 $execQuery=odbc_exec($connection, $SQLstring);

        	 $getTrackingToInsert[0]=date('Y-m-d h:m:s');

        	 while(odbc_fetch_row($execQuery)){

				$getTrackingToInsert[1]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
				$getTrackingToInsert[2]=odbc_result($execQuery, odbc_field_name($execQuery, 2));
				$getTrackingToInsert[3]=odbc_result($execQuery, odbc_field_name($execQuery, 3));
			}

        	 $ClassConnectionDB -> Close_connection($connection);

        	$connection= $ClassConnectionDB -> Open_connection(3);

        	$SQLstring="INSERT INTO TB_NotificationTracking (DateTimeStamp,EmployeeID,StatusID,LastTableID) VALUES (?,?,?,?)";

        	$prepExec=odbc_prepare($connection,$SQLstring);
			   	
        	$execQuery=odbc_execute($prepExec,$getTrackingToInsert); 

        	if(!odbc_error($connection)){

        	
        		 $ClassConnectionDB -> Close_connection($connection);

        	 	  $connection= $ClassConnectionDB -> Open_connection(1);

        	 	  $SQLstring="DELETE a FROM TB_State a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 	  $execQuery=odbc_exec($connection, $SQLstring);

        	 	  if(!odbc_error($connection)){
        	 	  	return 2;
        	 	  }

        	 	  $ClassConnectionDB -> Close_connection($connection);

        	 	  $connection= $ClassConnectionDB -> Open_connection(1);
        	 	  $SQLstring="DELETE a FROM TB_Hierarchy a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 	  $execQuery=odbc_exec($connection, $SQLstring);

        	 	   if(!odbc_error($connection)){
        	 	  	return 2;
        	 	  }

        	 	  $ClassConnectionDB -> Close_connection($connection);

        	 	  $connection= $ClassConnectionDB -> Open_connection(1);
        	 	  $SQLstring="DELETE a FROM TB_Credentials a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 	  $execQuery=odbc_exec($connection, $SQLstring);

        	 	   if(!odbc_error($connection)){
        	 	  	return 2;
        	 	  }

        	 	  $ClassConnectionDB -> Close_connection($connection);

        	 	  $connection= $ClassConnectionDB -> Open_connection(1);
        	 	  $SQLstring="DELETE a FROM TB_ProfilePhoto a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 	  $execQuery=odbc_exec($connection, $SQLstring);

        	 	   if(!odbc_error($connection)){
        	 	  	return 2;
        	 	  }

        	 	  $ClassConnectionDB -> Close_connection($connection);

        	 	  $connection= $ClassConnectionDB -> Open_connection(1);
        	 	  $SQLstring="DELETE FROM TB_Information WHERE EmployeeID like "."'".$Data[0]."'"."";
        	 	  $execQuery=odbc_exec($connection, $SQLstring);

        	 	   if(!odbc_error($connection)){
        	 	  	return 2;
        	 	  }

        	 	  $ClassConnectionDB -> Close_connection($connection);


        	 	  $returnVal=1;
        	

        	}else{

        	 return 2;
        	 
        	}

        	}else{

        	return 2;
        	 
        	}

 
           	}else{

           	return 2;
           
           	}


         }else{

         $explodeRemarksVal=explode("/",$RemarksValue); 

		 $remarksPos=0;

		 for($a=0;$a < count ($explodeRemarksVal);$a++){

		 	$LastUpdate="";
        	$LastEffectivedDate="";

		 	if($explodeRemarksVal[$a]===$Data[6].":".date('Y-m-d',strtotime($LastEffectivedDate)).":LastUpdate-".date('Y-m-d h:m:s',strtotime($LastUpdate))){

		 		 $remarksPos=$a;

		 	}
		 }
		 	
		 if(date('Y-m-d',strtotime($DataVal[8]))<=date('Y-m-d')){
 				
		 $connection= $ClassConnectionDB -> Open_connection(4);

		 $SQLstring="UPDATE Info SET Info.HistoryRemarks=? FROM (SELECT a.EmployeeID,b.Billable,b.CurrentStatus,b.HistoryRemarks FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as Info WHERE Info.EmployeeID like "."'".$Data[0]."'"."";
		 
		 
		 for($i=0;$i < count ($explodeRemarksVal);$i++){

		 	if($i != $remarksPos){
		 	
		 	if($i==0){
		 	$Datavalue[0]=$explodeRemarksVal[$i];

		 	}else{
		 	$Datavalue[0]=$Datavalue[0]."/".$explodeRemarksVal[$i]
		 	}

		 	}
		 
		 }

		 if( $Datavalue[0]!="" &&  $Datavalue[0]!=null){
		   		$Datavalue[0]=$Datavalue[0]."/";
		 }
		 $Datavalue[0]=$Datavalue[0].$Data[6].":".date('Y-m-d',strtotime($Data[5])).":LastUpdate-".date('Y-m-d h:m:s');

		 $prepExec=odbc_prepare($connection,$SQLstring);
			   	
         $execQuery=odbc_execute($prepExec,$Datavalue);

          if(!odbc_error($connection)){

          	 $returnVal=1;

          }else{

          	return 2;

          }

 		 }else if(date('Y-m-d',strtotime($DataVal[8])) > date('Y-m-d')){
            
          $SQLstring="WITH T AS (SELECT TOP 1 * FROM TB_NotificationTracking WHERE EmployeeID like "."'".$Data[0]."'"." ORDER BY DateTimeStamp DESC) DELETE FROM T";

          $connection= $ClassConnectionDB -> Open_connection(3);

          $execQuery=odbc_exec($connection, $SQLstring);

          if(!odbc_error($connection)){

          $ClassConnectionDB -> Close_connection($connection);

          $getTheLatestNotifData[]=null;

            

           	$SQLstring="SELECT TOP 1 b.Stat_Remarks,d.PositionCategoryVal FROM TB_NotificationTracking a JOIN DB_Employee_Management_System.dbo.TB_Status b ON a.StatusID=b.Stat_Num JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.EmployeeID=c.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory d ON c.Position=d.Code WHERE a.EmployeeID like "."'".$Data[0]."'"." ORDER BY a.DateTimeStamp DESC";

        
           $connection= $ClassConnectionDB -> Open_connection(3);

           $execQuery=odbc_exec($connection, $SQLstring);

            while(odbc_fetch_row($execQuery)){

			$getTheLatestNotifData[0]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			$getTheLatestNotifData[1]=odbc_result($execQuery, odbc_field_name($execQuery, 2));
			}

		  $ClassConnectionDB -> Close_connection($connection);



		  $connection= $ClassConnectionDB -> Open_connection(4);


			$SQLstring="UPDATE Info SET Info.Billable=?,Info.CurrentStatus=?,Info.HistoryRemarks=? FROM (SELECT a.EmployeeID,b.Billable,b.CurrentStatus,b.HistoryRemarks FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as Info WHERE Info.EmployeeID like "."'".$Data[0]."'"."";


			if($getTheLatestNotifData[0]=="Active"){

				if($getTheLatestNotifData[1]==$_SESSION['defaultPosition']){
				$Datavalue[0]="1";
				}else{
				$Datavalue[0]="2";
				}

			}else{

				$Datavalue[0]="2";
			}
			
			$Datavalue[1]=$getTheLatestNotifData[0];

			
			for($i=0;$i < count ($explodeRemarksVal);$i++){

		 	if($i != $remarksPos){
		 	
		 	if($i==0){
		 	$Datavalue[2]=$explodeRemarksVal[$i];

		 	}else{
		 	$Datavalue[2]=$Datavalue[2]."/".$explodeRemarksVal[$i]
		 	}

		 	}
		 
		 	}

		 if( $Datavalue[2]=="" &&  $Datavalue[2]==null){
		   		$Datavalue[2]="";
		 }
		
			$prepExec=odbc_prepare($connection,$SQLstring);
			   	
        	$execQuery=odbc_execute($prepExec,$Datavalue);

          if(!odbc_error($connection)){
          
           $ClassConnectionDB -> Close_connection($connection);

           $connection= $ClassConnectionDB -> Open_connection(3);

        	 $SQLstring="SELECT TOP 1 a.LastTableID,b.Table_Name FROM TB_NotificationTracking a JOIN TB_TableLinkNotification b ON a.StatusID=b.Stat_Num WHERE a.EmployeeID like "."'".$Data[0]."'"." ORDER BY DateTimeStamp DESC";

        	 $execQuery=odbc_exec($connection, $SQLstring);

        	 $getTrackingColumn2[]=null;
        	 
        	 while(odbc_fetch_row($execQuery)){

				$getTrackingColumn2[0]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
				$getTrackingColumn2[1]=odbc_result($execQuery, odbc_field_name($execQuery, 2));

			}

			 $ClassConnectionDB -> Close_connection($connection);


			 $connection= $ClassConnectionDB -> Open_connection(2);

        	 $SQLstring="UPDATE ".$getTrackingColumn2[1]." SET Lock=0 WHERE TableID=".$getTrackingColumn2[0]." WHERE EmployeeID like "."'".$Data[0]."'"."";


        	 $execQuery=odbc_exec($connection, $SQLstring);

          if(!odbc_error($connection)){


          	 	  $ClassConnectionDB -> Close_connection($connection);

        	 	  $connection= $ClassConnectionDB -> Open_connection(4);

        	 	  $SQLstring="DELETE a FROM TB_State a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 	  $execQuery=odbc_exec($connection, $SQLstring);

        	 	  if(!odbc_error($connection)){
        	 	  	return 2;
        	 	  }

        	 	  $ClassConnectionDB -> Close_connection($connection);

        	 	  $connection= $ClassConnectionDB -> Open_connection(4);
        	 	  $SQLstring="DELETE a FROM TB_Hierarchy a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 	  $execQuery=odbc_exec($connection, $SQLstring);

        	 	   if(!odbc_error($connection)){
        	 	  	return 2;
        	 	  }

        	 	  $ClassConnectionDB -> Close_connection($connection);

        	 	  $connection= $ClassConnectionDB -> Open_connection(4);
        	 	  $SQLstring="DELETE a FROM TB_Credentials a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 	  $execQuery=odbc_exec($connection, $SQLstring);

        	 	   if(!odbc_error($connection)){
        	 	  	return 2;
        	 	  }

        	 	  $ClassConnectionDB -> Close_connection($connection);

        	 	  $connection= $ClassConnectionDB -> Open_connection(4);
        	 	  $SQLstring="DELETE a FROM TB_ProfilePhoto a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 	  $execQuery=odbc_exec($connection, $SQLstring);

        	 	   if(!odbc_error($connection)){
        	 	  	return 2;
        	 	  }

        	 	  $ClassConnectionDB -> Close_connection($connection);

        	 	  


        	 	  $returnVal=1;
          

          }else{

           return 2;
          }

          }else{

           return 2;
          }

          }else{

           return 2;
          }



        }

      }
           	
       
	

	return $returnVal;
}



function ResignationUpdateInfo($Data){

	

			$SQLstring="";
			$RemarksValue="";
        	$NewRemarksValue="";
        	$returnVal=0;
        	$Datavalue[]=null;

        	$LastUpdate="";
        	$LastEffectivedDate="";

        	$getTrackingColumn[]=null;

        	$connection= $ClassConnectionDB -> Open_connection(3);

        	 $SQLstring="SELECT TOP 1 a.LastTableID,b.Table_Name,c.Stat_Category FROM TB_NotificationTracking a JOIN TB_TableLinkNotification b ON a.StatusID=b.Stat_Num JOIN DB_Employee_Management_System.dbo.TB_Status c ON a.StatusID=c.Stat_Num WHERE a.EmployeeID like "."'".$Data[0]."'"." ORDER BY DateTimeStamp DESC";

        	 $execQuery=odbc_exec($connection, $SQLstring);

        	

        	 while(odbc_fetch_row($execQuery)){

				$getTrackingColumn[0]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
				$getTrackingColumn[1]=odbc_result($execQuery, odbc_field_name($execQuery, 2));
				$getTrackingColumn[2]=odbc_result($execQuery, odbc_field_name($execQuery, 3));
			}


			$ClassConnectionDB -> Close_connection($connection);

			$connection= $ClassConnectionDB -> Open_connection(1);
			$SQLstring="SELECT a.HistoryRemarks,c.EffectiveDate,c.LastUpdate FROM TB_State a JOIN TB_Information b ON a.TableID=b.TableID LEFT JOIN DB_Employee_Management_System_Notification.dbo.".$getTrackingColumn[1]." c ON b.EmployeeID=c.EmployeeID WHERE b.EmployeeID like "."'".$Data[0]."'"." AND c.TableID=".$getTrackingColumn[0]."";

			$execQuery=odbc_exec($connection, $SQLstring);
			if(!odbc_error($connection)){
			while(odbc_fetch_row($execQuery)){

			$RemarksValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			$LastEffectivedDate=odbc_result($execQuery, odbc_field_name($execQuery, 2));
			$LastUpdate=odbc_result($execQuery, odbc_field_name($execQuery, 3));

			}
			}else{

           	return 2;
           
           	}

		   $ClassConnectionDB -> Close_connection($connection);

		  
		   if($RemarksValue!="" && $RemarksValue!=null){
		   		  $NewRemarksValue=$RemarksValue."/";
		   }



		   $NewRemarksValue=$NewRemarksValue."Resigned:".date('Y-m-d',strtotime($Data[6])).":LastUpdate-".date('Y-m-d h:m:s');

		   if($whatTodo=="Insert"){


		  $connection= $ClassConnectionDB -> Open_connection(1);

		  $SQLstring="UPDATE Info SET Info.Billable=?,Info.CurrentStatus=?,Info.HistoryRemarks=? FROM (SELECT a.EmployeeID,b.Billable,b.CurrentStatus,b.HistoryRemarks FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as Info WHERE Info.EmployeeID like "."'".$Data[0]."'"."";
;
			
			$Datavalue[0]="2";
			$Datavalue[1]="Resigned";
			$Datavalue[2]=$NewRemarksValue;
			
			$prepExec=odbc_prepare($connection,$SQLstring);
			   	
        	$execQuery=odbc_execute($prepExec,$Datavalue);

        	if(!odbc_error($connection)){
           	
        	 $ClassConnectionDB -> Close_connection($connection);

        	

			 $connection= $ClassConnectionDB -> Open_connection(2);

        	 $SQLstring="UPDATE ".$getTrackingColumn[1]." SET Lock=1 WHERE TableID=".$getTrackingColumn[0]." WHERE EmployeeID like "."'".$Data[0]."'"."";


        	 $execQuery=odbc_exec($connection, $SQLstring);

        	  if(!odbc_error($connection)){
        	 
        	 $connection= $ClassConnectionDB -> Open_connection(2);

        	 $SQLstring="SELECT TOP 1 EmployeeID,StatusCode,TableID FROM TB_autoSeparate_Notification WHERE EmployeeID like "."'".$Data[0]."'"." ORDER BY DateRequest DESC"


        	 $execQuery=odbc_exec($connection, $SQLstring);

        	 $getTrackingToInsert[0]=date('Y-m-d h:m:s');

        	 while(odbc_fetch_row($execQuery)){

				$getTrackingToInsert[1]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
				$getTrackingToInsert[2]=odbc_result($execQuery, odbc_field_name($execQuery, 2));
				$getTrackingToInsert[3]=odbc_result($execQuery, odbc_field_name($execQuery, 3));
			}

        	 $ClassConnectionDB -> Close_connection($connection);

        	$connection= $ClassConnectionDB -> Open_connection(3);

        	$SQLstring="INSERT INTO TB_NotificationTracking (DateTimeStamp,EmployeeID,StatusID,LastTableID) VALUES (?,?,?,?)";

        	$prepExec=odbc_prepare($connection,$SQLstring);
			   	
        	$execQuery=odbc_execute($prepExec,$getTrackingToInsert); 

        	if(!odbc_error($connection)){

        	
        		 $ClassConnectionDB -> Close_connection($connection);

        	 	  $connection= $ClassConnectionDB -> Open_connection(1);

        	 	  $SQLstring="DELETE a FROM TB_State a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 	  $execQuery=odbc_exec($connection, $SQLstring);

        	 	  if(!odbc_error($connection)){
        	 	  	return 2;
        	 	  }

        	 	  $ClassConnectionDB -> Close_connection($connection);

        	 	  $connection= $ClassConnectionDB -> Open_connection(1);
        	 	  $SQLstring="DELETE a FROM TB_Hierarchy a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 	  $execQuery=odbc_exec($connection, $SQLstring);

        	 	   if(!odbc_error($connection)){
        	 	  	return 2;
        	 	  }

        	 	  $ClassConnectionDB -> Close_connection($connection);

        	 	  $connection= $ClassConnectionDB -> Open_connection(1);
        	 	  $SQLstring="DELETE a FROM TB_Credentials a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 	  $execQuery=odbc_exec($connection, $SQLstring);

        	 	   if(!odbc_error($connection)){
        	 	  	return 2;
        	 	  }

        	 	  $ClassConnectionDB -> Close_connection($connection);

        	 	  $connection= $ClassConnectionDB -> Open_connection(1);
        	 	  $SQLstring="DELETE a FROM TB_ProfilePhoto a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 	  $execQuery=odbc_exec($connection, $SQLstring);

        	 	   if(!odbc_error($connection)){
        	 	  	return 2;
        	 	  }

        	 	  $ClassConnectionDB -> Close_connection($connection);

        	 	  $connection= $ClassConnectionDB -> Open_connection(1);
        	 	  $SQLstring="DELETE FROM TB_Information WHERE EmployeeID like "."'".$Data[0]."'"."";
        	 	  $execQuery=odbc_exec($connection, $SQLstring);

        	 	   if(!odbc_error($connection)){
        	 	  	return 2;
        	 	  }

        	 	  $ClassConnectionDB -> Close_connection($connection);


        	 	  $returnVal=1;
        	

        	}else{

        	 return 2;
        	 
        	}

        	}else{

        	return 2;
        	 
        	}

 
           	}else{

           	return 2;
           
           	}


         }else{

         $explodeRemarksVal=explode("/",$RemarksValue); 

		 $remarksPos=0;

		 for($a=0;$a < count ($explodeRemarksVal);$a++){

		 	$LastUpdate="";
        	$LastEffectivedDate="";

		 	if($explodeRemarksVal[$a]===$Data[6].":".date('Y-m-d',strtotime($LastEffectivedDate)).":LastUpdate-".date('Y-m-d h:m:s',strtotime($LastUpdate))){

		 		 $remarksPos=$a;

		 	}
		 }
		 	
		 if(date('Y-m-d',strtotime($DataVal[8]))<=date('Y-m-d')){
 				
		 $connection= $ClassConnectionDB -> Open_connection(4);

		 $SQLstring="UPDATE Info SET Info.HistoryRemarks=? FROM (SELECT a.EmployeeID,b.Billable,b.CurrentStatus,b.HistoryRemarks FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as Info WHERE Info.EmployeeID like "."'".$Data[0]."'"."";
		 
		 
		 for($i=0;$i < count ($explodeRemarksVal);$i++){

		 	if($i != $remarksPos){
		 	
		 	if($i==0){
		 	$Datavalue[0]=$explodeRemarksVal[$i];

		 	}else{
		 	$Datavalue[0]=$Datavalue[0]."/".$explodeRemarksVal[$i]
		 	}

		 	}
		 
		 }

		 if( $Datavalue[0]!="" &&  $Datavalue[0]!=null){
		   		$Datavalue[0]=$Datavalue[0]."/";
		 }
		 $Datavalue[0]=$Datavalue[0]."Resigned:".date('Y-m-d',strtotime($Data[5])).":LastUpdate-".date('Y-m-d h:m:s');

		 $prepExec=odbc_prepare($connection,$SQLstring);
			   	
         $execQuery=odbc_execute($prepExec,$Datavalue);

          if(!odbc_error($connection)){

          	 $returnVal=1;

          }else{

          	return 2;

          }

 		 }else if(date('Y-m-d',strtotime($DataVal[8])) > date('Y-m-d')){
            
          $SQLstring="WITH T AS (SELECT TOP 1 * FROM TB_NotificationTracking WHERE EmployeeID like "."'".$Data[0]."'"." ORDER BY DateTimeStamp DESC) DELETE FROM T";

          $connection= $ClassConnectionDB -> Open_connection(3);

          $execQuery=odbc_exec($connection, $SQLstring);

          if(!odbc_error($connection)){

          $ClassConnectionDB -> Close_connection($connection);

          $getTheLatestNotifData[]=null;

            

           	$SQLstring="SELECT TOP 1 b.Stat_Remarks,d.PositionCategoryVal FROM TB_NotificationTracking a JOIN DB_Employee_Management_System.dbo.TB_Status b ON a.StatusID=b.Stat_Num JOIN DB_Employee_Management_System.dbo.TB_Information c ON a.EmployeeID=c.EmployeeID JOIN DB_Employee_Management_System.dbo.TB_PositionCategory d ON c.Position=d.Code WHERE a.EmployeeID like "."'".$Data[0]."'"." ORDER BY a.DateTimeStamp DESC";

        
           $connection= $ClassConnectionDB -> Open_connection(3);

           $execQuery=odbc_exec($connection, $SQLstring);

            while(odbc_fetch_row($execQuery)){

			$getTheLatestNotifData[0]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			$getTheLatestNotifData[1]=odbc_result($execQuery, odbc_field_name($execQuery, 2));
			}

		  $ClassConnectionDB -> Close_connection($connection);



		  $connection= $ClassConnectionDB -> Open_connection(4);


			$SQLstring="UPDATE Info SET Info.Billable=?,Info.CurrentStatus=?,Info.HistoryRemarks=? FROM (SELECT a.EmployeeID,b.Billable,b.CurrentStatus,b.HistoryRemarks FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as Info WHERE Info.EmployeeID like "."'".$Data[0]."'"."";


			if($getTheLatestNotifData[0]=="Active"){

				if($getTheLatestNotifData[1]==$_SESSION['defaultPosition']){
				$Datavalue[0]="1";
				}else{
				$Datavalue[0]="2";
				}

			}else{

				$Datavalue[0]="2";
			}
			
			$Datavalue[1]=$getTheLatestNotifData[0];

			
			for($i=0;$i < count ($explodeRemarksVal);$i++){

		 	if($i != $remarksPos){
		 	
		 	if($i==0){
		 	$Datavalue[2]=$explodeRemarksVal[$i];

		 	}else{
		 	$Datavalue[2]=$Datavalue[2]."/".$explodeRemarksVal[$i]
		 	}

		 	}
		 
		 	}

		 if( $Datavalue[2]=="" &&  $Datavalue[2]==null){
		   		$Datavalue[2]="";
		 }
		
			$prepExec=odbc_prepare($connection,$SQLstring);
			   	
        	$execQuery=odbc_execute($prepExec,$Datavalue);

          if(!odbc_error($connection)){
          
           $ClassConnectionDB -> Close_connection($connection);

           $connection= $ClassConnectionDB -> Open_connection(3);

        	 $SQLstring="SELECT TOP 1 a.LastTableID,b.Table_Name FROM TB_NotificationTracking a JOIN TB_TableLinkNotification b ON a.StatusID=b.Stat_Num WHERE a.EmployeeID like "."'".$Data[0]."'"." ORDER BY DateTimeStamp DESC";

        	 $execQuery=odbc_exec($connection, $SQLstring);

        	 $getTrackingColumn2[]=null;
        	 
        	 while(odbc_fetch_row($execQuery)){

				$getTrackingColumn2[0]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
				$getTrackingColumn2[1]=odbc_result($execQuery, odbc_field_name($execQuery, 2));

			}

			 $ClassConnectionDB -> Close_connection($connection);


			 $connection= $ClassConnectionDB -> Open_connection(2);

        	 $SQLstring="UPDATE ".$getTrackingColumn2[1]." SET Lock=0 WHERE TableID=".$getTrackingColumn2[0]." WHERE EmployeeID like "."'".$Data[0]."'"."";


        	 $execQuery=odbc_exec($connection, $SQLstring);

          if(!odbc_error($connection)){


          	 	  $ClassConnectionDB -> Close_connection($connection);
          	 	  
        	 	  $connection= $ClassConnectionDB -> Open_connection(4);

        	 	  $SQLstring="DELETE a FROM TB_State a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 	  $execQuery=odbc_exec($connection, $SQLstring);

        	 	  if(!odbc_error($connection)){
        	 	  	return 2;
        	 	  }

        	 	  $ClassConnectionDB -> Close_connection($connection);

        	 	  $connection= $ClassConnectionDB -> Open_connection(4);
        	 	  $SQLstring="DELETE a FROM TB_Hierarchy a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 	  $execQuery=odbc_exec($connection, $SQLstring);

        	 	   if(!odbc_error($connection)){
        	 	  	return 2;
        	 	  }

        	 	  $ClassConnectionDB -> Close_connection($connection);

        	 	  $connection= $ClassConnectionDB -> Open_connection(4);
        	 	  $SQLstring="DELETE a FROM TB_Credentials a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 	  $execQuery=odbc_exec($connection, $SQLstring);

        	 	   if(!odbc_error($connection)){
        	 	  	return 2;
        	 	  }

        	 	  $ClassConnectionDB -> Close_connection($connection);

        	 	  $connection= $ClassConnectionDB -> Open_connection(4);
        	 	  $SQLstring="DELETE a FROM TB_ProfilePhoto a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'".$Data[0]."'"."";
        	 	  $execQuery=odbc_exec($connection, $SQLstring);

        	 	   if(!odbc_error($connection)){
        	 	  	return 2;
        	 	  }

        	 	  $ClassConnectionDB -> Close_connection($connection);

        	 	  


        	 	  $returnVal=1;
          

          }else{

           return 2;
          }

          }else{

           return 2;
          }

          }else{

           return 2;
          }



        }

      }
           	
       
	

	return $returnVal;



}

}

?>