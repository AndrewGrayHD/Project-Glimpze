<?php


class UpdateInfo_Engine{


	function EndorsementUpdateInfo($Data,$ProcessID,$TrainerID,$SQLcode,$whatTodo){

		

		$ClassConnectionDB=new DB_Connection();

		    $SQLstring="";

		    $returnVal=0;

		    $agentEmpIds=explode("/", $Data[0]);
        $RemarksValue="";
        $NewRemarksValue="";
        $Datavalue[]=null;
  		
        
        $LastEffectivedDate="";
        $LastTrainer="";
        $LastProcess="";
      	$LastBatch="";
        $LastUpdate="";

        $InheritSup1="";
        $InheritSup2="";
        $InheritSup3="";
        $InheritSup4="";

        $getTrackingColumn[]=null;

        $connection= $ClassConnectionDB -> Open_connection(3);

        $SQLstring="SELECT TOP 1 a.LastTableID,b.Table_Name FROM TB_EndorsementTracking a JOIN TB_TableLinkEndorsement b ON a.EndorsementID=b.Stat_Num  WHERE a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." ORDER BY DateTimeStamp DESC";

       	$execQuery=odbc_exec($connection, $SQLstring);

        	while(odbc_fetch_row($execQuery)){

				$getTrackingColumn[0]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
				$getTrackingColumn[1]=odbc_result($execQuery, odbc_field_name($execQuery, 2));
				
			}

		$ClassConnectionDB -> Close_connection($connection);


		$connection= $ClassConnectionDB -> Open_connection(2);

		$SQLstring="SELECT a.EffectiveDate,a.TrainerEmpID,a.ProcessID,a.Batch,a.LastUpdate FROM ".$getTrackingColumn[1]." WHERE TableID=".$getTrackingColumn[0]."";

			$execQuery=odbc_exec($connection, $SQLstring);
			if(!odbc_error($connection)){
			while(odbc_fetch_row($execQuery)){

			
			$LastEffectivedDate=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			$LastTrainer=odbc_result($execQuery, odbc_field_name($execQuery, 2));
      $LastProcess=odbc_result($execQuery, odbc_field_name($execQuery, 3));
      $LastBatch=odbc_result($execQuery, odbc_field_name($execQuery, 4));
			$LastUpdate=odbc_result($execQuery, odbc_field_name($execQuery, 5));

			}
			}else{

      return 2;
           
      }

		   $ClassConnectionDB -> Close_connection($connection);

		
    $SQLstring="SELECT b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4 FROM TB_Information a JOIN TB_Hierarchy b ON a.TableID=b.TableID WHERE a.EmployeeID like "."'".$TrainerID."'"."";
		
      $connection= $ClassConnectionDB -> Open_connection(1);

      $execQuery=odbc_exec($connection, $SQLstring);
      if(!odbc_error($connection)){
      while(odbc_fetch_row($execQuery)){

      $InheritSup1=odbc_result($execQuery, odbc_field_name($execQuery, 1));;
      $InheritSup2=odbc_result($execQuery, odbc_field_name($execQuery, 2));;
      $InheritSup3=odbc_result($execQuery, odbc_field_name($execQuery, 3));;
      $InheritSup4=odbc_result($execQuery, odbc_field_name($execQuery, 4));;


      }

      }else{

      return 2;
           
      }
        
      $ClassConnectionDB -> Close_connection($connection);
        
  		if($whatTodo=="Insert"){


  			for($ace=0;$ace < count($agentEmpIds);$ace++){

  		
        	$connection= $ClassConnectionDB -> Open_connection(1);
			$SQLstring="SELECT a.HistoryRemarks FROM TB_State a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'". $agentEmpIds[$ace]."'"."";

			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$RemarksValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			

			}

		   $ClassConnectionDB -> Close_connection($connection);

		  
		   if($RemarksValue!="" && $RemarksValue!=null){
		   		  $NewRemarksValue=$RemarksValue."/";
		   }
		   


		   if($SQLcode==1){

		   $NewRemarksValue=$NewRemarksValue."OnTraining-".date('Y-m-d',strtotime($Data[3])).":".$Data[2].":".$Data[1].":".$Data[5].":LastUpdate-".date('Y-m-d h:m:s');
		  
		  //$SQLstring="UPDATE IRemarks SET IRemarks.HistoryRemarks=?,IRemarks.Process=?,IRemarks.Batch=?,IRemarks.TenureStatus=?,IRemarks.Billable=? FROM (SELECT a.EmployeeID,b.HistoryRemarks,a.Process,a.Batch,b.TenureStatus,b.Billable FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace]."'"."";
			
		   $connection= $ClassConnectionDB -> Open_connection(1);


		   $SQLstring="UPDATE IRemarks SET IRemarks.Process=?,IRemarks.Batch=? FROM (SELECT a.EmployeeID,a.Process,a.Batch FROM TB_Information a) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace]."'"."";

		    $Datavalue[0]=$Data[1];
		    $Datavalue[1]=$Data[5];
		 
		    
		 	
			$prepExec=odbc_prepare($connection,$SQLstring);
        	$execQuery=odbc_execute($prepExec,$Datavalue);

        	if(!odbc_error($connection)){
           	
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
           	
           	$ClassConnectionDB -> Close_connection($connection);
           	


           	$connection= $ClassConnectionDB -> Open_connection(1);

          	$SQLstring="UPDATE IRemarks SET IRemarks.Supervisor1=?,IRemarks.Supervisor2=?,IRemarks.Supervisor3=?,IRemarks.Supervisor4=?,IRemarks.Supervisor5=? FROM (SELECT a.EmployeeID,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5 FROM TB_Information a JOIN  TB_Hierarchy b ON a.TableID=b.TableID) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace]."'"."";

           

           $Datavalue[0]=$Data[2];
           $Datavalue[1]=$InheritSup1;
           $Datavalue[2]=$InheritSup2;
           $Datavalue[3]=$InheritSup3;
           $Datavalue[4]=$InheritSup4;

          $prepExec=odbc_prepare($connection,$SQLstring);

        	$execQuery=odbc_execute($prepExec,$Datavalue);

        	if(!odbc_error($connection)){
        		
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

          

		  }else if($SQLcode==2){

		  $NewRemarksValue=$NewRemarksValue."Nesting-".date('Y-m-d',strtotime($Data[3])).":".$Data[2].":".$Data[1].":".$Data[5].":LastUpdate-".date('Y-m-d h:m:s');
		  
		  //$SQLstring="UPDATE IRemarks SET IRemarks.HistoryRemarks=?,IRemarks.Process=?,IRemarks.Batch=?,IRemarks.TenureStatus=?,IRemarks.Billable=? FROM (SELECT a.EmployeeID,b.HistoryRemarks,a.Process,a.Batch,b.TenureStatus,b.Billable FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace]."'"."";
			
	
           	
        $ClassConnectionDB -> Close_connection($connection);

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
           	
           	$ClassConnectionDB -> Close_connection($connection);
           	
      
          }else{

          return 2;
           
          }

      

		 }else{


		 $NewRemarksValue=$NewRemarksValue."Live-".date('Y-m-d',strtotime($Data[3])).":".$Data[2].":".$Data[1].":".$Data[5].":LastUpdate-".date('Y-m-d h:m:s');
		  
		  //$SQLstring="UPDATE IRemarks SET IRemarks.HistoryRemarks=?,IRemarks.Process=?,IRemarks.Batch=?,IRemarks.TenureStatus=?,IRemarks.Billable=? FROM (SELECT a.EmployeeID,b.HistoryRemarks,a.Process,a.Batch,b.TenureStatus,b.Billable FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace]."'"."";


        $connection= $ClassConnectionDB -> Open_connection(1);

		    $SQLstring="UPDATE IRemarks SET IRemarks.HistoryRemarks=?,IRemarks.TenureStatus=?,IRemarks.Billable=? FROM (SELECT a.EmployeeID,b.HistoryRemarks,a.Process,a.Batch,b.TenureStatus,b.Billable FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace]."'"."";

		   $Datavalue[0]=$NewRemarksValue;
		   $Datavalue[1]="3";
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
           	
           	$ClassConnectionDB -> Close_connection($connection);
           	
           	$connection= $ClassConnectionDB -> Open_connection(1);

          	$SQLstring="UPDATE IRemarks SET IRemarks.Supervisor1=?,IRemarks.Supervisor2=?,IRemarks.Supervisor3=?,IRemarks.Supervisor4=?,IRemarks.Supervisor5=? FROM (SELECT a.EmployeeID,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5 FROM TB_Information a JOIN  TB_Hierarchy b ON a.TableID=b.TableID) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace]."'"."";

          

           $Datavalue[0]=$Data[2];
           $Datavalue[1]=$InheritSup1;
           $Datavalue[2]=$InheritSup2;
           $Datavalue[3]=$InheritSup3;
           $Datavalue[4]=$InheritSup4;


          $prepExec=odbc_prepare($connection,$SQLstring);

        	$execQuery=odbc_execute($prepExec,$Datavalue);

        	if(!odbc_error($connection)){

        	$ClassConnectionDB -> Close_connection($connection);
        	

        	}else{
        	
        	return 2;
        	
        	}

          

          }else{

          return 2;
           
          }


          

        }

      	}

        $connection= $ClassConnectionDB -> Open_connection(2);

       	 $SQLstring="UPDATE ".$getTrackingColumn[1]." SET Lock=1 WHERE TableID=".$getTrackingColumn[0]." AND UserEmpID like "."'".$_SESSION['EmployeeID']."%'"."";

        $execQuery=odbc_exec($connection, $SQLstring);

        if(!odbc_error($connection)){
       	
        $ClassConnectionDB -> Close_connection($connection);


        $connection= $ClassConnectionDB -> Open_connection(2);

        if($SQLcode==1){

          $SQLstring="SELECT TOP 1 EmployeeID,'1',TableID FROM TB_Endorsement_Training WHERE UserEmpID like "."'".$Data[0]."%'"." ORDER BY DateRequest DESC";

        }else if($SQLcode==2){
            
          $SQLstring="SELECT TOP 1 EmployeeID,'2',TableID FROM TB_Endorsement_Nesting WHERE UserEmpID like "."'".$Data[0]."%'"." ORDER BY DateRequest DESC";
        }else{

          $SQLstring="SELECT TOP 1 EmployeeID,'3',TableID FROM TB_Endorsement_Operation WHERE UserEmpID like "."'".$Data[0]."%'"." ORDER BY DateRequest DESC";
        }

      
        $getTrackingToInsert[]=null;

        $execQuery=odbc_exec($connection, $SQLstring);

        	 $getTrackingToInsert[0]=date('Y-m-d h:m:s');

      while(odbc_fetch_row($execQuery)){

				$getTrackingToInsert[1]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
				$getTrackingToInsert[2]=odbc_result($execQuery, odbc_field_name($execQuery, 2));
				$getTrackingToInsert[3]=odbc_result($execQuery, odbc_field_name($execQuery, 3));
			}

        $ClassConnectionDB -> Close_connection($connection);

        $SQLstring="INSERT INTO TB_EndorsementTracking (DateTimeStamp,UserEmpID,EndorsementID,LastTableID) VALUES (?,?,?,?)";

        $connection= $ClassConnectionDB -> Open_connection(3);


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

      $SQLstring="WITH T AS (SELECT TOP 1 * FROM TB_EndorsementTracking WHERE UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." ORDER BY DateTimeStamp DESC) DELETE FROM T";

      $connection= $ClassConnectionDB -> Open_connection(3);

      $execQuery=odbc_exec($connection, $SQLstring);

      if(!odbc_error($connection)){

      $ClassConnectionDB -> Close_connection($connection);

      for($ace2=0;$ace2 < count($agentEmpIds);$ace2++){

    

      //////////////////////////////////////////////////////////////////////////////////
      $connection= $ClassConnectionDB -> Open_connection(1);
			$SQLstring="SELECT a.HistoryRemarks FROM TB_State a JOIN TB_Information b ON a.TableID=b.TableID WHERE b.EmployeeID like "."'". $agentEmpIds[$ace2]."'"."";

			$execQuery=odbc_exec($connection, $SQLstring);

			while(odbc_fetch_row($execQuery)){

			$RemarksValue=odbc_result($execQuery, odbc_field_name($execQuery, 1));
			

			}

		  $ClassConnectionDB -> Close_connection($connection);

        $explodeRemarksVal=explode("/",$RemarksValue);

        $remarksPos=0;
       


		    for($a=0;$a < count ($explodeRemarksVal);$a++){

        if($SQLcode==1){

        if($explodeRemarksVal[$a]=="OnTraining-".date('Y-m-d',strtotime($LastEffectivedDate)).":".$LastTrainer.":".$LastProcess.":".$LastBatch.":LastUpdate-".date('Y-m-d h:m:s',strtotime($LastUpdate))){

         $remarksPos=$a;

        }

        }else if($SQLcode==2){

         if($explodeRemarksVal[$a]=="Nesting-".date('Y-m-d',strtotime($LastEffectivedDate)).":".$LastTrainer.":".$LastProcess.":".$LastBatch.":LastUpdate-".date('Y-m-d h:m:s',strtotime($LastUpdate))){

         $remarksPos=$a;

        }

        }else{

        if($explodeRemarksVal[$a]=="Live-".date('Y-m-d',strtotime($LastEffectivedDate)).":".$LastTrainer.":".$LastProcess.":".$LastBatch.":LastUpdate-".date('Y-m-d h:m:s',strtotime($LastUpdate))){

         $remarksPos=$a;

        }

        }

		 	 
		    
        }

    if(date('Y-m-d',strtotime($DataVal[3]))<=date('Y-m-d')){


      if($SQLcode==1){

      
       $connection= $ClassConnectionDB -> Open_connection(1);


       $SQLstring="UPDATE IRemarks SET IRemarks.Process=?,IRemarks.Batch=? FROM (SELECT a.EmployeeID,a.Process,a.Batch FROM TB_Information a) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace2]."'"."";

        $Datavalue[0]=$Data[1];
        $Datavalue[1]=$Data[5];
     
        
      
          $prepExec=odbc_prepare($connection,$SQLstring);
          $execQuery=odbc_execute($prepExec,$Datavalue);

          if(!odbc_error($connection)){
            
          $ClassConnectionDB -> Close_connection($connection);

           $connection= $ClassConnectionDB -> Open_connection(1);

        $SQLstring="UPDATE IRemarks SET IRemarks.HistoryRemarks=?,IRemarks.TenureStatus=?,IRemarks.Billable=? FROM (SELECT a.EmployeeID,b.HistoryRemarks,a.Process,a.Batch,b.TenureStatus,b.Billable FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace2]."'"."";


        for($i=0;$i < count ($explodeRemarksVal);$i++){

        if($i != $remarksPos){
      
        if($i==0){
        $Datavalue[0]=$explodeRemarksVal[$i];

        }else{
        $Datavalue[0]=$Datavalue[0]."/".$explodeRemarksVal[$i];
        }

        }
     
        }

        if( $Datavalue[0]!="" &&  $Datavalue[0]!=null){
          $Datavalue[0]=$Datavalue[0]."/";
        }

        
      $Datavalue[0]=$Datavalue[0]."OnTraining-".date('Y-m-d',strtotime($Data[3])).":".$Data[2].":".$Data[1].":".$Data[5].":LastUpdate-".date('Y-m-d h:m:s');
      

       
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
            
            $ClassConnectionDB -> Close_connection($connection);
            


            $connection= $ClassConnectionDB -> Open_connection(1);

            $SQLstring="UPDATE IRemarks SET IRemarks.Supervisor1=?,IRemarks.Supervisor2=?,IRemarks.Supervisor3=?,IRemarks.Supervisor4=?,IRemarks.Supervisor5=? FROM (SELECT a.EmployeeID,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5 FROM TB_Information a JOIN  TB_Hierarchy b ON a.TableID=b.TableID) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace2]."'"."";

           

           $Datavalue[0]=$Data[2];
           $Datavalue[1]=$InheritSup1;
           $Datavalue[2]=$InheritSup2;
           $Datavalue[3]=$InheritSup3;
           $Datavalue[4]=$InheritSup4;

          $prepExec=odbc_prepare($connection,$SQLstring);

          $execQuery=odbc_execute($prepExec,$Datavalue);

          if(!odbc_error($connection)){
            
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

          

      }else if($SQLcode==2){


  
            
        $ClassConnectionDB -> Close_connection($connection);

        $connection= $ClassConnectionDB -> Open_connection(1);

        $SQLstring="UPDATE IRemarks SET IRemarks.HistoryRemarks=?,IRemarks.TenureStatus=?,IRemarks.Billable=? FROM (SELECT a.EmployeeID,b.HistoryRemarks,a.Process,a.Batch,b.TenureStatus,b.Billable FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace2]."'"."";

          
        for($i=0;$i < count ($explodeRemarksVal);$i++){

        if($i != $remarksPos){
      
        if($i==0){
        $Datavalue[0]=$explodeRemarksVal[$i];

        }else{
        $Datavalue[0]=$Datavalue[0]."/".$explodeRemarksVal[$i];
        }

        }
     
        }

        if( $Datavalue[0]!="" &&  $Datavalue[0]!=null){
          $Datavalue[0]=$Datavalue[0]."/";
        }

       
    
      $Datavalue[0]=$Datavalue[0]."Nesting-".date('Y-m-d',strtotime($Data[3])).":".$Data[2].":".$Data[1].":".$Data[5].":LastUpdate-".date('Y-m-d h:m:s');
      


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
            
            $ClassConnectionDB -> Close_connection($connection);
            $returnVal=1;
      
          }else{

          return 2;
           
          }


        
           

     }else{


        $connection= $ClassConnectionDB -> Open_connection(1);

        $SQLstring="UPDATE IRemarks SET IRemarks.HistoryRemarks=?,IRemarks.TenureStatus=?,IRemarks.Billable=? FROM (SELECT a.EmployeeID,b.HistoryRemarks,a.Process,a.Batch,b.TenureStatus,b.Billable FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace2]."'"."";


        for($i=0;$i < count ($explodeRemarksVal);$i++){

        if($i != $remarksPos){
      
        if($i==0){
        $Datavalue[0]=$explodeRemarksVal[$i];

        }else{
        $Datavalue[0]=$Datavalue[0]."/".$explodeRemarksVal[$i];
        }

        }
     
        }

        if( $Datavalue[0]!="" &&  $Datavalue[0]!=null){
          $Datavalue[0]=$Datavalue[0]."/";
        }

        
        $Datavalue[0]=$Datavalue[0]."Live-".date('Y-m-d',strtotime($Data[3])).":".$Data[2].":".$Data[1].":".$Data[5].":LastUpdate-".date('Y-m-d h:m:s');
          
       
       $Datavalue[1]="3";
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
            
            $ClassConnectionDB -> Close_connection($connection);
            
            $connection= $ClassConnectionDB -> Open_connection(1);

            $SQLstring="UPDATE IRemarks SET IRemarks.Supervisor1=?,IRemarks.Supervisor2=?,IRemarks.Supervisor3=?,IRemarks.Supervisor4=?,IRemarks.Supervisor5=? FROM (SELECT a.EmployeeID,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5 FROM TB_Information a JOIN  TB_Hierarchy b ON a.TableID=b.TableID) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace2]."'"."";

           $Datavalue[]=null;

           $Datavalue[0]=$Data[2];
           $Datavalue[1]=$InheritSup1;
           $Datavalue[2]=$InheritSup2;
           $Datavalue[3]=$InheritSup3;
           $Datavalue[4]=$InheritSup4;


          $prepExec=odbc_prepare($connection,$SQLstring);

          $execQuery=odbc_execute($prepExec,$Datavalue);

          if(!odbc_error($connection)){

          $ClassConnectionDB -> Close_connection($connection);
          $returnVal=1;

          }else{
          
          return 2;
          
          }

          

          }else{

          return 2;
           
          }


          

        }


        }if(date('Y-m-d',strtotime($DataVal[3])) > date('Y-m-d')){

     

          $getLastInfoOfEMployee[]=null;

      

            $connection= $ClassConnectionDB -> Open_connection(5);

            $SQLstrin="SELECT a.Process,a.Batch,b.TenureStatus,b.HistoryRemarks,b.Billable,c.Supervisor1,c.Supervisor2,c.Supervisor3,c.Supervisor4,c.Supervisor5 FROM TB_Information a JOIN TB_State b ON a.TableID=b.TableID JOIN TB_Hierarchy c ON a.TableID=c.TableID WHERE a.EmployeeID like "."'".$agentEmpIds[$ace2]."'"."";

            $execQuery=odbc_exec($connection, $SQLstring);

            while(odbc_fetch_row($execQuery)){

            $getLastInfoOfEMployee[0]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
            $getLastInfoOfEMployee[1]=odbc_result($execQuery, odbc_field_name($execQuery, 2));
            $getLastInfoOfEMployee[2]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
            $getLastInfoOfEMployee[3]=odbc_result($execQuery, odbc_field_name($execQuery, 2));
            $getLastInfoOfEMployee[4]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
            $getLastInfoOfEMployee[5]=odbc_result($execQuery, odbc_field_name($execQuery, 2));
            $getLastInfoOfEMployee[6]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
            $getLastInfoOfEMployee[7]=odbc_result($execQuery, odbc_field_name($execQuery, 2));
            $getLastInfoOfEMployee[8]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
            $getLastInfoOfEMployee[9]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
        
        
            }

      $ClassConnectionDB -> Close_connection($connection);

      $connection= $ClassConnectionDB -> Open_connection(1);


       $SQLstring="UPDATE IRemarks SET IRemarks.Process=?,IRemarks.Batch=? FROM (SELECT a.EmployeeID,a.Process,a.Batch FROM TB_Information a) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace2]."'"."";

        $Datavalue[0]=$getLastInfoOfEMployee[0];
        $Datavalue[1]=$getLastInfoOfEMployee[1];
     
        
      
          $prepExec=odbc_prepare($connection,$SQLstring);
          $execQuery=odbc_execute($prepExec,$Datavalue);

          if(!odbc_error($connection)){
            
          $ClassConnectionDB -> Close_connection($connection);

           $connection= $ClassConnectionDB -> Open_connection(1);

        $SQLstring="UPDATE IRemarks SET IRemarks.HistoryRemarks=?,IRemarks.TenureStatus=?,IRemarks.Billable=? FROM (SELECT a.EmployeeID,b.HistoryRemarks,a.Process,a.Batch,b.TenureStatus,b.Billable FROM TB_Information a JOIN  TB_State b ON a.TableID=b.TableID) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace2]."'"."";


      
          $Datavalue[0]=$getLastInfoOfEMployee[3]
          $Datavalue[1]=$getLastInfoOfEMployee[2];
          $Datavalue[2]=$getLastInfoOfEMployee[4];
      
        
          $prepExec=odbc_prepare($connection,$SQLstring);
      
    
          $execQuery=odbc_execute($prepExec,$Datavalue);

          if(!odbc_error($connection)){
            
            $ClassConnectionDB -> Close_connection($connection);
            


          $connection= $ClassConnectionDB -> Open_connection(1);

          $SQLstring="UPDATE IRemarks SET IRemarks.Supervisor1=?,IRemarks.Supervisor2=?,IRemarks.Supervisor3=?,IRemarks.Supervisor4=?,IRemarks.Supervisor5=? FROM (SELECT a.EmployeeID,b.Supervisor1,b.Supervisor2,b.Supervisor3,b.Supervisor4,b.Supervisor5 FROM TB_Information a JOIN  TB_Hierarchy b ON a.TableID=b.TableID) as IRemarks WHERE IRemarks.EmployeeID like "."'".$agentEmpIds[$ace2]."'"."";

          

           $Datavalue[0]=$getLastInfoOfEMployee[5];
           $Datavalue[1]=$getLastInfoOfEMployee[6];
           $Datavalue[2]=$getLastInfoOfEMployee[7];
           $Datavalue[3]=$getLastInfoOfEMployee[8];
           $Datavalue[4]=$getLastInfoOfEMployee[9];

          $prepExec=odbc_prepare($connection,$SQLstring);

          $execQuery=odbc_execute($prepExec,$Datavalue);

          if(!odbc_error($connection)){
            
          $ClassConnectionDB -> Close_connection($connection);
          
          $connection= $ClassConnectionDB -> Open_connection(3);
          
          $SQLstring="SELECT TOP 1 a.LastTableID,b.Table_Name FROM TB_EndorsementTracking a JOIN TB_TableLinkEndorsement b ON a.StatusID=b.Stat_Num WHERE a.UserEmpID like "."'".$_SESSION['EmployeeID']."%'"." ORDER BY DateTimeStamp DESC";

         while(odbc_fetch_row($execQuery)){

         $getTrackingColumn[0]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
         $getTrackingColumn[1]=odbc_result($execQuery, odbc_field_name($execQuery, 2));

         }

         $ClassConnectionDB -> Close_connection($connection);

         $connection= $ClassConnectionDB -> Open_connection(2);

         $SQLstring="UPDATE ".$getTrackingColumn[1]." SET Lock=0 WHERE TableID=".$getTrackingColumn[0]." AND UserEmpID like "."'".$_SESSION['EmployeeID']."%'"."";
         
         $execQuery=odbc_exec($connection, $SQLstring);

          if(!odbc_error($connection)){

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

          return 2;
           
          }




        }


    	}

     }else{
          
      return 2;

     }

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

        	 $SQLstring="UPDATE ".$getTrackingColumn[1]." SET Lock=1 WHERE TableID=".$getTrackingColumn[0]." AND EmployeeID like "."'".$Data[0]."'"."";


        	 $execQuery=odbc_exec($connection, $SQLstring);

        	  if(!odbc_error($connection)){
        	 
        	 $ClassConnectionDB -> Close_connection($connection);

        	 $connection= $ClassConnectionDB -> Open_connection(2);

        	 $SQLstring="SELECT TOP 1 EmployeeID,StatusCode,TableID FROM TB_Air_Notification WHERE EmployeeID like "."'".$Data[0]."'"." ORDER BY DateRequest DESC";


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

		 	if($explodeRemarksVal[$a]==$Data[6].":".date('Y-m-d',strtotime($LastEffectivedDate)).":LastUpdate-".date('Y-m-d h:m:s',strtotime($LastUpdate))){

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
		 	$Datavalue[0]=$Datavalue[0]."/".$explodeRemarksVal[$i];
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
		 	$Datavalue[2]=$Datavalue[2]."/".$explodeRemarksVal[$i];
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

        	 $SQLstring="UPDATE ".$getTrackingColumn2[1]." SET Lock=0 WHERE TableID=".$getTrackingColumn2[0]." AND EmployeeID like "."'".$Data[0]."'"."";


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

        	 $SQLstring="UPDATE ".$getTrackingColumn[1]." SET Lock=1 WHERE TableID=".$getTrackingColumn[0]." AND EmployeeID like "."'".$Data[0]."'"."";

        	 $execQuery=odbc_exec($connection, $SQLstring);

        	  if(!odbc_error($connection)){
        	 
        	 $ClassConnectionDB -> Close_connection($connection);

        	 $connection= $ClassConnectionDB -> Open_connection(2);

        	 $SQLstring="SELECT TOP 1 EmployeeID,TableID FROM TB_BackToWork_Notification WHERE EmployeeID like "."'".$Data[0]."'"." ORDER BY DateRequest DESC";


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

		 	 if($explodeRemarksVal[$a]=="Back to work:".date('Y-m-d',strtotime($LastEffectivedDate)).":LastUpdate-".date('Y-m-d h:m:s',strtotime($LastUpdate))){

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
		 	$Datavalue[0]=$Datavalue[0]."/".$explodeRemarksVal[$i];
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
		 	$Datavalue[2]=$Datavalue[2]."/".$explodeRemarksVal[$i];
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

        	 $SQLstring="UPDATE ".$getTrackingColumn2[1]." SET Lock=0 WHERE TableID=".$getTrackingColumn2[0]." AND EmployeeID like "."'".$Data[0]."'"."";


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


function autoseperationUpdateInfo($Data,$statcode,$whatTodo){



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

        	 $SQLstring="UPDATE ".$getTrackingColumn[1]." SET Lock=1 WHERE TableID=".$getTrackingColumn[0]." AND EmployeeID like "."'".$Data[0]."'"."";


        	 $execQuery=odbc_exec($connection, $SQLstring);

        	  if(!odbc_error($connection)){
        	 
        	 $ClassConnectionDB -> Close_connection($connection);
        	 
        	 $connection= $ClassConnectionDB -> Open_connection(2);

        	 $SQLstring="SELECT TOP 1 EmployeeID,StatusCode,TableID FROM TB_autoSeparate_Notification WHERE EmployeeID like "."'".$Data[0]."'"." ORDER BY DateRequest DESC";


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

		 	if($explodeRemarksVal[$a]==$Data[6].":".date('Y-m-d',strtotime($LastEffectivedDate)).":LastUpdate-".date('Y-m-d h:m:s',strtotime($LastUpdate))){

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
		 	$Datavalue[0]=$Datavalue[0]."/".$explodeRemarksVal[$i];
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
		 	$Datavalue[2]=$Datavalue[2]."/".$explodeRemarksVal[$i];
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

        	 $SQLstring="UPDATE ".$getTrackingColumn2[1]." SET Lock=0 WHERE TableID=".$getTrackingColumn2[0]." AND EmployeeID like "."'".$Data[0]."'"."";


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



function ResignationUpdateInfo($Data,$whatTodo){

	

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

        	 $SQLstring="UPDATE ".$getTrackingColumn[1]." SET Lock=1 WHERE TableID=".$getTrackingColumn[0]." AND EmployeeID like "."'".$Data[0]."'"."";


        	 $execQuery=odbc_exec($connection, $SQLstring);

        	  if(!odbc_error($connection)){
        	 
        	 $ClassConnectionDB -> Close_connection($connection);

        	 $connection= $ClassConnectionDB -> Open_connection(2);

        	 $SQLstring="SELECT TOP 1 EmployeeID,StatusCode,TableID FROM TB_Resignation_Notification WHERE EmployeeID like "."'".$Data[0]."'"." ORDER BY DateRequest DESC";


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

		 	if($explodeRemarksVal[$a]=="Resigned:".date('Y-m-d',strtotime($LastEffectivedDate)).":LastUpdate-".date('Y-m-d h:m:s',strtotime($LastUpdate))){

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
		 	$Datavalue[0]=$Datavalue[0]."/".$explodeRemarksVal[$i];
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
		 	$Datavalue[2]=$Datavalue[2]."/".$explodeRemarksVal[$i];
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

        	 $SQLstring="UPDATE ".$getTrackingColumn2[1]." SET Lock=0 WHERE TableID=".$getTrackingColumn2[0]." AND EmployeeID like "."'".$Data[0]."'"."";


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