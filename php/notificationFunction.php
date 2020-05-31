<?php



include "database_engine.php";
include "UpdateInfoClass.php";

session_start();

$functionNumber=$_POST['functionNumber'];

switch ($functionNumber) {
case 1:
ResignationLedgerCheckExisted($_POST['EmpIDforNotif'],$_POST['StatuscategoryResig']);
break;
case 2:
 $_SESSION['successfullySave']=ResignationSaving($_POST['ArrayValResig'],$_POST['ToUpdateRef'],$_POST['WhatTodo']);
break;
case 3:
AutoSeparatedCheckExisted($_POST['AutoEmpID'],$_POST['Statuscategory']);
break;
case 4:
 $_SESSION['successfullySave']=AutoSeparatedSaving($_POST['ArrayValAuto'],$_POST['ToUpdateRefAuto'],$_POST['WhatTodoAuto']);
break;
case 5:
validationIfSuccessfullySavedResignation();
break;
case 6:
CheckbackToWrokStatusHistory($_POST['bcktoWorkempID']);
break;
case 7:
backtoworkSaving($_POST['ArrayValRtrn'],$_POST['WhatTodoRtrn']);
break;
case 8:
checkAir($_POST['airSelectionVal'],$_POST['airEmpID']);
break;
case 9:
savingAir($_POST['airDataVal'],$_POST['airToUpdateRef'],$_POST['airWhatTodo']);
break;
}

function ResignationLedgerCheckExisted($EmployeeID,$Statuscategory){

try{
$ClassConnection=new DB_Connection();
$connection= $ClassConnection -> Open_connection(1);

$SQLstring="";




	$SQLstring="SELECT * FROM TB_Information a JOIN TB_State b ON a.TableID=b.TableID WHERE a.EmployeeID like "."'".$EmployeeID."'"." AND b.CurrentStatus like "."'".$Statuscategory."'"."";

	 $alreadyThisStatus=false;


	$execQuery=odbc_exec($connection, $SQLstring);

     While(odbc_fetch_row($execQuery)){
     
         $alreadyThisStatus=true;
     }

      $returnVal=0;

     if( $alreadyThisStatus){
          $returnVal=1;
     }

    echo json_encode($returnVal);   
    $ClassConnection -> Close_connection($connection); 

}catch(Exception $e){

       
}


}


function AutoSeparatedCheckExisted($EmployeeID,$Statuscategory){

try{

$ClassConnection=new DB_Connection();
$connection= $ClassConnection -> Open_connection(1);



$SQLstring="SELECT * FROM TB_Information a JOIN TB_State b ON a.TableID=b.TableID WHERE a.EmployeeID like "."'".$EmployeeID."'"." AND b.CurrentStatus like "."'".$Statuscategory."'"."";
    
    $alreadyThisStatus=false;

    
    $execQuery=odbc_exec($connection, $SQLstring);

     while(odbc_fetch_row($execQuery)){
     
        $alreadyThisStatus=true;


     }

     $returnVal=0;

     if( $alreadyThisStatus){
          $returnVal=1;
     }


    echo json_encode($returnVal);   
    $ClassConnection -> Close_connection($connection); 

}catch(Exception $e){
       
}

}


