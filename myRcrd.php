 
<?php session_start(); ?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Glimpze</title>
     <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet" />
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css"/>
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="css/owl.carousel.css"/>
    <link rel="stylesheet" href="css/owl.theme.css"/>
    <link rel="stylesheet" href="css/owl.transitions.css"/>
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="css/animate.css"/>
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/normalize.css"/>
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/meanmenu.min.css"/>
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="css/main.css"/>
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="css/morrisjs/morris.css"/>
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css"/>
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="css/metisMenu/metisMenu.min.css"/>
    <link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css"/>
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="css/calendar/fullcalendar.min.css"/>
    <link rel="stylesheet" href="css/calendar/fullcalendar.print.min.css"/>

     <!-- datapicker CSS
        ============================================ -->
    <link rel="stylesheet" href="css/datapicker/datepicker3.css" />

    <!-- x-editor CSS
		============================================ -->
    <link rel="stylesheet" href="css/editor/select2.css"/>
    <link rel="stylesheet" href="css/editor/datetimepicker.css"/>
    <link rel="stylesheet" href="css/editor/bootstrap-editable.css"/>
    <link rel="stylesheet" href="css/editor/x-editor-style.css"/>
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/data-table/bootstrap-table.css"/>
    <link rel="stylesheet" href="css/data-table/bootstrap-editable.css"/>
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="style.css"/>
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="css/responsive.css"/>
    <!-- modernizr JS
		============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>


     <style>
    @media screen and (min-width: 768px) {
        .modal-dialog {
          width: 482px; /* New width for default modal */
        }
        .modal-sm {
          width: 350px; /* New width for small modal */
        }
    }
    @media screen and (min-width: 992px) {
        .modal-lg {
          width: 925px; /* New width for large modal */
        }
    }

   .modal {
  overflow-y:auto;
    }



</style>

</head>


