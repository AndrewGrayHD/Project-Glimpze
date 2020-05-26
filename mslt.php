 
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
          width: 925px; /* New width for default modal */
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
                                                
                                                  

                                                    <div role="menu" class="admintab-wrap menu-setting-wrap menu-setting-wrap-bg dropdown-menu animated zoomIn">
                                                        <ul class="nav nav-tabs custon-set-tab">
                                                            <li class="active"><a data-toggle="tab" href="#Employee">Employee</a>
                                                            </li>
                                                            <li><a data-toggle="tab" href="#Separated">Separated</a>
                                                            </li>
                                                            
                                                        </ul>

                                                        <div class="tab-content custom-bdr-nt">
                                                        
                                                                 <div id="Separated" class="tab-pane fade in">
                                                                <div class="notes-area-wrap">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                           <div class="chosen-select-single mg-b-20">
                                                                                <label style="color: #FFFFFF">Process</label>
                                                                                    <select id="ProcessSelection2" class="form-control">
                                                                                    <option>--All--</option>
                                                                                    
                                                                            </select>
                                                                         </div>
                                                                       </div>
                                                                    </div>
                                                                       <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                           <div class="chosen-select-single mg-b-20">
                                                                                <label style="color: #FFFFFF">Position</label>
                                                                                    <select id="PositionSelection2" class="form-control">
                                                                                    <option>--All--</option>
                                                                                   
                                                                            </select>
                                                                         </div>
                                                                       </div>
                                                                    </div>
                                                                      <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                           <div class="chosen-select-single mg-b-20">
                                                                                <label style="color: #FFFFFF">Supervisor</label>
                                                                                    <select id="SupervisorSelection2" class="form-control">
                                                                                    <option>--All--</option>
                                                                                   
                                                                            </select>
                                                                         </div>
                                                                       </div>
                                                                    </div>
                                                                      <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                           <div class="chosen-select-single mg-b-20">
                                                                                <label style="color: #FFFFFF">Status</label>
                                                                                    <select id="StatusSelection2" class="form-control">
                                                                                    <option>--All--</option>
                                                                                    
                                                                            </select>
                                                                         </div>
                                                                       </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                           <button id="FilterGenerateButton2" type="button" class="btn btn-custon-four btn-default">Generate</button>
                                                                       </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                         </div> 
                                                    </div>
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
                                    <h1>Employee List</h1>
                                </div>
                            </div>

                            <div class="sparkline13-graph">
                                <div id="DatableMslt" class="datatable-dashv1-list custom-datatable-overright">
                                 <div id="toolbar">
                                      <button id="filterButton" type="button" class="btn btn-custon-three btn-default btn-md" data-toggle="modal" data-target="#FilterListModal"><i class="fa fa-filter"></i></button>   
                                 </div>  
                                   
                                    <table  id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                
                                                <th>Employee ID</th>
                                                <th>Name</th>
                                                <th>Process</th>
                                                <th>Assignment</th>
												<th>Position</th>
												
                                                <th>Billable</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php 
                                         $AceVal=0;
                                         $dataValue[][]=null;
                                         $dataValue=$_SESSION['msltDatable'];
                                         $AceVal=$_SESSION['msltDatableIterate'];
                                         $pota=0;
                                         for($a=0;$a < $AceVal;$a++){
                                         
                                            ?>
                                        <tr>
                                        <td><?php echo $dataValue[0][$a]; ?></td>
                                        <td><?php echo $dataValue[1][$a]; ?></td>
                                        <td><?php echo $dataValue[2][$a]; ?></td>
                                        <td><?php echo $dataValue[3][$a]; ?></td>
                                        <td><?php echo $dataValue[4][$a]; ?></td>
                                        
                                        <td><?php echo $dataValue[19][$a]; ?></td>
                                        <td><?php echo $dataValue[20][$a]; ?></td>
                                        
                                        <td><button id="viewDetails" type="button" class="btn btn-custon-three btn-primary btn-sm" data-toggle="modal" data-target="#modalForemployeeDetails"><i class="fa big-icon fa-book icon-wrap"></i></button><button id="EditDetails" type="button" class="btn btn-custon-three btn-success btn-sm"><i class="fa big-icon fa-pencil icon-wrap"></i></button></td>
                                        </tr>


                                          <?php  
                                        
                                         }
                                     
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
              
                </div>
            </div>
        </div>
        </div>

             <!-- Modal for upload image -->
            <div class="modal fade" id="FilterListModal" role="dialog">
            <div id="fullwidth" class="modal-dialog">
    
             <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Filter</h4>
            </div>

            
            <div class="modal-body">
            <div class="container">
                <div class="row">
                       <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                           <div class="all-form-element-inner">
                               
                            <ul class="nav nav-tabs">
                               <li id="EmployeeFilter" class="active"><a data-toggle="tab" href="#headcount"><label class="login2">Employee</label></a></li>
                               <li id="SeparatedFilter"><a data-toggle="tab" href="#separated"><label class="login2">Separated</label></a></li>
                              
                               </ul>

                               <div class="tab-content">
                                <div id="headcount" class="tab-pane fade in active">
                                <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <div class="chosen-select-single mg-b-20">
                                <label>Process</label>
                                <select id="ProcessSelection" class="form-control">
                                <option>--All--</option>
                                                                                    
                                </select>
                                </div>
                                </div>
                                </div>

                                <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <div class="chosen-select-single mg-b-20">
                                 <label>Position</label>
                                <select id="PositionSelection" class="form-control">
                                <option>--All--</option>
                                                                                   
                                </select>
                                </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <div class="chosen-select-single mg-b-20">
                                <label>Supervisor</label>
                                <select id="SupervisorSelection" class="form-control">
                                <option>--All--</option>
                                </select>
                                </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <div class="chosen-select-single mg-b-20">
                                <label>Status</label>
                                <select id="StatusSelection" class="form-control">
                                <option>--All--</option>
                                </select>
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
           <button id="FilterGenerateButton" type="button" class="btn btn-default"  data-dismiss="modal">Generate</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            
            </div>
            </div>
            </div>

        <!-- Modal -->
            <div class="modal fade" id="modalForemployeeDetails" role="dialog">
            <div  class="modal-dialog">
    
             <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Summary Details</h4>
            </div>
            <div class="modal-body">
                <div class="container">
                 
               
                               
                            <div class="row">
                            <div class="col-sm-2">
                            <img id="msltprofilePic" src="img/user_login__115485.png" width="160 px" alt="User profile" class="img-thumbnail" />
                            </div>
                            <div class="col-sm-6 offset-sm-2" >
                          
                            <h3 id="msltNameofInfo"></h3>
                            <h5 id="msltEmailOfInfo"></h5>
                            <h5 id="msltpositionInfo"></h5>
                          
                            </div>
                            </div>

                             <label></label>

                 <div class="row">
                       <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                           <div class="all-form-element-inner">

                               <ul class="nav nav-tabs">
                               <li class="active"><a data-toggle="tab" href="#primary"><label class="login2">Primary Record</label></a></li>
                               <li><a data-toggle="tab" href="#credentials"><label class="login2">Credentials</label></a></li>
                               <li><a data-toggle="tab" href="#hierarchy"><label class="login2">Supervisor</label></a></li>
                               <li><a data-toggle="tab" href="#state"><label class="login2">State</label></a></li>
                               </ul>

                 <div class="tab-content">
                      
                      <div id="primary" class="tab-pane fade in active">
                        <label></label>
                        
                          <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <table id="primarytable" class="table table-bordered">

                                </table>

                            </div>    
                          </div>
                       </div>      
                         
                      
                       <div id="credentials" class="tab-pane">
                           <label></label>
                          
                               <div class="row">
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                     <table id="credentailstable" class="table table-bordered">

                                     </table>
                              
                                  </div>
                               </div>
                            </div>

                        <div id="hierarchy" class="tab-pane">
                        <label></label>
                            
                               <div class="row">
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <table id="hierarchytable" class="table table-bordered">

                                     </table>
                                  </div>
                               </div>
                           </div>
                           
                                   
                       <div id="state" class="tab-pane">
                          <label></label>
                           

                               <div class="row">
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                     <table id="statetable" class="table table-bordered">

                                     </table>

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
           
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
            </div>

          </div>


        <!-- Static Table End -->
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

            var selectedFilterVal="Employee";

            $("#UserName").text(userName);

              ProcessFilter();

            $("#EmployeeFilter").click(function(){

                  selectedFilterVal="Employee";

             });

             $("#SeparatedFilter").click(function(){

                  selectedFilterVal="Separated";

             });

            $("#ProcessSelection").change(function(){

             
                PositionFilter($("#ProcessSelection").val());
                $("#PositionSelection").empty();
                $("#PositionSelection").append("<option>--All--</option>");
                $("#SupervisorSelection").empty();
                $("#SupervisorSelection").append("<option>--All--</option>");
                $("#StatusSelection").empty();
                $("#StatusSelection").append("<option>--All--</option>");
                

            });

             $("#PositionSelection").change(function(){

                SupervisorFilter($("#ProcessSelection").val(),$("#PositionSelection").val());
                $("#SupervisorSelection").empty();
                $("#SupervisorSelection").append("<option>--All--</option>");
                $("#StatusSelection").empty();
                $("#StatusSelection").append("<option>--All--</option>");
                
            });

              $("#PositionSelection").change(function(){

                 
                 StatusFilter();
                $("#StatusSelection").empty();
                $("#StatusSelection").append("<option>--All--</option>");
              });

              $("#FilterGenerateButton").click(function(){

                ExtractMasterlist($("#ProcessSelection").val(),$("#PositionSelection").val(),$("#SupervisorSelection").val(),$("#StatusSelection").val());

              });



              $("#ProcessSelection2").change(function(){

             
                PositionFilter($("#ProcessSelection2").val());
                SupervisorFilter($("#ProcessSelection2").val(),$("#PositionSelection2").val());

            });

             $("#PositionSelection2").change(function(){

                SupervisorFilter($("#ProcessSelection2").val(),$("#PositionSelection2").val());
                
            });

              $("#PositionSelection2").change(function(){
           
                 StatusFilter();
              });

              $("#FilterGenerateButton2").click(function(){

                ExtractMasterlist($("#ProcessSelection2").val(),$("#PositionSelection2").val(),$("#SupervisorSelection2").val(),$("#StatusSelection2").val());

              });



               $(".table tbody").on('click','#EditDetails',function(){
                      var vRow=$(this).closest('tr');
                var col1=vRow.find('td:eq(0)').text();

                $.ajax({
                url: 'php/msltAllFunction.php',
                data:{functionNumber:6,empidSelected:col1},
                type: 'post',
                success: function(data){

                     window.location = 'EmpInfo.php';
                }
                
                });
                
                });



              $(".table tbody").on('click','#viewDetails',function(){


                var vRow=$(this).closest('tr');
                var col1=vRow.find('td:eq(0)').text();

                $.ajax({
                url: 'php/msltAllFunction.php',
                data:{functionNumber:6,empidSelected:col1},
                type: 'post',
                success: function(data){

                var dataValue=JSON.parse(data);
                
                $("#msltNameofInfo").text(dataValue[3]+", "+dataValue[1]+" " +dataValue[2]);
                 $("#msltEmailOfInfo").text(dataValue[18]);
                  $("#msltpositionInfo").text(dataValue[7]);

                var appendstring="";

                appendstring=appendstring+"<tr><th>Employee ID</th><td>"+dataValue[0]+"</td></tr>";
                appendstring=appendstring+"<tr><th>First Name</th><td>"+dataValue[1]+"</td></tr>";
                appendstring=appendstring+"<tr><th>Middle Name</th><td>"+dataValue[2]+"</td></tr>";
                appendstring=appendstring+"<tr><th>Last Name</th><td>"+dataValue[3]+"</td></tr>";
                appendstring=appendstring+"<tr><th>Account Name</th><td>"+dataValue[4]+"</td></tr>";
                appendstring=appendstring+"<tr><th>Process</th><td>";

                 var splitData=dataValue[5];
                 var arraysplitData=splitData.split("/");

                    for(var i=0;i < arraysplitData.length;i++){

                        appendstring=appendstring+arraysplitData[i]+'<br />';


                    }
                appendstring=appendstring+"</td></tr>";
               
                appendstring=appendstring+"<tr><th>Bandwidth</th><td>"+dataValue[6]+"</td></tr>";
                appendstring=appendstring+"<tr><th>Position</th><td>"+dataValue[7]+"</td></tr>";
                appendstring=appendstring+"<tr><th>Assignment</th><td>"+dataValue[8]+"</td></tr>";
                appendstring=appendstring+"<tr><th>Hired Date</th><td>"+dataValue[9]+"</td></tr>";

                 var splitDataLocation=dataValue[10];
                 var arraysplitDataLocation=splitDataLocation.split("-");

                appendstring=appendstring+"<tr><th>Location</th><td>"+arraysplitDataLocation[0]+"</td></tr>";
                appendstring=appendstring+"<tr><th>Building Name</th><td>"+arraysplitDataLocation[1]+"</td></tr>";
                appendstring=appendstring+"<tr><th>Floor No.</th><td>"+arraysplitDataLocation[2]+"</td></tr>";
                appendstring=appendstring+"<tr><th>Batch/Wave</th><td>"+dataValue[11]+"</td></tr>";
                appendstring=appendstring+"<tr><th>Channel</th><td>"+dataValue[12]+"</td></tr>";

                $("#primarytable").empty();
                $("#primarytable").append(appendstring);

                appendstring="";

                appendstring=appendstring+"<tr><th>Network ID</th><td>"+dataValue[13]+"</td></tr>";
                appendstring=appendstring+"<tr><th>User ID</th><td>"+dataValue[14]+"</td></tr>";
                appendstring=appendstring+"<tr><th>Avaya ID</th><td>"+dataValue[15]+"</td></tr>";
                appendstring=appendstring+"<tr><th>IEX ID</th><td>"+dataValue[16]+"</td></tr>";
                appendstring=appendstring+"<tr><th>Badge ID</th><td>"+dataValue[17]+"</td></tr>";
                appendstring=appendstring+"<tr><th>Company Email Address</th><td>"+dataValue[18]+"</td></tr>";
                appendstring=appendstring+"<tr><th>Other Email Address</th><td>"+dataValue[19]+"</td></tr>";

                $("#credentailstable").empty();
                $("#credentailstable").append(appendstring);

                appendstring="";

                appendstring=appendstring+"<tr><th>Supervisor1</th><td>"+dataValue[20]+"</td></tr>";
                appendstring=appendstring+"<tr><th>Supervisor2</th><td>"+dataValue[21]+"</td></tr>";
                appendstring=appendstring+"<tr><th>Supervisor3</th><td>"+dataValue[22]+"</td></tr>";
                appendstring=appendstring+"<tr><th>Supervisor4</th><td>"+dataValue[23]+"</td></tr>";
                appendstring=appendstring+"<tr><th>Supervisor5</th><td>"+dataValue[24]+"</td></tr>";

                $("#hierarchytable").empty();
                $("#hierarchytable").append(appendstring);

                appendstring="";
                var statusVal="";
                if(dataValue[25]==1 || dataValue[25]=="1"){
                    statusVal="Active";
                }else{
                    statusVal="Inactive";
                }
                 var billableVal="";
                if(dataValue[26]==1 || dataValue[26]=="1"){
                    billableVal="Yes";
                }else{
                    billableVal="No";
                }
                appendstring=appendstring+"<tr><th>Status</th><td>"+statusVal+"</td></tr>";
                appendstring=appendstring+"<tr><th>Billable</th><td>"+billableVal+"</td></tr>";
                appendstring=appendstring+"<tr><th>Tenure</th><td>"+dataValue[27]+"</td></tr>";
                appendstring=appendstring+"<tr><th>Tenure Status</th><td>"+dataValue[28]+"</td></tr>";
                appendstring=appendstring+"<tr><th>History Remarks</th><td>"+dataValue[29]+"</td></tr>";

               



                      
                    if(dataValue[25]==0 || dataValue[25]=="0" ){

                        appendstring=appendstring+"<tr><th colspan='2'>Inactive Status Fields</th></tr>";
                        appendstring=appendstring+"<tr><th>Reason for inactive status</th><td>"+dataValue[30]+"</td></tr>";
                       var EmpID=dataValue[0];
                       var staVal=dataValue[30];

                        $.ajax({

                                url: 'php/empInfoAllFunction.php',
                                data:{functionNumber:9,EmpIDStatInfo:EmpID,checlstatusCat:staVal},
                                type: 'post',
                                success: function(data){

                                var result=JSON.parse(data);
                                
                                if(result[0]=="Leave of absences" || result[0]=="Request for RTWO" || result[0]=="Leave with Pay"){
                                    
                                    appendstring=appendstring+"<tr><th>Last Working Day</th><td>"+result[1]+"</td></tr>";
                                    appendstring=appendstring+"<tr><th>Effective Date</th><td>"+result[2]+"</td></tr>";
                                   

                                  

                                     if(result[0]!="Request for RTWO"){
                                        appendstring=appendstring+"<tr><th>Expected Return Date</th><td>"+result[3]+"</td></tr>";
                                    }


                                }else if(result[0]=="Separated"){

                                    appendstring=appendstring+"<tr><th>Last Working Day</th><td>"+result[1]+"</td></tr>";
                                    appendstring=appendstring+"<tr><th>Effective Date</th><td>"+result[2]+"</td></tr>";
                                    appendstring=appendstring+"<tr><th>Separation Date</th><td>"+result[3]+"</td></tr>";

                       
                              
                                }else{

                                }
                            
                            }

                   });
                            
                     

            }
          

                $("#statetable").empty();
                $("#statetable").append(appendstring);
                
                }
                
        });
            
                   
    });


                function ProcessFilter(){

                $.ajax({
                url: 'php/msltAllFunction.php',
                data:{functionNumber:1},
                type: 'post',
                success: function(data){

                var dataValue=JSON.parse(data);
                var appendstring="";
                appendstring="<option>--All--</option>";

                for(var a=0;a < dataValue.length;a++){

                    appendstring=appendstring+"<option>"+dataValue[a]+"</option>";

                }

                $("#ProcessSelection").empty();
                $("#ProcessSelection").append(appendstring);

                }
                
                });

                }



                function PositionFilter(processVal){

                $.ajax({
                url: 'php/msltAllFunction.php',
                data:{functionNumber:2,selectedProcess:processVal},
                type: 'post',
                success: function(data){

                var dataValue=JSON.parse(data);
                var appendstring="";
                appendstring="<option>--All--</option>";

                for(var a=0;a < dataValue.length;a++){

                    appendstring=appendstring+"<option>"+dataValue[a]+"</option>";

                }

                $("#PositionSelection").empty();
                $("#PositionSelection").append(appendstring);

                }
                
                });


                }

                 function SupervisorFilter(processVal,positionVal){

                $.ajax({
                url: 'php/msltAllFunction.php',
                data:{functionNumber:3,selectedProcess:processVal,selectedPosition:positionVal},
                type: 'post',
                success: function(data){

                var dataValue=JSON.parse(data);
                var appendstring="";
                appendstring="<option>--All--</option>";

                for(var a=0;a < dataValue.length;a++){

                    appendstring=appendstring+"<option>"+dataValue[a]+"</option>";

                }
               
                $("#SupervisorSelection").empty();
                $("#SupervisorSelection").append(appendstring);

                }
                
                });


                }

                function StatusFilter(){

                $.ajax({
                url: 'php/msltAllFunction.php',
                data:{functionNumber:4},
                type: 'post',
                success: function(data){

                var dataValue=JSON.parse(data);
                var appendstring="";
                appendstring="<option>--All--</option>";
               
                for(var a=0;a < dataValue.length;a++){


                    appendstring=appendstring+"<option>"+dataValue[a]+"</option>";

                }
                
                $("#StatusSelection").empty();
                $("#StatusSelection").append(appendstring);


               

              
                }
                
                });


                }

                 function ExtractMasterlist(processVal,positionVal,supervisorNameVal,statusVal){

                var DatavbaseFilterValue="";


                if(selectedFilterVal=="Employee"){
                    DatavbaseFilterValue="DB_Employee_Management_System";
                }else{
                    DatavbaseFilterValue="DB_Employee_Management_System_Separated";
                }

                $.ajax({
                url: 'php/msltAllFunction.php',
                data:{functionNumber:5,selectedProcess:processVal,selectedPosition:positionVal,selectedSupervisor:supervisorNameVal,selectedStatus:statusVal,databaseSelection:DatavbaseFilterValue},
                type: 'post',
                success: function(data){

                var dataValue=JSON.parse(data);
                var appendstring="";
                if (dataValue==1){
                
                window.location = 'mslt.php';

                }
                                         
               // for(var a=0;a < dataValue[0].length;a++){
                    //appendstring=appendstring+"<tr>";
                   // appendstring=appendstring+"<td>"+dataValue[0][a]+"</td>";
                   // appendstring=appendstring+"<td>"+dataValue[1][a]+"</td>";
                   // appendstring=appendstring+"<td>"+dataValue[2][a]+"</td>";
                  //  appendstring=appendstring+"<td>"+dataValue[3][a]+"</td>";
                   // appendstring=appendstring+"<td>"+dataValue[4][a]+"</td>";
                   // appendstring=appendstring+"<td>"+dataValue[5][a]+"</td>";
                   // appendstring=appendstring+"<td>"+dataValue[6][a]+"</td>";
                   // appendstring=appendstring+"<td>"+dataValue[7][a]+"</td>";
                   // appendstring=appendstring+"<td>"+dataValue[8][a]+"</td>";
                   // appendstring=appendstring+"<td>"+dataValue[9][a]+"</td>";
                   // appendstring=appendstring+"<td>"+dataValue[10][a]+"</td>";
                    // appendstring=appendstring+'<td><button id="viewDetails" type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#modalForemployeeDetails"><i class="fa big-icon fa-book icon-wrap"></i></button><button id="EditDetails" type="button" class="btn btn-custon-three btn-default btn-sm"><i class="fa big-icon fa-pencil icon-wrap"></i></button></td>';
                    //appendstring=appendstring+"</tr>";
                //}
               

            

                //$(".table tbody").empty();
                //$(".table tbody").append(appendstring);

                }
                
                });


                }



                  $("#BulkUpdateButton").click(function(){

                    

                    

                });

            });

                


        function clickEditButton() {

            window.location = 'EmpInfo.php';

        }


          
    </script>

</body>
</html>