function ResignationSaving($DataVal,$Ref,$whatTodo){

   

    $ClassConnection=new DB_Connection();
    $UpdateInfo=new UpdateInfo_Engine();
    $returnVal=0;
    $SQLstring="";
   

        $setValue[]=null;


        if($whatTodo=="Insert"){


            $Validationconnection= $ClassConnection -> Open_connection(2);

            $SQLstring="SELECT * FROM TB_Resignation_Notification WHERE EmployeeID like "."'".$DataVal[0]."'"." AND Date_Received="."'".date('Y-m-d',strtotime($DataVal[4]))."'"." AND EffectiveDate="."'".date('Y-m-d',strtotime($DataVal[6]))."'"."";

            $AlreadyExist=false;

           
            
            $Query=odbc_exec($Validationconnection, $SQLstring);

            if(!odbc_error($Validationconnection)){

            while(odbc_fetch_row($Query)){$AlreadyExist=true;}

            }else{

                return 0;
            }
            $ClassConnection -> Close_connection($Validationconnection);  
            

            
            if(!$AlreadyExist){


            $connection= $ClassConnection -> Open_connection(2);

            if($connection){


            $SQLstring="INSERT INTO TB_Resignation_Notification (DateRequest,EmployeeID,Date_Received,LWD,EffectiveDate,SenderEmpID,Remarks,RenderingPeriod,RehireRecom,LastUpdate,Lock) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
            

            $setValue[0]=date('Y-m-d h:m:s');
            $setValue[1]=$DataVal[0];
            $setValue[2]=date('Y-m-d',strtotime($DataVal[4]));
            $setValue[3]=date('Y-m-d',strtotime($DataVal[5]));
            $setValue[4]=date('Y-m-d',strtotime($DataVal[6]));
            $setValue[5]=$_SESSION['EmployeeID'];
            $setValue[6]=$DataVal[7];
            $setValue[7]=$DataVal[8];
            $setValue[8]=$DataVal[9];
            $datetimeNowVal=date('Y-m-d h:m:s');
            
            $setValue[9]=$datetimeNowVal;
            $setValue[10]="0";
            
           
        $prepExec=odbc_prepare($connection,$SQLstring);

        $execQuery=odbc_execute($prepExec,$setValue);

        if(!odbc_error($connection)){

        $rowAffected=@odbc_num_rows($prepExec);
        
        if( $rowAffected > 0){

         if(date('Y-m-d',strtotime($DataVal[6]))===date('Y-m-d')){
             $returnVal= $UpdateInfo -> ResignationUpdateInfo($Data);
        }else{
            $returnVal=1;
        }
        
        }else{
            return 0;
        }

        }else{
            return 0;
        }
       
    
        $ClassConnection -> Close_connection($connection); 
        }
         
        }else{
        
            return 3;

        }
                 
        }else if($whatTodo=="Update"){
        
        $connection= $ClassConnection -> Open_connection(2);

         if($connection){    
            $SQLstring="UPDATE TB_Resignation_Notification SET Date_Received=?,LWD=?,EffectiveDate=?,SenderEmpID=?,Remarks=?,RenderingPeriod=?,RehireRecom=?,LastUpdate=? WHERE EmployeeID like "."'".$DataVal[0]."'"." AND Date_Received="."'".date('Y-m-d',strtotime($Ref[0]))."'"." AND EffectiveDate="."'".date('Y-m-d',strtotime($Ref[2]))."'"."";
           
            
            $setValue[0]=date('Y-m-d',strtotime($DataVal[4]));
            $setValue[1]=date('Y-m-d',strtotime($DataVal[5]));
            $setValue[2]=date('Y-m-d',strtotime($DataVal[6]));
            if($Ref[7] != $_SESSION['EmployeeID']){$setValue[3]=$Ref[7]."/".$_SESSION['EmployeeID'];}else{$setValue[3]=$Ref[7];} 
            $setValue[4]=$DataVal[7];
            $setValue[5]=$DataVal[8];
            $setValue[6]=$DataVal[9];
            $datetimeNowVal=date('Y-m-d h:m:s');
            
            $setValue[7]=$datetimeNowVal;
           
        $prepExec=odbc_prepare($connection,$SQLstring);

        $execQuery=odbc_execute($prepExec,$setValue);
        if(!odbc_error($connection)){

        $rowAffected=@odbc_num_rows($prepExec);
        
        if( $rowAffected > 0){

            $returnVal=1;
            
        }else{
           return 0;
        }

        }else{
           return 0;
        }
       
        
        $ClassConnection -> Close_connection($connection); 
        }

        } 

        return  $returnVal;
   
}


