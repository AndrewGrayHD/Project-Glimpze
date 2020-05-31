
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
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <!-- owl.carousel CSS
        ============================================ -->
    <link rel="stylesheet" href="css/owl.carousel.css" />
    <link rel="stylesheet" href="css/owl.theme.css" />
    <link rel="stylesheet" href="css/owl.transitions.css" />
    <!-- animate CSS
        ============================================ -->
    <link rel="stylesheet" href="css/animate.css" />
    <!-- normalize CSS
        ============================================ -->
    <link rel="stylesheet" href="css/normalize.css" />
    <!-- meanmenu icon CSS
        ============================================ -->
    <link rel="stylesheet" href="css/meanmenu.min.css" />
    <!-- main CSS
        ============================================ -->
    <link rel="stylesheet" href="css/main.css" />
    <!-- morrisjs CSS
        ============================================ -->
    <link rel="stylesheet" href="css/morrisjs/morris.css" />
    <!-- mCustomScrollbar CSS
        ============================================ -->
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css" />
    <!-- metisMenu CSS
        ============================================ -->
    <link rel="stylesheet" href="css/metisMenu/metisMenu.min.css" />
    <link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css" />
    <!-- calendar CSS
        ============================================ -->
    <link rel="stylesheet" href="css/calendar/fullcalendar.min.css" />
    <link rel="stylesheet" href="css/calendar/fullcalendar.print.min.css" />
    <!-- modals CSS
        ============================================ -->
    <link rel="stylesheet" href="css/modals.css" />
    <!-- touchspin CSS
        ============================================ -->
    <link rel="stylesheet" href="css/touchspin/jquery.bootstrap-touchspin.min.css" />
    <!-- datapicker CSS
        ============================================ -->
    <link rel="stylesheet" href="css/datapicker/datepicker3.css" />
     <!-- colorpicker CSS
        ============================================ -->
    <link rel="stylesheet" href="css/colorpicker/colorpicker.css" />
    <!-- select2 CSS
        ============================================ -->
    <link rel="stylesheet" href="css/select2/select2.min.css" />
    <!-- forms CSS
        ============================================ -->
    <link rel="stylesheet" href="css/form/all-type-forms.css" />
    <!-- style CSS
        ============================================ -->
    <link rel="stylesheet" href="style.css" />
    <!-- responsive CSS
        ============================================ -->
    <link rel="stylesheet" href="css/responsive.css" />
    <!-- modernizr JS
        ============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>

      <!-- boostrap 
        ============================================ -->

  <style>
    @media screen and (min-width: 768px) {
        .modal-dialog {
          width: 700px; /* New width for default modal */
        }
        .modal-sm {
          width: 500px; /* New width for small modal */
        }
    }
    @media screen and (min-width: 992px) {
        .modal-lg {
          width: 800px; /* New width for large modal */
        }
    }

   .modal {
  overflow-y:auto;
    }



</style>


</head>
<body>