<body>

 <!--<?php include "php/msltAllFunction.php"; ?>-->
    
   <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="dshBrd.php"><img class="main-logo" src="img/logo/glimpze.png" alt="" /></a>
                <strong><img src="img/logo/logosn.png" alt="" /></strong>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <li>
                            <a title="Dashboard" href="dshBrd.php" aria-expanded="false">
                                   <i class="fa big-icon fa-dashboard icon-wrap"></i>
                                   <span class="mini-click-non">Dashboard</span>
                                </a>
                        </li>
                        
                         <li>
                            <a title="My Profile" href="EmpInfo.php" aria-expanded="false">
                                   <i class="fa big-icon fa-user icon-wrap"></i>
                                   <span class="mini-click-non">My Profile</span>
                                </a>
                        </li>
                          <li>
                            <a title="My Activity" href="myRcrd.php" aria-expanded="false">
                                   <i class="fa big-icon fa-table icon-wrap"></i>
                                   <span class="mini-click-non">My Record</span>
                                </a>
                        </li>
                        <li>
                            <a title="Employee" class="has-arrow"  aria-expanded="false"><i class="fa big-icon fa-users icon-wrap"></i> <span class="mini-click-non">Employee</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                 <?php if($_SESSION['AccesType']=="HumanResources" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="Administrator"){ ?>
                                 <li><a title="Add New" href="emrgst.php"><i class="fa fa-plus sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Add New</span></a></li>
                             <?php } ?>
                                <li><a title="Information" href="EmpInfo.php"><i class="fa fa-book sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Edit Information</span></a></li>
                                <li><a title="Employee List" href="mslt.php"><i class="fa fa-list-alt sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Employee List</span></a></li>

                            </ul>
                        </li>
                          <li><a title="Notification" class="has-arrow"  aria-expanded="false"><i class="fa big-icon fa-envelope icon-wrap"></i> <span class="mini-click-non">Notification</span></a>
                                <ul class="submenu-angle" aria-expanded="false">
                                    <li><a title="Resignation" href="RsgnationNotif.php"><i class="fa fa-mail-forward sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Resignation</span></a></li>
                                   
                                    <li><a title="AIR" href="airform.php"><i class="fa fa-mail-forward sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">AIR</span></a></li>
                                    <?php if($_SESSION['AccesType']=="HumanResources" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="Administrator"){ ?>
                                    <li><a title="Termination" href="trm.php"><i class="fa fa-mail-forward sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Termination</span></a></li>
                                    <li><a title="Training fall out" href="fllout.php"><i class="fa fa-mail-forward sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Training fall out</span></a></li>
                                    <li><a title="Separation" href="spration.php"><i class="fa fa-mail-forward sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Separation</span></a></li>
                                    <li><a title="Back to work" href="Bcktowrk.php"><i class="fa fa-mail-forward sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Back to work</span></a></li>
                                    <li><a title="Suspension" href="suspnsion.php"><i class="fa fa-mail-forward sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Suspension</span></a></li>
                                    <?php } ?>
                                </ul>
                        </li>
                         <li>
                            <a  title="Training" class="has-arrow" href="" aria-expanded="false"><i class="fa big-icon fa-exchange icon-wrap"></i> <span class="mini-click-non">Endorsement</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                                 <li><a title="Training" href="trEndrsmnt.php"><i class="fa fa-puzzle-piece sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Training</span></a></li>
                                 <li><a title="Nesting" href="nsEndrsmnt.php"><i class="fa fa-pagelines sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Nesting</span></a></li>
                                    <li><a title="Operation" href="opsEndrsmnt.php"><i class="fa fa-desktop sub-icon-mg" aria-hidden="true"></i> <span class="mini-sub-pro">Operation</span></a></li>
                            </ul>
                        </li>

                          <li>
                            <a  title="Leave Management"  href="" aria-expanded="false"><i class="fa big-icon fa-calendar icon-wrap"> </i> <span class="mini-click-non">Leave Management</span></a>
                          
                        </li>

                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                        <div class="menu-switcher-pro">
                                            <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
													<i class="fa fa-bars"></i>
												</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                                        <div class="header-top-menu tabl-d-n">
                                            <ul class="nav navbar-nav mai-top-nav">
                                                <li class="nav-item">
                                                </li>
                                                <li class="nav-item">
                                                </li>
                                                <li class="nav-item">
                                                </li>
                                                <li class="nav-item">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                             
                                          
                                                <li class="nav-item">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
															<i class="fa fa-user adminpro-user-rounded header-riht-inf" aria-hidden="true"></i>
															<span id="UserName" class="admin-name"></span>
															<i class="fa fa-angle-down adminpro-icon adminpro-down-arrow"></i>
														</a>
                                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                       
                                                        <li><a href="#"><span class="fa fa-user author-log-ic"></span>My Profile</a>
                                                        </li>
                             
                                                        <li><a href="login.html"><span class="fa fa-lock author-log-ic"></span>Log Out</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                
                                                  

                                                
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
                  <!-- Mobile Menu start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul class="mobile-menu-nav">
                                        <li><a data-toggle="collapse" data-target="#Dashboard" href="#">Dashboard<span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#Employee" href="#">Employee<span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                            <ul id="demo" class="collapse dropdown-header-top">
                                                <li><a href="">Information</a>
                                                </li>
                                                <li><a href="">Master List</a>
                                                </li>
                                                
                                            </ul>
                                        </li>
                                     
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu end -->
            <div class="breadcome-area">
                <div class="container-fluid">
                    <div class="row">
                        
                </div>
            </div>
        </div>
        <!-- Static Table Start -->
          <div class="data-table-area mg-tb-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline12-list">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                    <h1>My Record</h1>
                                </div>
                            </div>

                            <div class="sparkline13-graph">
                                <div id="DatableMslt" class="datatable-dashv1-list custom-datatable-overright">

                            

                                      <button id="filterButton" type="button" class="btn btn-custon-three btn-default btn-md" data-toggle="modal" data-target="#MyRecordFilterModal"><i class="fa fa-filter"></i></button>   
                                   
                                        <table  id="tableforRecordViewer" data-show-export="true">
                                        <thead>
                                          
                                        </thead>
                                        <tbody>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
              
                </div>
            </div>
        </div>
        </div>

         <!-- Static Table End -->

        <!-- Modal  -->
        
        <div class="modal fade" id="MyRecordFilterModal" role="dialog">
            <div id="fullwidth" class="modal-dialog">
    
             <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">My Record Filter</h4>
            </div>
           
            <div class="modal-body">
            <div class="container">
                <div class="row">
                       <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                           <div class="all-form-element-inner">
                               
                              <div class="form-group">
                                <div class="row">
                  
                                    <div class="col-sm-6">
                                        <label class="login2   pull-right-pro">Option</label> 
                                        <select name="MyRecordFilterOption" class="form-control">
                                           
                                        </select>   
                                    </div>     
                                </div>
                            </div>

                            <div id="FilterContent">

                                <div class="form-group">
                                <div class="row">
                  
                                    <div class="col-sm-6">
                                        <label name="label1" class="login2   pull-right-pro"></label> 
                                        <select name="MyRecordOptionValue" class="form-control">
                                          
                                        </select>   
                                    </div>     
                                </div>
                            </div>


                            <div id="FilterForEndorsement">

                                <div class="form-group">
                                    <div class="row">
                  
                                    <div class="col-sm-6">
                                        <label  class="login2   pull-right-pro">Process</label> 
                                        <select name="MyRecordOptionValue2ForEndorsement" class="form-control">
                                          
                                        </select>   
                                    </div>     
                                </div>
                            </div>

                            <div class="form-group">
                                    <div class="row">
                  
                                    <div class="col-sm-6">
                                        <label class="login2   pull-right-pro">Batch/Wave</label> 
                                        <select name="MyRecordOptionValue3ForEndorsement" class="form-control">
                                          
                                        </select>   
                                    </div>     
                                </div>
                            </div>


                        </div>   

                                <div id="FilterForNotification">

                                <div class="form-group">

                                <div class="row">
                                <div class="col-sm-6">
                                <label class="login2   pull-right-pro">Effective Date</label> 
                                </div>   
                                </div>

                                <div class="row">
                                <div class="col-sm-6">
                                <label class="login2   pull-right-pro">From</label> 
                                <div class="form-group data-custon-pick" id="data_1">
                                    <div class="input-group date">
                                           
                                        <input type="text" name="MyRecordFrom" class="form-control" value="" />
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        </div>
                                    </div>   
                                </div>
                                <div class="row">
                                <div class="col-sm-6">
                                <label class="login2   pull-right-pro">To</label> 
                                <div class="form-group data-custon-pick" id="data_1">
                                    <div class="input-group date">
                                           
                                        <input type="text" name="MyRecordTo" class="form-control" value="" />
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        </div>
                                    </div>   
                                </div>
                                </div>
                                </div>

                            


                            </div>
                        

                            </div>
                        </div>
                    </div>  
                </div>




            <div class="modal-footer">
            
           <button name="MyRecordProceedFilter" type="button" class="btn btn-default"  data-dismiss="modal">Proceed Filter</button>
           
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
            </div>
            </div>


       
        <div class="footer-copyright-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-copy-right">
                            <p>Version 1.1 Techmahindra LTD MIS Manila.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   