function AutoSeparatedSaving($DataVal,$Ref,$whatTodo){

 

$ClassConnection=new DB_Connection();
$UpdateInfo=new UpdateInfo_Engine();
$returnVal=0;

    $SQLstring="";
    

        $setValue[]=null;


          $Validationconnection= $ClassConnection -> Open_connection(1);

             $SQLstring="SELECT Stat_Num FROM TB_Status WHERE Stat_Remarks like "."'".$DataVal[6]."'"."";

            $Query=odbc_exec($Validationconnection, $SQLstring);
             if(!odbc_error($Validationconnection)){
            while(odbc_fetch_row($Query)){$statCode=odbc_result($execQuery, odbc_field_name($execQuery, 1));}
            }else{
            return 0;
            }
            $ClassConnection -> Close_connection($Validationconnection);  

        if($whatTodo=="Insert"){

            $Validationconnection= $ClassConnection -> Open_connection(2);

            $SQLstring="SELECT * FROM TB_autoSeparate_Notification WHERE EmployeeID like "."'".$DataVal[0]."'"." AND LWD="."'".date('Y-m-d',strtotime($DataVal[4]))."'"." AND EffectiveDate="."'".date('Y-m-d',strtotime($DataVal[5]))."'"." AND StatusCode=".$statCode."";

            $AlreadyExist=false;

            $Query=odbc_exec($Validationconnection, $SQLstring);
            if(!odbc_error($Validationconnection)){
            while(odbc_fetch_row($Query)){$AlreadyExist=true;}
            }else{
            return 0;
            }
            $ClassConnection -> Close_connection($Validationconnection);  

            if(!$AlreadyExist){

            $connection= $ClassConnection -> Open_connection(2);

            if($connection){
            $SQLstring="INSERT INTO TB_autoSeparate_Notification (DateRequest,EmployeeID,LWD,EffectiveDate,SenderEmpID,StatusCode,Remarks,LastUpdate,Lock) VALUES(?,?,?,?,?,?,?,?,?)";

            $setValue[0]=date('Y-m-d h:m:s');
            $setValue[1]=$DataVal[0];
            $setValue[2]=date('Y-m-d',strtotime($DataVal[4]));
            $setValue[3]=date('Y-m-d',strtotime($DataVal[5]));
            $setValue[4]=$_SESSION['EmployeeID'];
            $setValue[5]=$statCode;
            $setValue[6]=$DataVal[7];
            $datetimeNowVal=date('Y-m-d h:m:s');
            
            $setValue[7]=$datetimeNowVal;
            $setValue[8]="0";
            
             
        $prepExec=odbc_prepare($connection,$SQLstring);

        $execQuery=odbc_execute($prepExec,$setValue);
        
        if(!odbc_error($connection)){

        $rowAffected=@odbc_num_rows($prepExec);
        
        if( $rowAffected > 0){

        if(date('Y-m-d',strtotime($DataVal[5]))===date('Y-m-d')){
             $returnVal=$UpdateInfo -> autoseperationUpdateInfo($DataVal,$statCode);
        
        }else{
            $returnVal=1;
        }

        }else{

           return 0;
        }

          

        }else{

           return 0;
        }
        
       
        $ClassConnection -> Close_connection($connection); 
        }
         
        }else{
           return 3; 
        }
                 
        }else if($whatTodo=="Update"){

        $connection= $ClassConnection -> Open_connection(2);
        
         if($connection){    
            $SQLstring="UPDATE TB_autoSeparate_Notification SET LWD=?,EffectiveDate=?,SenderEmpID=?,Remarks=?,LastUpdate=? WHERE EmployeeID like "."'".$DataVal[0]."'"." AND LWD="."'".date('Y-m-d',strtotime($Ref[0]))."'"." AND EffectiveDate="."'".date('Y-m-d',strtotime($Ref[1]))."'"." AND StatusCode=".$statCode." AND Remarks like "."'".$DataVal[6]."'"."";
           
            
            $setValue[0]=date('Y-m-d',strtotime($DataVal[4]));
            $setValue[1]=date('Y-m-d',strtotime($DataVal[5]));
            if($Ref[2] != $_SESSION['EmployeeID']){$setValue[2]=$Ref[2]."/".$_SESSION['EmployeeID'];}else{$setValue[2]=$Ref[2];} 
            $setValue[3]=$DataVal[7];
            $datetimeNowVal=date('Y-m-d h:m:s');
            
            $setValue[4]=$datetimeNowVal;
           

         $prepExec=odbc_prepare($connection,$SQLstring);

         $execQuery=odbc_execute($prepExec,$setValue);

        if(!odbc_error($connection)){

        $rowAffected=@odbc_num_rows($prepExec);
        
        if( $rowAffected > 0){

         
            $returnVal=1;
            

        }else{
            return 0;
        }

          

        }else{
            return 0;  
        }
        
       
      
       
        $ClassConnection -> Close_connection($connection);     
       
        }

        } 

        return $returnVal;

}