<!--<?php include "php/endorsementFunction.php"; ?>-->

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
                            <a href="dshBrd.php" aria-expanded="false">
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
                            <a title="My Record" href="myRcrd.php" aria-expanded="false">
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
        
             <!--  Form Start -->
      <div class="advanced-form-area mg-tb-15">
        <div class="container-fluid">
          <div class="row">   
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             <div class="sparkline12-list">
                 <div class="sparkline11-graph">
                   <div class="row">
                       <div class="col-sm-12">
                           <div class="main-sparkline12-hd">
                             <h4 id="NotifTitle">Training Endorsement</h4>
                            </div>
                       </div>  
                   </div>

                  <label></label>
                    <div class="row">
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <div class="all-form-element-inner">
                                  
                             <div class="row">
                                <div class="col-sm-4">
                                    <label class="login2  pull-right-pro"><u>Agent List</u></label>
                                </div>
                                  <div class="col-sm-4">
                                      <label class="login2  pull-right-pro"><u>For Training List</u></label>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <button  name="traingEndorsementArrowRight" type="button" class="btn btn-custon-three btn-default btn-sm pull-right col-sm-5"><i class="fa big-icon fa-chevron-right icon-wrap"></i><i class="fa big-icon fa-chevron-right icon-wrap"></i></button>
                                               
                                                   
                                            
                                  
                                             <label class="login2  pull-right-pro">Select All</label>
                                            <input  type="checkbox" name="selectAllagent">
                                  
                                           <select class="form-control"   name="traingEndorsementAgentList" multiple="" size="18">
                                                       
                                          </select>
                                        </div>

                                        <div class="form-group">
                                            <button  name="traingEndorsementFilterButton" type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#TrainingEndorsementModal">Filter</button>  
                                        </div>
                                    </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <button  name="traingEndorsementLeftArrow" type="button" class="btn btn-custon-three btn-default btn-sm pull-right col-sm-5"><i class="fa big-icon fa-chevron-left icon-wrap"></i><i class="fa big-icon fa-chevron-left icon-wrap"></i></button>
                                               
                                              <label class="login2  pull-right-pro">Select All</label>
                                            <input  type="checkbox"  name="selectAllTrainning">       
                                        
                                            <select class="form-control"  name="traingEndorsementforTrainingList" multiple="" size="18">
                                                    
                                            </select>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="login2  pull-right-pro">Process</label>
                                        <select class="form-control" name="traingEndorsementProcess">
                                                        
                                        </select>
                                        </div> 
                                        <div class="form-group">
                                        <label class="login2  pull-right-pro">Trainer</label>
                                        <select class="form-control" name="traingEndorsementTrainer">
                                                        
                                        </select>
                                         </div>
                                         <div class="form-group">
                                        <label class="login2  pull-right-pro">Training Start Date</label>
                                        <div class="form-group data-custon-pick" id="data_1">
                                        <div class="input-group date">
                                           
                                            <input type="text"  class="form-control" name="traingEndorsementTraningStartDate" />
                                             <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        
                                         <div class="touchspin-inner">
                                            <label class="login2  pull-right-pro">Number of Billable Agent</label>
                                            <input class="touchspin1" type="text"  name="traingEndorsementNumBillable">
                                        </div>
                                        </div>

                                         <div class="form-group">
                                        
                                     
                                            <label class="login2  pull-right-pro">Batch-</label>

                                            <input class="form-control" type="text"  name="traingEndorsementBatch">
                                   
                                        </div>
                                         <div class="form-group">
                                         <button class="btn btn-lg btn-primary login-submit-cs pull-right" type="submit" id="saveEndorsementTraining"><i class="fa big-icon fa-save icon-wrap"></i></button>
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
    </div>

             <!-- Modal for process modification -->
            <div class="modal fade" id="TrainingEndorsementModal" role="dialog">
            <div id="fullwidth" class="modal-dialog">
    
             <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Agent List Filter</h4>
            </div>
           
            <div class="modal-body">
            <div class="container">
                <div class="row">
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="all-form-element-inner">
                               
                              <div class="form-group">
                                <div class="row">
                  
                                    <div class="col-sm-5">
                                        <label class="login2   pull-right-pro">Process</label> 
                                        <select name="traingEndorsementProcessModal" class="form-control">
                                           
                                        </select>   
                                    </div>     
                                </div>
                            </div>

                             <div class="form-group">
                                  <div class="row">
                                <div class="col-sm-5">
                                <label class="login2   pull-right-pro">Hired Date From</label> 
                                <div class="form-group data-custon-pick" id="data_1">
                                    <div class="input-group date">
                                           
                                        <input type="text" name="traingEndorsementHiredFromModal" class="form-control" value="" />
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        </div>
                                    </div>   
                                </div>
                                <div class="row">
                                <div class="col-sm-5">
                                <label class="login2   pull-right-pro">Hired Date To</label> 
                                <div class="form-group data-custon-pick" id="data_1">
                                    <div class="input-group date">
                                           
                                        <input type="text" name="traingEndorsementHiredtoModal" class="form-control" value="" />
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        </div>
                                    </div>   
                                </div>
                                </div>

                            <div class="form-group">
                                <div class="row">
                  
                                    <div class="col-sm-5">
                                        <label class="login2   pull-right-pro">Supervisor</label> 
                                        <select name="traingEndorsementCategoryModal" class="form-control">
                                          
                                        </select>   
                                    </div>     
                                </div>
                            </div>

                        

                            </div>
                        </div>
                    </div>  
                </div>




            <div class="modal-footer">
            
           <button name="trEndorsementProceedButton" type="button" class="btn btn-default"  data-dismiss="modal">Proceed Filter</button>
           
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
            </div>
            </div>
                             

        <!-- Form  End -->
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
    <!-- touchspin JS
        ============================================ -->
    <script src="js/touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="js/touchspin/touchspin-active.js"></script>
     <!-- colorpicker JS
        ============================================ -->
    <script src="js/colorpicker/jquery.spectrum.min.js"></script>
    <script src="js/colorpicker/color-picker-active.js"></script>
    <!-- datapicker JS
        ============================================ -->
    <script src="js/datapicker/bootstrap-datepicker.js"></script>
    <script src="js/datapicker/datepicker-active.js"></script>
    <!-- input-mask JS
        ============================================ -->
    <script src="js/input-mask/jasny-bootstrap.min.js"></script>

     <!-- chosen JS
        ============================================ -->
    <script src="js/chosen/chosen.jquery.js"></script>
    <script src="js/chosen/chosen-active.js"></script>
    <!-- select2 JS
        ============================================ -->
    <script src="js/select2/select2.full.min.js"></script>
    <script src="js/select2/select2-active.js"></script>
    <!-- ionRangeSlider JS
        ============================================ -->
    <script src="js/ionRangeSlider/ion.rangeSlider.min.js"></script>
    <script src="js/ionRangeSlider/ion.rangeSlider.active.js"></script>
    <!-- rangle-slider JS
        ============================================ -->
    <script src="js/rangle-slider/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="js/rangle-slider/jquery-ui-touch-punch.min.js"></script>
    <script src="js/rangle-slider/rangle-active.js"></script>
    <!-- knob JS
        ============================================ -->
    <script src="js/knob/jquery.knob.js"></script>
    <script src="js/knob/knob-active.js"></script>

    <!-- tab JS
        ============================================ -->
    <script src="js/tab.js"></script>
    <!-- icheck JS
        ============================================ -->
    <script src="js/icheck/icheck.min.js"></script>
    <script src="js/icheck/icheck-active.js"></script>
    <!-- plugins JS
        ============================================ -->
    <script src="js/plugins.js"></script>
    <!-- main JS
        ============================================ -->
    <script src="js/main.js"></script>
     <script type="text/javascript">

             

             $(document).ready(function () {

                 //start global variable
                  var userName=<?php  echo json_encode($_SESSION['LastName'].", ".$_SESSION['FirstName']); ?>;
                  var WhatTodo=<?php  echo json_encode($_SESSION['WhatToDoEndorsement']); ?>;
                 //end global variable

                $("#UserName").text(userName);
                fillProcessAndTrainerName();


                

                $("[name=traingEndorsementFilterButton]").click(function(){



                         $.ajax({
                                url: 'php/endorsementFunction.php',
                                data:{functionNumber:1},
                                type: 'post',
                                success: function(data){
                                
                                var result=JSON.parse(data);   
                                var appendstring="";
                                 appendstring=appendstring+"<option></option>";
                                for(var a=0; a < result.length;a++){

                                    appendstring=appendstring+"<option>"+result[a]+"</option>";

                                }

                                $("[name=traingEndorsementProcessModal]").empty();
                                $("[name=traingEndorsementProcessModal]").append(appendstring);

                               
                                }

                        }); 

                         
                         
                    
                    
                });


                $("[name=traingEndorsementProcessModal]").change(function(){
                     supervisorCategory();
                });

                function supervisorCategory(){

                    var IfProcessDataVal=$("[name=traingEndorsementProcessModal]").val();
                         

                         $.ajax({
                                url: 'php/endorsementFunction.php',
                                data:{functionNumber:2,IfProcessHaveData:IfProcessDataVal},
                                type: 'post',
                                success: function(data){
                                
                                var result=JSON.parse(data);   
                                var appendstring="";
                                 appendstring=appendstring+"<option></option>";
                                for(var a=0; a < result.length;a++){

                                    appendstring=appendstring+"<option>"+result[a]+"</option>";

                                }

                                $("[name=traingEndorsementCategoryModal]").empty();
                                $("[name=traingEndorsementCategoryModal]").append(appendstring);

                               
                                }

                        
                        });
                

                }


                $("[name=trEndorsementProceedButton]").click(function(){

                    var EndorsementProcessModal="";
                    var EndorsementHiredFromModal="";
                    var EndorsementHiredtoModal="";
                    var EndorsementCategoryModal="";


                    if($("[name=traingEndorsementProcessModal]").val() !=""){
                    EndorsementProcessModal=$("[name=traingEndorsementProcessModal]").val();
                    }
                    if($("[name=traingEndorsementHiredFromModal]").val() !=""){
                    EndorsementHiredFromModal=$("[name=traingEndorsementHiredFromModal]").val();
                    }

                    if($("[name=traingEndorsementHiredtoModal]").val() !=""){
                    EndorsementHiredtoModal=$("[name=traingEndorsementHiredtoModal]").val();
                    } 


                    if($("[name=traingEndorsementCategoryModal]").val() !=""){
                    EndorsementCategoryModal=$("[name=traingEndorsementCategoryModal]").val();
                    }

                   
                       $.ajax({
                                url: 'php/endorsementFunction.php',
                                data:{functionNumber:3,EndorsementProcessModalC:EndorsementProcessModal,EndorsementHiredFromModalC:EndorsementHiredFromModal,EndorsementHiredtoModalC:EndorsementHiredtoModal,EndorsementCategoryModalC:EndorsementCategoryModal},
                                type: 'post',
                                success: function(data){
                                
                                var result=JSON.parse(data);   
                                var appendstring="";
                                 
                                for(var a=0; a < result[0].length;a++){

                                    appendstring=appendstring+"<option>"+result[0][a]+"-"+result[1][a]+"</option>";

                                }

                                $("[name=traingEndorsementAgentList]").empty();
                                $("[name=traingEndorsementAgentList]").append(appendstring);

                                
                               
                                }

                        
                        });

                        $("[name=traingEndorsementHiredtoModal]").val("");
                        $("[name=traingEndorsementHiredFromModal]").val("");
                        $("[name=traingEndorsementProcessModal]").empty();
                        $("[name=traingEndorsementCategoryModal]").empty();


                });

                
                $("[name=selectAllagent]").click(function(){

                        $("[name=traingEndorsementAgentList]").focus();
                        if($(this).prop("checked")==true){
                            $("[name=traingEndorsementAgentList] option").prop("selected",true);
                        }else if($(this).prop("checked")==false){

                             $("[name=traingEndorsementAgentList] option").prop("selected",false);
                        }

                    

                });

                 $("[name=selectAllTrainning]").click(function(){

                        $("[name=traingEndorsementforTrainingList]").focus();
                        if($(this).prop("checked")==true){
                            $("[name=traingEndorsementforTrainingList] option").prop("selected",true);
                        }else if($(this).prop("checked")==false){

                             $("[name=traingEndorsementforTrainingList] option").prop("selected",false);
                        }

                    

                });


                 function fillProcessAndTrainerName(){

                          $.ajax({
                                url: 'php/endorsementFunction.php',
                                data:{functionNumber:6},
                                type: 'post',
                                success: function(data){
                                
                                var result=JSON.parse(data); 
                               
                                var appendstring="";
                                 appendstring=appendstring+"<option></option>";
                                for(var a=0; a < result.length;a++){

                                    appendstring=appendstring+"<option>"+result[a]+"</option>";

                                }

                                $("[name=traingEndorsementProcess]").empty();
                                $("[name=traingEndorsementProcess]").append(appendstring);

                               
                                }

                        
                        });

                        

                           
                 }

                 $("[name=traingEndorsementProcess]").change(function(){

                     fillTrainerName($("[name=traingEndorsementProcess]").val());

                 });

                   function fillTrainerName(ProcessVal){


                         $.ajax({
                                url: 'php/endorsementFunction.php',
                                data:{functionNumber:4,ProcessFilter:ProcessVal},
                                type: 'post',
                                success: function(data){
                                
                                var result=JSON.parse(data);   
                                var appendstring="";
                                 appendstring=appendstring+"<option></option>";
                                for(var a=0; a < result.length;a++){

                                    appendstring=appendstring+"<option>"+result[a]+"</option>";

                                }

                                $("[name=traingEndorsementTrainer]").empty();
                                $("[name=traingEndorsementTrainer]").append(appendstring);

                               
                                }

                        
                        });
                   }


                 $("[name=traingEndorsementArrowRight]").click(function(){

                        listpassData("traingEndorsementAgentList","traingEndorsementforTrainingList");


                 });

                $("[name=traingEndorsementLeftArrow]").click(function(){

                     listpassData("traingEndorsementforTrainingList","traingEndorsementAgentList");


                 });

                function listpassData(List1Name,List2Name){


                        var list1 = [];
                        var list2=[];
                        var list3=[];
                        

                        $.each($("[name="+List1Name+"] option:selected"), function(){            
                            list1.push($(this).val());
                        });

                        $.each($("[name="+List2Name+"] option"), function(){            
                            list2.push($(this).val());
                        });


                        for(var a=0;a < list1.length;a++ ){

                            if(list2.indexOf(list1[a]) === -1){
                                list2.push(list1[a]);
                            }
                        }

                        var appendString="";


                        for(var i=0;i < list2.length;i++){

                            appendString=appendString+"<option>"+list2[i]+"</option>";


                        }

                     
                         $("[name="+List2Name+"]").empty();
                         $("[name="+List2Name+"]").append(appendString);

                         appendString="";


                        $.each($("[name="+List1Name+"] option"), function(){            
                            
                            if(list1.indexOf($(this).val())===-1){

                                 appendString=appendString+"<option>"+$(this).val()+"</option>";


                            }
                        });

                        $("[name="+List1Name+"]").empty();
                        $("[name="+List1Name+"]").append(appendString);

                }


                $("#saveEndorsementTraining").click(function(){

                    if( $("[name=traingEndorsementforTrainingList] option").size() > 0 && $("[name=traingEndorsementProcess]").val() != "" && $("[name=traingEndorsementTrainer]").val() != "" && $("[name=traingEndorsementTraningStartDate]").val() != "" && $("[name=traingEndorsementNumBillable]").val() != "" &&  $("[name=traingEndorsementBatch]").val() !=""){

                    var validDateFormat=/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|[12][0-9]|3[01])[\/\-]\d{4}$/;
                     var validDateFormat2=/^\d{4}[\/\-](0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|[12][0-9]|3[01])$/;
                       
                    var dateVal=$("[name=traingEndorsementTraningStartDate]").val();
                     if(dateVal.match(validDateFormat) || dateVal.match(validDateFormat2)){

                    if($.isNumeric($("[name=traingEndorsementNumBillable]").val())){
                    if($.isNumeric($("[name=traingEndorsementBatch]").val())){  

                    $EmpCount=$("[name=traingEndorsementforTrainingList] option").size();
                    $BillableCount=$("[name=traingEndorsementNumBillable]").val();
                    
                
                    
                    if($BillableCount  <= $EmpCount){

                            var val="";
                            var empID=[];
                            var index=0;

                            
                          $.each($("[name=traingEndorsementforTrainingList] option"), function(){ 
                  

                          val=$(this).val();
                          var splitVal=val.split("-");
                          empID[index]=splitVal[0]; 

                          index++;


                        });

                          var empIsString="";

                        for(var a=0; a < empID.length;a++){

                            if(a==0){
                                empIsString=empID[a];
                            }else{
                                empIsString=empIsString+"/"+empID[a];

                            }
                        
                        }


                         var DataValue=[];

                         DataValue[0]=empIsString;
                         DataValue[1]=$("[name=traingEndorsementProcess]").val();
                         DataValue[2]=$("[name=traingEndorsementTrainer]").val();
                         DataValue[3]=$("[name=traingEndorsementTraningStartDate]").val();
                         DataValue[4]=$("[name=traingEndorsementNumBillable]").val();
                         DataValue[5]="Batch-" + $("[name=traingEndorsementBatch]").val();
                       
                             $.ajax({
                                url: 'php/endorsementFunction.php',
                                data:{functionNumber:5,dataFieldVal:DataValue,EnorsementSavingProcess:WhatTodo},
                                type: 'post',
                                success: function(data){
                                    
                                    var result=JSON.parse(data);
                                    
                                    if(result==1){
                                        alert("Training endorsement was successfully saved");
                                        clearField();
                                    }else if(result==2){
                                        alert("Training endorsement was already exist for "+  DataValue[1] + " " +  DataValue[5] );
                                        clearField();
                                    }else{
                                        alert("Training endorsement saving failed!");
                                    }

                               
                                },
                                error: function(){

                                        alert("Training endorsement saving failed!");
                                }
                        
                        });


                     }else{
                        alert("Billable count field was not grater than to training list"); 
                    }
                    }else{
                        alert("Batch field was not numeric"); 
                    }

                    }else{
                        alert("Number of Billable Agent field was not numeric"); 
                    }

                          
                     }else{

                        alert("Training Start Date field was not on required format(m/d/yyyy,d/m/yyyy,yyyy-m-d)");
                     }

                          


                    }else{
                        alert("Fill out all fields");
                    }

                });

                function clearField(){

                   $("[name=traingEndorsementProcess]").val("");
                   $("[name=traingEndorsementTrainer]").val("");
                   $("[name=traingEndorsementTraningStartDate]").val("");
                   $("[name=traingEndorsementNumBillable]").val("");
                   $("[name=traingEndorsementBatch]").val("");
                   $("[name=traingEndorsementforTrainingList]").empty();

                      

                }

              

            });

            
              
          

    </script>
   
    

</body>
</html>