</div>
   <!-- jquery
		============================================ -->
    <script src="js/vendor/jquery-1.11.3.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="js/jquery-price-slider.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="js/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- sticky JS
		============================================ -->
    <script src="js/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="js/metisMenu/metisMenu.min.js"></script>
    <script src="js/metisMenu/metisMenu-active.js"></script>

     <!-- datapicker JS
        ============================================ -->
    <script src="js/datapicker/bootstrap-datepicker.js"></script>
    <script src="js/datapicker/datepicker-active.js"></script>
    <!-- data table JS
		============================================ -->
    <script src="js/data-table/bootstrap-table.js"></script>
    <script src="js/data-table/tableExport.js"></script>
    <script src="js/data-table/data-table-active.js"></script>
    <script src="js/data-table/bootstrap-table-editable.js"></script>
    <script src="js/data-table/bootstrap-editable.js"></script>
    <script src="js/data-table/bootstrap-table-resizable.js"></script>
    <script src="js/data-table/colResizable-1.5.source.js"></script>
    <script src="js/data-table/bootstrap-table-export.js"></script>
    <!--  editable JS
		============================================ -->
    <script src="js/editable/jquery.mockjax.js"></script>
    <script src="js/editable/mock-active.js"></script>
    <script src="js/editable/select2.js"></script>
    <script src="js/editable/moment.min.js"></script>
    <script src="js/editable/bootstrap-datetimepicker.js"></script>
    <script src="js/editable/bootstrap-editable.js"></script>
    <script src="js/editable/xediable-active.js"></script>
    <!-- Chart JS
		============================================ -->
    <script src="js/chart/jquery.peity.min.js"></script>
    <script src="js/peity/peity-active.js"></script>
    <!-- tab JS
		============================================ -->
    <script src="js/tab.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="js/main.js"></script>

    <script type="text/javascript">
        


         $(document).ready(function () {

            var userName=<?php  echo json_encode($_SESSION['LastName'].", ".$_SESSION['FirstName']); ?>;
            var tabbleVal=$('#tableforRecordViewer');
        
            $("#UserName").text(userName);
            exeFunctionTable();

            var InitialFilterOption="<option></option><option>Notification</option><option>Endorsement</option><option>Leave Filed & Approval</option>";

            $('[name=MyRecordFilterOption]').empty();
            $('[name=MyRecordFilterOption]').append(InitialFilterOption);
            $('#FilterContent').hide();

            $('[name=MyRecordFilterOption]').change(function(){

                var  dataValue=[];
                var appendString="";
                var optionSelected=$('[name=MyRecordFilterOption]').val();

                if( optionSelected=="Notification"){        

                    $.ajax({
                    url: 'php/rrcdAllFunction.php',
                    data:{functionNumber:1},
                    type: 'post',
                    success: function(data){

                         
                            $('#FilterContent').show();
                            $('#FilterForEndorsement').hide();
                            $('#FilterForNotification').show();
                            $('[name=label1]').text("Status");
                         

                            var dataValue=JSON.parse(data);

                            appendString="<option>--All--</option>";

                            for(var a=0;a < dataValue.length;a++){

                             appendString=appendString+"<option>"+dataValue[a]+"</option>";

                            }
                            
                           $('[name=MyRecordOptionValue]').empty();
                           $('[name=MyRecordOptionValue]').append(appendString);     
                         

                     }

                });
                    
                   
                }else if(optionSelected=="Endorsement"){

                    
                    $('[name=label1]').text("Endorse for");
                    $('#FilterContent').show();
                    $('#FilterForEndorsement').show();
                    $('#FilterForNotification').hide();

                    appendString="<option>--All--</option>";
                    appendString=appendString+"<option>Training</option>";
                    appendString=appendString+"<option>Nesting</option>";
                    appendString=appendString+"<option>Operation</option>";

                    $('[name=MyRecordOptionValue]').empty();
                    $('[name=MyRecordOptionValue]').append(appendString); 

                    getListForProcessEndorsement($('[name=MyRecordOptionValue]').val());


                }else if(optionSelected=="Leave Filed & Approval"){

                    $('#FilterContent').hide();
                    $('#FilterForEndorsement').hide();
                    $('#FilterForNotification').hide();


                }else{


                    $('[name=label1]').text("");
                    $('#FilterContent').hide();
                    $('#FilterForEndorsement').hide();
                    $('#FilterForNotification').hide();

                }


                             

            });


            function getListForProcessEndorsement(selected1){
                
              
                $('[name=MyRecordOptionValue3ForEndorsement]').empty();

                $.ajax({
                    url: 'php/rrcdAllFunction.php',
                    data:{functionNumber:2,SelectedOption1:Selection1},
                    type: 'post',
                    success: function(data){


                            var dataValue=JSON.parse(data);

                            appendString="<option></option>";

                            for(var a=0;a < dataValue.length;a++){

                             appendString=appendString+"<option>"+dataValue[a]+"</option>";

                            }
                            
                           $('[name=MyRecordOptionValue2ForEndorsement]').empty();
                           $('[name=MyRecordOptionValue2ForEndorsement]').append(appendString);     


                    }

                });

            }

               function getListForBatchEndorsement(selected1,selected2){
                
                var Selection1=$('[name=MyRecordOptionValue]').val();


                $.ajax({
                    url: 'php/rrcdAllFunction.php',
                    data:{functionNumber:3,SelectedOption2:Selection1,SelectedOption3:selected2},
                    type: 'post',
                    success: function(data){


                            var dataValue=JSON.parse(data);

                            appendString="<option></option>";

                            for(var a=0;a < dataValue.length;a++){

                             appendString=appendString+"<option>"+dataValue[a]+"</option>";

                            }
                            
                           $('[name=MyRecordOptionValue3ForEndorsement]').empty();
                           $('[name=MyRecordOptionValue3ForEndorsement]').append(appendString);     


                    }

                });

            }

            $("[name=MyRecordProceedFilter]").click(function(){

                var Data=[];
                var appendString="";

                 $('#tableforRecordViewer thead').empty();


                if($('[name=MyRecordFilterOption]').val()=="Notification"){

                if($('[name=MyRecordFilterOption]').val() != "" && $('[name=MyRecordOptionValue]').val() !="" && $('[name=MyRecordFrom]').val() !="" && $('[name=MyRecordTo]').val() != "" ){

                    

                    Data[0]=$('[name=MyRecordFilterOption]').val();
                    Data[1]=$('[name=MyRecordOptionValue]').val();
                    Data[2]=$('[name=MyRecordFrom]').val();
                    Data[3]=$('[name=MyRecordTo]').val();

                    appendString="<tr><th>Notification Date</th><th>Name</th><th>Status</th><th>Effectived Date</th><th>Action</th></tr>";

                   
                    $('#tableforRecordViewer thead').append(appendString);

                    
        

                    $.ajax({
                    url: 'php/rrcdAllFunction.php',
                    data:{functionNumber:4,DataVal:Data},
                    type: 'post',
                    success: function(data){

                            appendString="";
                            var dataValue=JSON.parse(data);

                            for(var a=0;a < dataValue[0].length;a++){
                             appendString=appendString+"<tr>";
                             appendString=appendString+"<td>"+dataValue[0][a]+"</td>";
                             appendString=appendString+"<td>"+dataValue[1][a]+"</td>";
                             appendString=appendString+"<td>"+dataValue[2][a]+"</td>";
                             appendString=appendString+"<td>"+dataValue[3][a]+"</td>";
                             appendString=appendString+'<td>';
                             appendString=appendString+'<button title="View" type="button" class="btn btn-custon-three btn-default btn-sm"><i class="fa big-icon fa-external-link icon-wrap"></i></button>'
                             if(dataValue[4][a]=="0" || dataValue[4][a]==0){
                              appendString=appendString+ '<button title="Update"  type="button" class="btn btn-custon-three btn-default btn-sm"><i class="fa big-icon fa-pencil icon-wrap"></i></button>';
                             }
                            
                             appendString=appendString+'</td>';
                             appendString=appendString+'</tr>';
                            }
                            
                           $('#tableforRecordViewer tbody').empty();
                           $('#tableforRecordViewer tbody').append(appendString);  


                    }

                });
     

               

                }

                exeFunctionTable();

                }else if($('[name=MyRecordFilterOption]').val()=="Endorsement"){

                if($('[name=MyRecordFilterOption]').val() != "" && $('[name=MyRecordOptionValue]').val() !="" && $('[name=MyRecordOptionValue2ForEndorsement]').val() !="" && $('[name=MyRecordOptionValue3ForEndorsement]').val() != "" ){

                
                    Data[0]=$('[name=MyRecordFilterOption]').val();
                    Data[1]=$('[name=MyRecordOptionValue]').val();
                    Data[2]=$('[name=MyRecordOptionValue2ForEndorsement]').val();
                    Data[3]=$('[name=MyRecordOptionValue3ForEndorsement]').val();

                    appendString='<tr><td>Notification Date</td><td>Process</td><td>Batch</td><td>Trainer</td><td>Effective Date</td><td>Action</td></tr>';

                    
                    $('#tableforRecordViewer thead').append(appendString);

                     
    
                    $.ajax({
                    url: 'php/rrcdAllFunction.php',
                    data:{functionNumber:4,DataVal:Data},
                    type: 'post',
                    success: function(data){

                            appendString="";
                            var dataValue=JSON.parse(data);

                            for(var a=0;a < dataValue[0].length;a++){
                             appendString=appendString+"<tr>";
                             appendString=appendString+"<td>"+dataValue[0][a]+"</td>";
                             appendString=appendString+"<td>"+dataValue[1][a]+"</td>";
                             appendString=appendString+"<td>"+dataValue[2][a]+"</td>";
                             appendString=appendString+"<td>"+dataValue[3][a]+"</td>";
                             appendString=appendString+"<td>"+dataValue[4][a]+"</td>";
                             appendString=appendString+'<td>';
                             appendString=appendString+'<button title="View" type="button" class="btn btn-custon-three btn-default btn-sm"><i class="fa big-icon fa-external-link icon-wrap"></i></button>'
                             if(dataValue[5][a]=="0" || dataValue[5][a]==0){
                              appendString=appendString+ '<button title="Update"  type="button" class="btn btn-custon-three btn-default btn-sm"><i class="fa big-icon fa-pencil icon-wrap"></i></button>';
                             }
                            
                             appendString=appendString+'</td>';
                             appendString=appendString+'</tr>';

                            }
                            
                           $('#tableforRecordViewer tbody').empty();
                           $('#tableforRecordViewer tbody').append(appendString);     


                    }

                });    
                        
 

                }

               exeFunctionTable();

                }else if($('[name=MyRecordFilterOption]').val()=="Leave Filed & Approval"){

                }
               

            });

                function exeFunctionTable(){

              

                tabbleVal.bootstrapTable({
                
                search: true,
                pagination:true,
                showPaginationSwitch: true,
                searchOnEnterKey: true

                });

                }

            


            });

                


    
    </script>

</body>
</html>