function CheckbackToWrokStatusHistory($EmployeeID){

try{

$ClassConnection=new DB_Connection();

$connection= $ClassConnection -> Open_connection(1);

  $SQLstring="";
  $ifActiveString="";

  if($connection){

    $SQLstring="SELECT c.Stat_Category FROM TB_Information a JOIN TB_State b ON a.TableID=b.TableID JOIN TB_Status c ON b.CurrentStatus=c.Stat_Remarks WHERE a.EmployeeID like "."'".$EmployeeID."'"."";

    $IfActive=false;


    $execQuery=odbc_exec($connection, $SQLstring);


     while(odbc_fetch_row($execQuery)){
     
    $ifActiveString=odbc_result($execQuery, odbc_field_name($execQuery, 1));
    
     }

   
    $ClassConnection -> Close_connection($connection); 




    if($ifActiveString=="Active" ){

    echo json_encode(0);
  
    }else if($ifActiveString=="Separated"){

     echo json_encode(1);

    }else{

        
        
        if($ifActiveString=="Leave of absences" || $ifActiveString=="AWOL"){

            $connection= $ClassConnection -> Open_connection(2);
            
            $dataValue[]=null;


            if($connection){

                $SQLstring="SELECT a.EffectiveDate,b.Stat_Remarks FROM TB_Air_Notification a JOIN DB_Employee_Management_System.dbo.TB_Status b ON b.Stat_Num=a.RquestIssuance WHERE EmployeeID like "."'".$EmployeeID."'"." ORDER BY a.LastUpdate ASC";

                 $execQuery=odbc_exec($connection, $SQLstring);


                while(odbc_fetch_row($execQuery)){
     
                $dataValue[0]=odbc_result($execQuery, odbc_field_name($execQuery, 1));
                $dataValue[1]=odbc_result($execQuery, odbc_field_name($execQuery, 2));
    
                }

                echo json_encode($dataValue);
                $ClassConnection -> Close_connection($connection); 

            }


        }else if($ifActiveString=="Leave with Pay"){

            
        }

    }

}


 }catch(Exception $e){
       echo json_encode(2);
}


}


function backtoworkSaving($DataVal,$whatTodo){


    $ClassConnection=new DB_Connection();
   

    $SQLstring="";
    $returnVal=0;


        $setValue[]=null;


        if($whatTodo=="Insert"){


            $Validationconnection= $ClassConnection -> Open_connection(2);

            $SQLstring="SELECT * FROM TB_BackToWork_Notification WHERE EmployeeID like "."'".$DataVal[0]."'"." AND Remarks like "."'".$DataVal[7]."'"." AND ReturnDate="."'".date('Y-m-d',strtotime($DataVal[6]))."'"."";

            $AlreadyExist=false;

           
            
            $Query=odbc_exec($Validationconnection, $SQLstring);
            if(!odbc_error($Validationconnection)){
            while(odbc_fetch_row($Query)){$AlreadyExist=true;}
            }else{
                return 0; 
            }
            $ClassConnection -> Close_connection($Validationconnection);  
            

            
            if(!$AlreadyExist){


            $connection= $ClassConnection -> Open_connection(2);

            if($connection){


            $SQLstring="INSERT INTO TB_BackToWork_Notification (DateRequest,EmployeeID,ReturnDate,SenderEmpID,Remarks,LastUpdate,Lock) VALUES(?,?,?,?,?,?,?)";
            

            $setValue[0]=date('Y-m-d h:m:s');
            $setValue[1]=$DataVal[0];
            $setValue[2]=date('Y-m-d',strtotime($DataVal[6]));
            $setValue[3]=$_SESSION['EmployeeID'];
            $setValue[4]=$DataVal[7];  
            $datetimeNowVal=date('Y-m-d h:m:s');
            $setValue[5]=$datetimeNowVal;
            $setValue[6]="0";
            
           
        $prepExec=odbc_prepare($connection,$SQLstring);
        $execQuery=odbc_execute($prepExec,$setValue);
            
            if(!odbc_error($connection)){

                $rowAffected=@odbc_num_rows($prepExec);
               
                if( $rowAffected > 0){

                if(date('Y-m-d',strtotime($DataVal[6]))===date('Y-m-d')){

                $UpdateInfo=new UpdateInfo_Engine();

                $returnVal=$UpdateInfo -> btwUpdateInfo($DataVal);
                
                }else{
                $returnVal=1;
                }

                }else{
                return 0;
                }
       
            }else{
                return 0;
            }

            
       

      
    
        $ClassConnection -> Close_connection($connection); 
        }
         
        }else{

            return 3;
        }
                 

        } 

  
        return $returnVal;

}


function checkAir($Prolonged,$empID){

 $ClassConnection=new DB_Connection();
 

    $SQLstring="";
    $dataValue[]=null;

    $connection= $ClassConnection -> Open_connection(1);  

        $SQLstring="SELECT * FROM TB_Information a JOIN TB_State b ON a.TableID=b.TableID WHERE a.EmployeeID like "."'".$empID."'"." AND b.CurrentStatus like "."'".$Prolonged."'"."";

       

        $HaveData=false;

         $execQuery=odbc_exec($connection, $SQLstring);

          while(odbc_fetch_row($execQuery)){
     
         
                 $HaveData=true;
            }

       

                $resultVal=0;

                if($HaveData){
                
                $resultVal=1;

                }

        echo json_encode($resultVal);
        $ClassConnection -> Close_connection($connection);           
                


     

}

function savingAir($DataVal,$Ref,$whatTodo){

  
    $ClassConnection=new DB_Connection();
    

    $SQLstring="";
    $returnVal=0;

    $UpdateInfo=new UpdateInfo_Engine();

        $setValue[]=null;



        $statCode="";
             
            $connection= $ClassConnection -> Open_connection(1);

            if($connection){

                $SQLstring="SELECT Stat_Num FROM TB_Status WHERE Stat_Remarks like "."'".$DataVal[6]."'"."";
                $execQuery=odbc_exec($connection, $SQLstring);
                 if(!odbc_error($connection)){
                while(odbc_fetch_row($execQuery)){$statCode=odbc_result($execQuery, odbc_field_name($execQuery, 1));}
                }else{
                return 0;
                }
                $ClassConnection -> Close_connection($connection);  

            }

        if($whatTodo=="Insert"){


            $Validationconnection= $ClassConnection -> Open_connection(2);

            $SQLstring="SELECT * FROM TB_Air_Notification a JOIN DB_Employee_Management_System.dbo.TB_Status b ON a.RquestIssuance=b.Stat_Num WHERE a.EmployeeID like "."'".$DataVal[0]."'"." AND a.EffectiveDate="."'".date('Y-m-d',strtotime($DataVal[8]))."'"." AND b.Stat_Remarks like "."'".$DataVal[6]."'"." ORDER BY a.LastUpdate ASC";

            $AlreadyExist=false;

    
            $Query=odbc_exec($Validationconnection, $SQLstring);
            if(!odbc_error($Validationconnection)){
            while(odbc_fetch_row($Query)){$AlreadyExist=true;}
            }else{
            return 0;
            }
            $ClassConnection -> Close_connection($Validationconnection);  
            

            
            if(!$AlreadyExist){

            $connection= $ClassConnection -> Open_connection(2);

            if($connection){

            
            $SQLstring="INSERT INTO TB_Air_Notification (DateRequest,EmployeeID,Address,Contact_Num,RquestIssuance,LWD,EffectiveDate,ExpectedBacktoWork,lastTimeCom,actionTaken,SenderEmpID,Remarks,forMLtype,forMLNodonate,LastUpdate,Lock) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
         
            if($DataVal[6]=="Maternity Leave"){

            $setValue[0]=date('Y-m-d h:m:s');
            $setValue[1]=$DataVal[0];
            $setValue[2]=$DataVal[4];
            $setValue[3]=$DataVal[5];
            $setValue[4]=$statCode;
            $setValue[5]=date('Y-m-d',strtotime($DataVal[7]));
            $setValue[6]=date('Y-m-d',strtotime($DataVal[8]));
            $setValue[7]=date('Y-m-d',strtotime($DataVal[9]));
            $setValue[8]=$DataVal[10];
            $setValue[9]=$DataVal[11];
            $setValue[10]=$_SESSION['EmployeeID'];
            $setValue[11]=$DataVal[12];
            $MLcode="";
            if($DataVal[13]=="Normal"){$MLcode="1";}else if($DataVal[13]=="Cesarean Section"){$MLcode="2";}else{$MLcode="3";}
            $setValue[12]=$MLcode;
            $setValue[13]=$DataVal[14];
            $setValue[14]=date('Y-m-d h:m:s');
            $setValue[15]="0";

            }else if($DataVal[6]=="Request for RTWO"){

            $setValue[0]=date('Y-m-d h:m:s');
            $setValue[1]=$DataVal[0];
            $setValue[2]=$DataVal[4];
            $setValue[3]=$DataVal[5];
            $setValue[4]=$statCode;
            $setValue[5]=date('Y-m-d',strtotime($DataVal[7]));
            $setValue[6]=date('Y-m-d',strtotime($DataVal[8]));
            $setValue[7]=null;
            $setValue[8]=$DataVal[10];
            $setValue[9]=$DataVal[11];
            $setValue[10]=$_SESSION['EmployeeID'];
            $setValue[11]=$DataVal[12];  
            $setValue[12]=null;
            $setValue[13]=null;
            $setValue[14]=date('Y-m-d h:m:s');
            $setValue[15]="0";


            }else{

            $setValue[0]=date('Y-m-d h:m:s');
            $setValue[1]=$DataVal[0];
            $setValue[2]=$DataVal[4];
            $setValue[3]=$DataVal[5];
            $setValue[4]=$statCode;
            $setValue[5]=date('Y-m-d',strtotime($DataVal[7]));
            $setValue[6]=date('Y-m-d',strtotime($DataVal[8]));
            $setValue[7]=date('Y-m-d',strtotime($DataVal[9]));
            $setValue[8]=$DataVal[10];
            $setValue[9]=$DataVal[11];
            $setValue[10]=$_SESSION['EmployeeID'];
            $setValue[11]=$DataVal[12];  
            $setValue[12]=null;
            $setValue[13]=null;
            $setValue[14]=date('Y-m-d h:m:s');
            $setValue[15]="0";


            }

            
           
             $prepExec=odbc_prepare($connection,$SQLstring);
       
             $execQuery=odbc_execute($prepExec,$setValue);

            if(!odbc_error($connection)){
                $rowAffected=@odbc_num_rows($prepExec);


            if( $rowAffected > 0){
          
            
            if(date('Y-m-d',strtotime($DataVal[8]))===date('Y-m-d')){


                 $returnVal=$UpdateInfo -> AirUpdateInfo($DataVal,$statCode);
            }else{
                   $returnVal=1;
            }

        }else{

           return 0;
        }
       
         }else{

           return 0;

        }
      
    
        $ClassConnection -> Close_connection($connection); 
        }
         
        }else{

           return 3;
        }
                 
        }else if($whatTodo=="Update"){

            $connection= $ClassConnection -> Open_connection(2);
         if($connection){    
            $SQLstring="UPDATE TB_Air_Notification SET Address=?,Contact_Num=?,LWD=?,EffectiveDate=?,ExpectedBacktoWork=?,lastTimeCom=?,actionTaken=?,SenderEmpID=?,Remarks=?,forMLtype=?,forMLNodonate=?,LastUpdate=? WHERE EmployeeID like "."'".$DataVal[0]."'"." AND LastUpdate="."'".$Ref[1]."'"." AND RquestIssuance=".$statCode."";
           
         
           

            if($DataVal[6]=="Maternity Leave"){

            $setValue[0]=$DataVal[4];
            $setValue[1]=$DataVal[5];
            $setValue[2]=date('Y-m-d',strtotime($DataVal[7]));
            $setValue[3]=date('Y-m-d',strtotime($DataVal[8]));
            $setValue[4]=date('Y-m-d',strtotime($DataVal[9]));
            $setValue[5]=$DataVal[10];
            $setValue[6]=$DataVal[11];
            if($Ref[0] != $_SESSION['EmployeeID']){$setValue[7]=$Ref[0]."/".$_SESSION['EmployeeID'];}else{$setValue[7]=$Ref[0];} 
            $setValue[8]=$DataVal[12];
             $MLcode="";
            if($DataVal[13]=="Normal"){$MLcode="1";}else if($DataVal[13]=="Cesarean Section"){$MLcode="2";}else{$MLcode="3";}
            $setValue[9]=$MLcode;
            $setValue[10]=$DataVal[14];
            $datetimeNowVal=date('Y-m-d h:m:s');
            $setValue[11]=$datetimeNowVal;

            }else if($DataVal[6]=="Request for RTWO"){

            $setValue[0]=$DataVal[4];
            $setValue[1]=$DataVal[5];
            $setValue[2]=date('Y-m-d',strtotime($DataVal[7]));
            $setValue[3]=date('Y-m-d',strtotime($DataVal[8]));
            $setValue[4]=null;
            $setValue[5]=$DataVal[10];
            $setValue[6]=$DataVal[11];
            if($Ref[0] != $_SESSION['EmployeeID']){$setValue[7]=$Ref[0]."/".$_SESSION['EmployeeID'];}else{$setValue[7]=$Ref[0];} 
            $setValue[8]=$DataVal[12];
            $setValue[9]=null;
            $setValue[10]=null;
            $datetimeNowVal=date('Y-m-d h:m:s');
            $setValue[11]=$datetimeNowVal;

            }else{

            $setValue[0]=$DataVal[4];
            $setValue[1]=$DataVal[5];
            $setValue[2]=date('Y-m-d',strtotime($DataVal[7]));
            $setValue[3]=date('Y-m-d',strtotime($DataVal[8]));
            $setValue[4]=date('Y-m-d',strtotime($DataVal[9]));
            $setValue[5]=$DataVal[10];
            $setValue[6]=$DataVal[11];
            if($Ref[0] != $_SESSION['EmployeeID']){$setValue[7]=$Ref[0]."/".$_SESSION['EmployeeID'];}else{$setValue[7]=$Ref[0];} 
            $setValue[8]=$DataVal[12];
            $setValue[9]=null;
            $setValue[10]=null;
            $datetimeNowVal=date('Y-m-d h:m:s');
            $setValue[11]=$datetimeNowVal;
            }
       
            
        $prepExec=odbc_prepare($connection,$SQLstring);

        
  
             $execQuery=odbc_execute($prepExec,$setValue);

            if(!odbc_error($execQuery)){
                $rowAffected=@odbc_num_rows($prepExec);

        
            if( $rowAffected > 0){
          
            
            if(date('Y-m-d',strtotime($DataVal[8]))===date('Y-m-d')){


                  $returnVal=$UpdateInfo -> AirUpdateInfo($DataVal,$statCode);
            }else{
                   $returnVal=1;
            }

        }else{

                return 0;
        }
       
         }else{

                return 0;

        }
       

              $ClassConnection -> Close_connection($connection); 
        }

        } 

        return $returnVal;

}

function validationIfSuccessfullySavedResignation(){

    echo json_encode($_SESSION['successfullySave']);
}




?>