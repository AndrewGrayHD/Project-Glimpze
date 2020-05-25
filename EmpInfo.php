

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
     <!-- notifications CSS
        ============================================ -->
    <link rel="stylesheet" href="css/nbotifications/Lobibox.min.css">
    <link rel="stylesheet" href="css/notifications/notifications.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="css/responsive.css" />
    <!-- modernizr JS
		============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>

     <!-- Preloader CSS
        ============================================ -->
    <link rel="stylesheet" href="css/preloader/preloader-style.css">

      <!-- boostrap 
		============================================ -->
  <style>
    @media screen and (min-width: 768px) {
        .modal-dialog {
          width: 800px; /* New width for default modal */
        }
        .modal-sm {
          width: 500px; /* New width for small modal */
        }
    }
    @media screen and (min-width: 992px) {
        .modal-lg {
          width: 1000px; /* New width for large modal */
        }
    }

   .modal {
  overflow-y:auto;
    }



</style>
  


</head>
<body>

  <!-- <?php include "php/empInfoAllFunction.php"; ?>-->
  
  <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="index.html"><img class="main-logo" src="img/logo/glimpze.png" alt="" /></a>
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
                    <div class="col-sm-3 pull-right">
                        
                        <input type="text" class="form-control basic-ele-mg-b-10 responsive-mg-b-10 " placeholder="Search - input emp id" />
                         </div>
                            <div class="main-sparkline12-hd">
                             <h3>Employee Information</h3>
                            </div>
                            <label></label>
                            
                            <div class="row">
                            <div class="col-sm-2">
                            <img id="profilePic" src="img/user_login__115485.png" width="200 px" alt="User profile" class="img-thumbnail" />
                            </div>
                            <div class="col-sm-6 offset-sm-2" >
                            <div class="main-sparkline12-hd">
                            <h1 id="NameofInfo"></h1>
                            <h5 id="EmailOfInfo"></h5>
                            <h5 id="positionInfo"></h5>
                            <button type="button" class="btn btn-custon-three btn-primary btn-sm" data-toggle="modal" data-target="#uploadPhoto">Change Photo</button>
                            
                            </div>
                            </div>
                            
                        </div>
                     </div>
                    
                </div>
            </div>

      
        </div>
    </div>
      <div class="advanced-form-area mg-tb-15">
        <div class="container-fluid">
          <div class="row">   
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             <div class="sparkline12-list">
                   
                 <div class="row">
                   <div class="col-sm-12">
                     <div>
                      
                      <?php if($_SESSION['AccesType']=="HumanResources" || $_SESSION['AccesType']=="SuperAdmin" || $_SESSION['AccesType']=="Administrator"){ ?>
                      <button id="InfoAddnewbutton" type="button" class="btn btn-custon-three btn-primary btn-sm pull-right"><i class="fa big-icon fa-plus icon-wrap"> </i></button>
                      <?php } ?>
                      </div>
                   </div>
                 </div>

                   <div class="row">
                       <div class="col-sm-12">
                         
                           <div class="main-sparkline12-hd">
                             <h4>Profile</h4>
                            </div>
                       </div>  
                   </div>



                  <div class="sparkline11-graph">
                    <div class="row">
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <div class="row">
                                        
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Employee ID</label>
		                                </div>

    		                            <div class="col-sm-4">
      		                            <input name="employeeIDtxt" type="text" class="form-control" />
                                        </div>
                                    </div>
                                  </div>

                                   <div class="form-group">
                                    <div class="row">
                                        
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">First Name</label>
		                                </div>

    		                            <div class="col-sm-6">
      		                            <input name="Fnametxt" type="text" class="form-control" />
                                        </div>
                                    </div>
                                  </div>

                                   <div class="form-group">
                                    <div class="row">
                                        
                                       <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Middle Name</label>
		                                </div>

    		                            <div class="col-sm-6">
      		                            <input name="Mnametxt" type="text" class="form-control" />
                                        </div>
                                    </div>
                                  </div>

                                 <div class="form-group">
                                    <div class="row">
                                        
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Last Name</label>
		                                </div>

    		                            <div class="col-sm-6">
      		                            <input name="Lnametxt" type="text" class="form-control" />
                                        </div>
                                    </div>
                                  </div>

                                   
                                  <div class="form-group">


                                     <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Account Name</label>
                                        </div>
                                         <div class="col-sm-6">
                                             
                                                <input name="AcoountNameTxt" type="text" class="form-control" disabled="" />
                                                 

                                         </div>
                                    
                                    </div>
                                  </div>
                           
                                 <div class="form-group">


                                     <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Process</label>
		                                </div>
    		                             <div class="col-sm-6">
                                             
                                                <select name="ProcessSelectTxt" class="form-control" multiple="multiple" size="9">
														
												</select>

                                         </div>
                                         
                                    <div class="col-sm-2"><button name="EditProcessButton" type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#processModif"><i class="fa big-icon fa-pencil icon-wrap"></i></button>
                                   </div>

                                        
                                          
                                    </div>
                                  </div>


                                
                                 <div class="form-group">
                                       <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Bandwidth</label>
		                                </div>
    		                             <div class="col-sm-6">
                                            <input name="BandwidthTxt" type="text" class="form-control" disabled=""  /> 
                                         </div>
                                         <div class="col-sm-2"> <button onclick="setnameOflistinModal(1,'BandwidthTxt')"  type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#DropdownList"><i class="fa big-icon fa-pencil icon-wrap"></i></button></div>
                                     </div>
                                </div>
                                  

                                   <div class="form-group">
                                       <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Position</label>
		                                </div>


    		                             <div class="col-sm-6">
                                              <input name="PositionTxt" type="text" class="form-control" disabled="" /> 
                                         </div>
                                            <div class="col-sm-2"><button onclick="setnameOflistinModal(2,'PositionTxt')" type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#DropdownList"><i class="fa big-icon fa-pencil icon-wrap"></i></button></div>
                                     </div>
                                 </div>

                                   <div class="form-group">
                                       <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Assignment</label>
		                                </div>
    		                             <div class="col-sm-6">
                                            <input name="AssignmentTxt" type="text" class="form-control" disabled="" /> 
                                               
                                         </div>
                                          <div class="col-sm-2"><button onclick="setnameOflistinModal(3,'AssignmentTxt')" type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#DropdownList"><i class="fa big-icon fa-pencil icon-wrap"></i></button></div>
                                     </div>
                                  </div>

                              
                                     <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Hired Date</label>
		                                </div>
    		                             <div class="col-sm-6">
                                            
                                        <div class="form-group data-custon-pick" id="data_1">
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input name="hiredDate" type="text" class="form-control" value="" />
                                        </div>
                                        </div>

                                         </div>
                                     </div>

                                  <div class="form-group">
                                     <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Location</label>
		                                </div>
    		                             <div class="col-sm-6">
                                             <input name="LocationTxt" type="text" class="form-control" disabled="" /> 
                                               
                                         </div>
                                          <div class="col-sm-2"><button onclick="setnameOflistinModal(4,'LocationTxt')" type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#DropdownList"><i class="fa big-icon fa-pencil icon-wrap"></i></button></div>
                                     </div>
                                 </div>


                                 <div class="form-group">
                                     <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Building Name</label>
		                                </div>
    		                             <div class="col-sm-6">
                                             <input name="BldgNameTxt" type="text" class="form-control" disabled="" /> 
                                              
                                            </div>
                                         <div class="col-sm-2"><button onclick="setnameOflistinModal(5,'BldgNameTxt')" type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#DropdownList"><i class="fa big-icon fa-pencil icon-wrap"></i></button></div>
                                     </div>
                                </div>
                                
                                <div class="form-group">
                                     <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Floor No.</label>
		                                </div>
    		                             <div class="col-sm-6">
                                             <input name="FloorTxt" type="text" class="form-control" disabled="" /> 
                                               
                                            </div>

                                             <div class="col-sm-2"><button onclick="setnameOflistinModal(6,'FloorTxt')" type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#DropdownList"><i class="fa big-icon fa-pencil icon-wrap"></i></button></div>
                                     </div>
                                </div>
                                 
                                    
                                   <div class="form-group">
                                      <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Batch/Wave</label>
		                                </div>
    		                             <div class="col-sm-6">
                                            <input name="BatchWaveTxt" type="text" class="form-control" />
                                         </div>
                                     </div>
                                 </div>

                                <div class="form-group">
                                      <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Channel</label>
		                                </div>
    		                             <div class="col-sm-6">
                                           
                                                
                                                <input name="ChannelTxt" type="text" class="form-control" disabled="" /> 
                                            
                                         </div>
                                          <div class="col-sm-2"><button onclick="setnameOflistinModal(7,'ChannelTxt')" type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#DropdownList"><i class="fa big-icon fa-pencil icon-wrap"></i></button></div>
                                     </div>
                                   </div>

                                 <div class="form-group">
                                          <div class="row">
                                          <div class="col-sm-9">
                                          <div class="login-horizental cancel-wp pull-right">
                                          
                                          <button id="PrimInfoButton" class="btn btn-sm btn-primary login-submit-cs" type="submit">Save Change</button>
                                          </div>
                                          </div>
                                          </div>
                                      </div>

                                 </div> 
                               </div> 
                           
                          </div>
                       <div id="credentials" class="tab-pane">
                           <label></label>
                        
                               <div class="row">
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                        <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Network ID</label>
		                                </div>
    		                            <div class="col-sm-6">
      		                            <input name="NetworkIDTxt" type="text" class="form-control" />
                                        </div>
                                    </div>
                                    </div>
                                      <div class="form-group">
                                        <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">User ID</label>
		                                </div>
    		                            <div class="col-sm-6">
      		                            <input name="UserIDTxt" type="text" class="form-control" />
                                        </div>
                                    </div>
                                    </div>
                                      <div class="form-group">
                                        <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Avaya ID</label>
		                                </div>
    		                            <div class="col-sm-6">
      		                            <input name="AvayaIDTxt" type="text" class="form-control" />
                                        </div>
                                    </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">IEX ID</label>
		                                </div>
    		                            <div class="col-sm-6">
      		                            <input name="IEXIDTxt" type="text" class="form-control" />
                                        </div>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Badge ID</label>
		                                </div>
    		                            <div class="col-sm-6">
      		                            <input name="BadgeIDTxt" type="text" class="form-control" />
                                        </div>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Company Email Address</label>
		                                </div>
    		                            <div class="col-sm-6">
      		                            <input name="CompanyEmailAddressTxt" type="text" class="form-control" />
                                        </div>
                                    </div>
                                    </div>
                                      <div class="form-group">
                                        <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Other Email Address</label>
		                                </div>
    		                            <div class="col-sm-6">
      		                            <input name="OtherEmailAddressTxt" type="text" class="form-control" />
                                        </div>
                                    </div>
                                    </div>


                                        <div class="form-group">
                                          <div class="row">
                                          <div class="col-sm-9">
                                          <div class="login-horizental cancel-wp pull-right">
                                          
                                          <button id="CredentialsButton" class="btn btn-sm btn-primary login-submit-cs" type="submit">Save Change</button>
                                          </div>
                                          </div>
                                          </div>
                                      </div>

                                  </div>
                                </div>
                     
                       </div>
                     <div id="hierarchy" class="tab-pane">
                        <label></label>
                          
                               <div class="row">
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                      <div class="form-group">
                                       <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Supervisor1</label>
		                                </div>
    		                             <div class="col-sm-6">
                                            
                                            <input name="Supervisor1Txt" type="text" class="form-control" disabled=""/> 
                                               
                                         
                                         </div>
                                             <div class="col-sm-2"><button onclick="setnameOflistinModal(8,'Supervisor1Txt')" type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#DropdownList"><i class="fa big-icon fa-pencil icon-wrap"></i></button></div>
                                       </div>
                                    </div>
                                  

                                    <div class="form-group">
                                       <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Supervisor2</label>
		                                </div>
    		                             <div class="col-sm-6">
                                            
                                              <input name="Supervisor2Txt" type="text" class="form-control" disabled="" /> 
                                             
                                            </div>
                                         <div class="col-sm-2"><button onclick="setnameOflistinModal(9,'Supervisor2Txt')" type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#DropdownList"><i class="fa big-icon fa-pencil icon-wrap"></i></button></div>
                                     </div>
                                    </div>

                                    <div class="form-group">
                                       <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Supervisor3</label>
		                                </div>
    		                             <div class="col-sm-6">
                                           
                                             <input name="Supervisor3Txt" type="text" class="form-control" disabled=""/> 
                                                
                                         </div>
                                          <div class="col-sm-2"><button onclick="setnameOflistinModal(10,'Supervisor3Txt')" type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#DropdownList"><i class="fa big-icon fa-pencil icon-wrap"></i></button></div>
                                     </div>
                                    </div>

                                    <div class="form-group">
                                      <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Supervisor4</label>
		                                </div>
    		                             <div class="col-sm-6">
                                           <input name="Supervisor4Txt" type="text" class="form-control" disabled="" /> 
                                               
                                          
                                         </div>
                                          <div class="col-sm-2"><button onclick="setnameOflistinModal(11,'Supervisor4Txt')" type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#DropdownList"><i class="fa big-icon fa-pencil icon-wrap"></i></button></div>
                                     </div>
                                    </div>

                                    <div class="form-group">
                                     <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Supervisor5</label>
		                                </div>
    		                             <div class="col-sm-6">
                                           
                                            <input name="Supervisor5Txt" type="text" class="form-control" disabled="" /> 
                                            
                                            
                                         </div>
                                          <div class="col-sm-2"><button onclick="setnameOflistinModal(12,'Supervisor5Txt')" type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#DropdownList"><i class="fa big-icon fa-pencil icon-wrap"></i></button></div>
                                     </div>
                                    </div>

                                     


                                      <div class="form-group">
                                          <div class="row">
                                          <div class="col-sm-9">
                                          <div class="login-horizental cancel-wp pull-right">
                                          
                                          <button id="SupervisorButton" class="btn btn-sm btn-primary login-submit-cs" type="submit">Save Change</button>
                                          </div>
                                          </div>
                                          </div>
                                      </div>

                                 </div>
                              
		             
                                  </div>
                               </div>
                         
                                    
                       <div id="state" class="tab-pane">
                          <label></label>
                           

                               <div class="row">
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                   
                                    <div class="form-group">

                                        <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Status: </label>
                                        </div>
                                         <div class="col-sm-4">
                                            
                                             
                                              <p name="activeQuestiontext" ></p>
                                          
                                         </div>
                                          
                                     </div>
                                     </div>
                                   

                                     <div class="form-group">

                                        <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Billable: </label>
                                        </div>
                                         <div class="col-sm-4">

                                             <input name="BillableQuestiontext" type="text" class="form-control" disabled="" />
                                           
                                           
                                         </div>
                                            <?php $AccessType=$_SESSION['AccesType']; if($AccessType=="SuperAdmin"){ ?>
                                          <div class="col-sm-2"><button onclick="setnameOflistinModal(14,'BillableQuestiontext')" type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#DropdownList"><i class="fa big-icon fa-pencil icon-wrap"></i></button></div>
                                            <?php } ?>
                                     </div>
                                     </div>
                                    
                                    <div class="form-group">

                                        <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Tenure: </label>
                                        </div>
                                         <div class="col-sm-4">
                                           
                                            <input name="Tenuritytext" type="text" class="form-control" disabled="" />
                                              
                                            
                                         </div>
                                         <?php  if($AccessType=="SuperAdmin"){ ?>
                                          <div class="col-sm-2"><button onclick="setnameOflistinModal(15,'Tenuritytext')" type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#DropdownList"><i class="fa big-icon fa-pencil icon-wrap"></i></button></div>
                                          <?php } ?>
                                     </div>
                                     </div>

                                     <div class="form-group">
                                        <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Tenure Status: </label>
                                        </div>
                                         <div class="col-sm-4">
                                               
                                              <input name="TenureStatus" type="text" class="form-control" disabled="" />
                                         </div>
                                          <?php  if($AccessType=="SuperAdmin"){ ?>
                                          <div class="col-sm-2"><button onclick="setnameOflistinModal(16,'TenureStatus')" type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#DropdownList"><i class="fa big-icon fa-pencil icon-wrap"></i></button></div>
                                           <?php } ?>
                                     </div>

                                    </div>


                                   
                    

                                    <div class="form-group">
                                         <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">History Remarks</label>
		                                </div>
    		                             <div class="col-sm-5">
                                            <textarea name="RemarksHistory" class="form-control" id="Textarea1" rows="6"></textarea>
                                         </div>
                                     </div>
                                    </div>
                                   
                                   
                                  <div id="statusFieldsToggle">

                                   <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-3">
                                        <label name="labelInactive" class="login2 pull-right pull-right-pro"><u>Inactive Status Fields</u></label>
                                        </div>
                                     </div>
                                    </div>

                                   

                                    <div class="form-group">
                                        <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Reason for inactive status: </label>
                                        </div>
                                         <div class="col-sm-5">
                                             
                                              <p name="InactiveTxt">Not Applicable</p>
                                         </div>
                                        
                                     </div>
                                   </div>

                                   <div class="form-group">

                                        <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Last Working Day</label>
                                        </div>
                                         <div class="col-sm-5">
                                            
                                  
                                            <input name="LWDTxt" type="text" class="form-control" disabled="" />
                                      

                                         </div>
                                     </div>
                                   </div>

                                   <div class="form-group">
                                     <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Effective Date</label>
                                        </div>
                                         <div class="col-sm-5">
                                            
                        
                                             
                                            <input name="EffectivedDateTxt" type="text" class="form-control" disabled="" />
                                    

                                         </div>
                                     </div>
                                   </div>


                                  <div class="form-group">
                                     <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Expected Return Date</label>
                                        </div>
                                         <div class="col-sm-5">
                                            
                                        
                                             
                                            <input name="ReturnDateTxt" type="text" class="form-control" disabled="" />
                                       

                                         </div>
                                     </div>
                                 </div>

                                 <div class="form-group">
                                     <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Separation Date</label>
                                        </div>
                                         <div class="col-sm-5">
                                            
                                        
                                             
                                            <input name="SeparationDateTxt" type="text" class="form-control" disabled="" />
                                      

                                         </div>
                                     </div>
                                  </div>
                                
                            </div>
                                       <?php  if($AccessType=="SuperAdmin"){ ?>
                                       <div class="form-group">
                                          <div class="row">
                                          <div class="col-sm-9">
                                          <div class="login-horizental cancel-wp pull-right">
                                          
                                          <button id="Statebutton" class="btn btn-sm btn-primary login-submit-cs" type="submit">Save Change</button>
                                          </div>
                                          </div>
                                          </div>
                                      </div>
                                  <?php  } ?>

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

           <!-- Modal for list -->
            <div class="modal fade" id="DropdownList" role="dialog">
            <div id="fullwidth" class="modal-dialog">
    
             <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Drop down list</h4>
            </div>
           
            <div class="modal-body">
            <div class="container">
                <div class="row">
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="all-form-element-inner">
                               
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label class="login2 pull-right pull-right-pro">Select option : </label>
                                         </div>
                                     <div class="col-sm-5">
                                        <Select id="slectionItem" class="form-control" >
                                        </Select>
                                    </div>
                                        
                                </div>
                            </div>

                           </div>
                       </div>
                </div>
            </div>  
            </div>




            <div class="modal-footer">
           <button id="InputFieldButton" type="button" class="btn btn-default" data-dismiss="modal">Change</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
            </div>


              <!-- Modal for upload image -->
            <div class="modal fade" id="uploadPhoto" role="dialog">
            <div id="fullwidth" class="modal-dialog">
    
             <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Change photo</h4>
            </div>

             <form method="post" action="UploadSaveProfilePic.php" enctype='multipart/form-data' >
            <div class="modal-body">
            <div class="container">
                <div class="row">
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="all-form-element-inner">
                               
                            <div class="form-group">
                                <div class="row">
                                  
                                     <div class="col-sm-5">
                                        
                                        <input type="file" name="phtoFileName"  />
                                    </div>
                                        
                                </div>
                            </div>

                           </div>
                       </div>
                </div>
            </div>  
            </div>
            <div class="modal-footer">
           <button name="uploaPhotoButton" type="submit" class="btn btn-default" >Upload</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </form>
            </div>
            </div>
            </div>

            <!-- Modal for process modification -->
            <div class="modal fade" id="processModif" role="dialog">
            <div id="fullwidth" class="modal-dialog">
    
             <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Process Modification Request</h4>
            </div>
           
            <div class="modal-body">
            <div class="container">
                <div class="row">
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="all-form-element-inner">
                               
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label class="login2 pull-right pull-right-pro">Employee ID : </label>
                                         </div>
                                     <div class="col-sm-6">
                                       <label name="PmEmpID" class="login2  pull-right-pro"></label>
                                    </div>
                                        
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label class="login2 pull-right pull-right-pro">Employee Name : </label>
                                         </div>
                                     <div class="col-sm-6">
                                       <label name="PmEmpName" class="login2  pull-right-pro"></label>
                                    </div>
                                        
                                </div>
                            </div>


                           <label></label>


                             <div class="form-group">
                                <div class="row">
                                    

                                    <div class="col-sm-2">
                                       <label class="login2 pull-right  pull-right-pro">Current Process</label>
                                    </div>
                                      
                                    <div class="col-sm-5">
                                       <Select name="PmCurslectionItem" class="form-control" size="8"   >

                                       </Select>
                                    </div>
                                    

                                        
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                     <div class="col-sm-7">
                                        <button name="PmCopyContent" type="button" class="btn btn-default pull-right" >Copy content from current process</button>
                                     </div>
                                </div>
                            </div>

                               <div class="form-group">
                                <div class="row">
                                    

                                    <div class="col-sm-2">
                                       <label class="login2 pull-right  pull-right-pro">Additional/New Process</label>
                                    </div>
                                      
                                    <div class="col-sm-5">
                                            
                                        <select name="PmOptionListProcess" class="form-control">
                                           
                                        </select>
                                            
                                    </div>

                                    <div class="col-sm-2"><button name="PmAddNewProcessOnList"  type="button" class="btn btn-custon-three btn-default btn-sm" ><i class="fa big-icon fa-plus icon-wrap"></i></button></div>
                                        
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">

                                    <div class="col-sm-2">
                                       <label class="login2 pull-right  pull-right-pro"></label>
                                    </div>
                                 
                                     <div class="col-sm-5">
                                       <Select name="PmNewslectionItem" class="form-control" size="8"  >
                                       </Select>
                                    </div>

                                    <div class="col-sm-2"><button name="PmDelNewProcessOnList"  type="button" class="btn btn-custon-three btn-default btn-sm" ><i class="fa big-icon fa-trash icon-wrap"></i></button></div>
       
                                </div>
                            </div>



                             
                                 <div class="row">
                                 <div class="col-sm-2">
                                       <label class="login2  pull-right pull-right-pro">Effective Date</label>
                                </div>

                                <div class="col-sm-5">
                                <div class="form-group data-custon-pick" id="data_1">
                                  <div class="input-group date">  
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input name="PmEfctvDate" type="text" class="form-control" value="" />
                                  </div>    
                                </div>
                                </div>

                            </div>
                          

                           <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                       <label class="login2 pull-right  pull-right-pro">Short Remarks</label>
                                    </div>
                                    <div class="col-sm-5">
                                     <input name="PmShrtRemarks" type="text" class="form-control" /> 
                                    </div>
                                </div>
                         
                              </div>

                       </div>
                </div>
            </div>  
            </div>




            <div class="modal-footer">
            
           <button name="SubmitProcessModif" type="button" class="btn btn-default" >Submit</button>
           
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
     <!-- notification JS
        ============================================ -->
    <script src="js/notifications/Lobibox.js"></script>
    <script src="js/notifications/notification-active.js"></script>
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



             //start global variable

             var dataResources=<?php echo json_encode( $_SESSION['IndividualInfo']); ?>;
             var userName=<?php  echo json_encode($_SESSION['LastName'].", ".$_SESSION['FirstName']); ?>;
             var listdatasource=[];
             
             var currentFieldCmList="";
            //end global variable


       
       
        $(document).ready(function () {
            

            

            $("#UserName").text(userName);
    

           loadIndividualInfo();
            checkIfActive(dataResources[0],dataResources[25],dataResources[30]);
            getProfilePhotoForViewing(dataResources[0]);

            function loadIndividualInfo(){


              
                var LocationFloorBuildingLoop=0;

                $("#NameofInfo").text(dataResources[0] +" "+ dataResources[3] +", "+dataResources[1] + " " + dataResources[2] );
                $("#EmailOfInfo").text(dataResources[18]);
                $("#positionInfo").text(dataResources[7]);

                //All info fields

                  var columnName=['employeeIDtxt','Fnametxt','Mnametxt','Lnametxt','AcoountNameTxt','ProcessSelectTxt','BandwidthTxt','PositionTxt','AssignmentTxt','hiredDate','LocationTxt','BldgNameTxt','FloorTxt','BatchWaveTxt','ChannelTxt','NetworkIDTxt','UserIDTxt','AvayaIDTxt','IEXIDTxt','BadgeIDTxt','CompanyEmailAddressTxt','OtherEmailAddressTxt','Supervisor1Txt','Supervisor2Txt','Supervisor3Txt','Supervisor4Txt','Supervisor5Txt','activeQuestiontext','BillableQuestiontext','Tenuritytext','TenureStatus','RemarksHistory'];


                //All info fields
                   

                   for(var j=0;j < columnName.length;j++ ){

                      var columnNameVal="[name="+ columnName[j] +"]";
                      if (columnName[j] =="ProcessSelectTxt"){
                         $(columnNameVal).empty();
                      }else{

                        $(columnNameVal).val("");

                      }
                      
                }



               var index=0;

                for(var a=0;a < columnName.length;a++ ){
                    
                   var columnNameVal="[name="+ columnName[a] +"]";

                    if (columnName[a] != "LocationTxt" && columnName[a] != "BldgNameTxt" && columnName[a] != "FloorTxt" && columnName[a] != "activeQuestiontext" && columnName[a] != "BillableQuestiontext"  && columnName[a] != "ProcessSelectTxt" ){
                    
                  

                        $(columnNameVal).val(dataResources[index]); 
                    
                    

                   
                    index++;
                }else if(columnName[a] == "ProcessSelectTxt"){

                    var processAppendString="";

                    var splitData=dataResources[index];
                    var arraysplitData=splitData.split("/");

                    for(var i=0;i < arraysplitData.length;i++){

                        processAppendString=processAppendString+'<option>'+arraysplitData[i]+'</option>';


                    }

                    
                     $(columnNameVal).append(processAppendString);
                     index++;
                }else if(columnName[a] == "LocationTxt" || columnName[a] == "BldgNameTxt" || columnName[a] == "FloorTxt" ){

                    var splitData=dataResources[index];
                    var arraysplitData=splitData.split("-");

                    if(columnName[a] == "LocationTxt"){
                        if (arraysplitData[0] != null && arraysplitData[0] != ""){

                               
                            $(columnNameVal).val(arraysplitData[0]); 
                            
                            
                            
                        }
                        LocationFloorBuildingLoop++;
                    }else if(columnName[a] == "BldgNameTxt"){
                         if (arraysplitData[1] != null && arraysplitData[1] != ""){
                           
                              
                            $(columnNameVal).val(arraysplitData[1]); 
                             
                       
                        }
                        LocationFloorBuildingLoop++;
                    }else if(columnName[a] == "FloorTxt"){

                         if (arraysplitData[2] != null && arraysplitData[2] != ""){
                            
                            $(columnNameVal).val(arraysplitData[2]); 
                     

                    }
                    LocationFloorBuildingLoop++;

                }

                    if ( LocationFloorBuildingLoop==3 ){

                         index++;
                          
                    }

                }else if(columnName[a] == "activeQuestiontext" ){

                    if(dataResources[index]==1){

                        $(columnNameVal).text("Active");
                    }else{

                        $(columnNameVal).text("Inactive");
                    }

                      index++;

                }else if(columnName[a] == "BillableQuestiontext" ){

                     if(dataResources[index]==1){

                        $(columnNameVal).val("Yes");
                    }else{

                        $(columnNameVal).val("No");
                    }

                      index++;


                

                }

               

            }


     
        }
        

      

            $('#InfoAddnewbutton').click(function () {
                window.location = 'emrgst.aspx';
            });


            //get profile photo
            function getProfilePhotoForViewing(empIdVal){

                var fileType="";

                $.ajax({
                url: 'php/empInfoAllFunction.php',
                data:{functionNumber:10,EmpId2:empIdVal},
                type: 'post',
                success: function(data){
                        
                       
                         var fileType=JSON.parse(data);

                       
                    }

                });

                $.ajax({
                url: 'php/empInfoAllFunction.php',
                data:{functionNumber:2,EmpId:empIdVal},
                type: 'post',
                success: function(data){
                        
                       
                         var dataValue=data;

                         if (dataValue==null || dataValue=='' ){

                         $("#profilePic").attr('src','img/user_login__115485.png');

                         }else{

                           // $("#profilePic").attr('src',dataValue);
                         $("#profilePic").attr('src','data:image/'+fileType+';base64,'+dataValue);
                        }
                    }

                });


            }
            //get profile photo




            $("#InputFieldButton").click(function(){

                 $("[name="+currentFieldCmList+"]").val($("#slectionItem").val());

            });

            //Process Modification Request Start

            $("[name=EditProcessButton]").click(function(){

                    var appendString="";

                      $("[name=PmCurslectionItem]").empty();
                      $("[name=PmNewslectionItem]").empty();

                      $("[name=PmEfctvDate]").val("");  
                      $("[name=PmShrtRemarks]").val("");

                      $("[name=PmEmpID]").text($("[name=employeeIDtxt]").val());
                      $("[name=PmEmpName]").text($("[name=Lnametxt]").val()+", "+ $("[name=Fnametxt]").val()+" "+$("[name=Mnametxt]").val());

                     $("[name=ProcessSelectTxt] option").each(function(){

                        appendString=appendString+"<option>"+$(this).val()+"</option>";

                     });
                     

                $("[name=PmCurslectionItem]").append(appendString);


                    
                     

                    $.ajax({
                    url: 'php/empInfoAllFunction.php',
                    data:{functionNumber:7},
                    type: 'post',
                    success: function(data){
                        var dataSource=[];
                        dataSource=JSON.parse(data);

                    appendString="";
                     $("[name=PmOptionListProcess]").empty();
                     for(var a=0; a < dataSource.length; a ++){

                        appendString=appendString + "<option>" +dataSource[a]+ "</option>";

                     }


                     $("[name=PmOptionListProcess]").append(appendString);

                    }

                    });

                     
                 
            });

        

            $("[name=PmCopyContent]").click(function(){

                  var appendString="";

                      $("[name=PmNewslectionItem]").empty();

                     $("[name=PmCurslectionItem] option").each(function(){

                        appendString=appendString+"<option>"+$(this).val()+"</option>";

                     });
                     

                     $("[name=PmNewslectionItem]").append(appendString);

              });


             $("[name=PmDelNewProcessOnList]").click(function(){

             var deletedVal=$("[name=PmNewslectionItem]").prop('selectedIndex',$("[name=PmNewslectionItem] option:selected").index()).val();

             var appendString="";
            

              $("[name=PmNewslectionItem] option").each(function(){

                    if(deletedVal != $(this).val()){

                        appendString=appendString+"<option>" +$(this).val()+ "</option>";
                    }

             });

               $("[name=PmNewslectionItem]").empty();
               $("[name=PmNewslectionItem]").append(appendString);

             });


              $("[name=PmAddNewProcessOnList]").click(function(){

                var selectedValue=$("[name=PmOptionListProcess]").val();
                var appendString="";
                var AlreadyExist=false;

              $("[name=PmNewslectionItem] option").each(function(){

                    if(selectedValue == $(this).val()){

                        AlreadyExist=true;
                    }

             });

              if(!AlreadyExist){

               appendString=appendString+"<option>" + selectedValue + "</option>"; 
              }
               
               
               $("[name=PmNewslectionItem]").append(appendString);


              });


              //Submit process modification request

              $("[name=SubmitProcessModif]").click(function(){


                 if ($("[name=PmEmpID]").text() != "" && $("[name=PmEmpName]").text() != ""  && $("[name=PmNewslectionItem] option").size() > 0 && $("[name=PmEfctvDate]").val() != "" && $("[name=PmShrtRemarks]").val() != "" ){

                        var validDateFormat=/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|[12][0-9]|3[01])[\/\-]\d{4}$/;
                        var DateVal=$("[name=PmEfctvDate]").val();
                        if(DateVal.match(validDateFormat)){

                            var DataTobeInsert=[];

                            DataTobeInsert[0]=$("[name=PmEmpID]").text();
                          
                            var implodeProcess="";
                            var index=1;
                            $("[name=PmNewslectionItem] option").each(function(){

                             if(index==1){

                                implodeProcess=$(this).val();

                             }else{

                                 implodeProcess=implodeProcess+"/"+$(this).val();
                             }

                             index++;

                            
                            

                            });
                            
                            DataTobeInsert[1]=implodeProcess;
                            DataTobeInsert[2]=$("[name=PmEfctvDate]").val();
                            DataTobeInsert[3]=<?php echo json_encode($_SESSION['EmployeeID']); ?>;
                            DataTobeInsert[4]=$("[name=PmShrtRemarks]").val();

                              $.ajax({
                                url: 'php/empInfoAllFunction.php',
                                data:{functionNumber:3,implodeDataArray:DataTobeInsert},
                                type: 'post',
                                success: function(data){

                                    var result=JSON.parse(data);

                                if(result==1){

                                        alert("Process modification request was successfully saved.");

                                    }else{

                                         alert("Error on saving the request modification");
                                    }

                                },
                                error:function(){

                                     alert("Error on saving the request modification");
                                }

                            });

                        }else{

                            alert("Error - Effective Date field was not on required format");

                        }

                 }else{

                    alert("Please fill up all fields!");

                 }

                      


              });


              //Submit process modification request end
        

                //Primary Info Update

              $("#PrimInfoButton").click(function(){

                    if($("[name=employeeIDtxt]").val() !="" &&   $("[name=Fnametxt]").val() != "" && $("[name=Mnametxt]").val() != "" && $("[name=Lnametxt]").val() != "" && $("[name=ProcessSelectTxt] option").size() > 0 &&  $("[name=BandwidthTxt]").val() !=0 &&  $("[name=PositionTxt]").val() !="" && $("[name=AssignmentTxt]").val() != "" && $("[name=hiredDate]").val() != "" &&  $("[name=LocationTxt]").val() != "" && $("[name=BldgNameTxt]").val() != "" && $("[name=FloorTxt]").val() != "" && $("[name=BatchWaveTxt]").val() != "" &&  $("[name=ChannelTxt]").val() != ""){

                        var validDateFormat=/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|[12][0-9]|3[01])[\/\-]\d{4}$/;
                        var validDateFormat2=/^\d{4}[\/\-](0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|[12][0-9]|3[01])$/;
                        var DateVal=$("[name=hiredDate]").val();
                        var fieldsArray=["employeeIDtxt","Fnametxt","Mnametxt","Lnametxt","BandwidthTxt","PositionTxt","AssignmentTxt","hiredDate","LocationTxt","BldgNameTxt","FloorTxt","BatchWaveTxt","ChannelTxt"];
                        if(DateVal.match(validDateFormat) || DateVal.match(validDateFormat2)){
                            
                            var DataTobeInsert=[];
                            var LocationWStr="";
                            var index=0;

                           for(var a=0; a < fieldsArray.length;a++){

                                if(a >= 8 && a<=10){
                                if(a==8){
                                    LocationWStr= $("[name="+fieldsArray[a]+"]").val();     
                                }else{
                                    LocationWStr=LocationWStr+"-"+$("[name="+fieldsArray[a]+"]").val();
                                }
                               
                               if(a==10){
                                 DataTobeInsert[index]=LocationWStr;
                                index++; 

                               }

                                }else{

                                DataTobeInsert[index]=$("[name="+fieldsArray[a]+"]").val();
                                index++;    
                                }
                                
                           }

                         
                            
                              $.ajax({
                                url: 'php/empInfoAllFunction.php',
                                data:{functionNumber:4,DataArray1:DataTobeInsert},
                                type: 'post',
                                success: function(data){

                                var result=JSON.parse(data);

                                    if(result.length-1 > 0){
                                    
                                    
                                     dataResources=result;
                                      loadIndividualInfo(); 
                                     

                                    alert("Primary record was successfully updated.");
                                    }else{
                                       
                                    alert("Error on updating information");

                                    }

                                }

                              });


                              

                        }else{

                            alert("Error - Effective Date field was not on required format");

                        }


                    }else{

                        alert("Please fill up all fields!");

                    }





              });

             //Primary Info Update end

             //Credentials Info Update

                 $("#CredentialsButton").click(function(){

                    if(($("[name=NetworkIDTxt]").val() !="" || $("[name=NetworkIDTxt]").val() =="-") &&   ($("[name=UserIDTxt]").val() != "" || $("[name=UserIDTxt]").val() =="-") && ($("[name=AvayaIDTxt]").val() != "" || $("[name=AvayaIDTxt]").val() == "-") && ($("[name=IEXIDTxt]").val() != "" || $("[name=IEXIDTxt]").val() == "-" ) && ($("[name=BadgeIDTxt]").val() != "" || $("[name=BadgeIDTxt]").val() == "-") && ($("[name=CompanyEmailAddressTxt]").val() !="" || $("[name=CompanyEmailAddressTxt]").val() =="-") &&  ($("[name=OtherEmailAddressTxt]").val() !="" || $("[name=OtherEmailAddressTxt]").val() =="-") ){

                              var validDateFormat=/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9])+\.)+([a-zA-Z0-9]{2,4})+$/;
                              var EmailVal1=$("[name=CompanyEmailAddressTxt]").val();
                              var EmailVal2=$("[name=OtherEmailAddressTxt]").val();
                              var fieldsArray=["NetworkIDTxt","UserIDTxt","AvayaIDTxt","IEXIDTxt","BadgeIDTxt","CompanyEmailAddressTxt","OtherEmailAddressTxt"];
                              if(EmailVal1.match(validDateFormat)  || EmailVal1=="-"){
                              if(EmailVal2.match(validDateFormat)  || EmailVal2=="-"){
                                var DataTobeInsert=[];

                                     for(var a=0; a < fieldsArray.length;a++){

                                        DataTobeInsert[a]=$("[name="+fieldsArray[a]+"]").val();

                                     }

                              $.ajax({
                                url: 'php/empInfoAllFunction.php',
                                data:{functionNumber:5,DataArray2:DataTobeInsert,EmpIDIndi:dataResources[0]},
                                type: 'post',
                                success: function(data){

                                var result=JSON.parse(data);

                                    if(result.length-1 > 0){
                                    
                                    
                                     dataResources=result;
                                     loadIndividualInfo(); 
                                     
                                    alert("Credentials record was successfully updated.");

                                    }else{
                                       
                                    alert("Error on updating information");

                                    }

                                }

                              });

                                }else{

                            alert("Error - Email field was not on required format,if not applicable encode -");

                            }

                              }else{

                            alert("Error - Email field was not on required format,if not applicable encode -");

                            }


                         }else{

                        alert("Please fill up all fields,if not applicable encode -");

                    }

                });
            //Credentials Info Update end



            //Hierarchy Info Update

             $("#SupervisorButton").click(function(){

                    
                    if(($("[name=Supervisor1Txt]").val() !="" || $("[name=Supervisor1Txt]").val() =="-") && ($("[name=Supervisor2Txt]").val() !="" || $("[name=Supervisor2Txt]").val() =="-") && ($("[name=Supervisor3Txt]").val() !="" || $("[name=Supervisor3Txt]").val() =="-") && ($("[name=Supervisor4Txt]").val() !="" || $("[name=Supervisor4Txt]").val() =="-") && ($("[name=Supervisor5Txt]").val() !="" || $("[name=Supervisor5Txt]").val() =="-")){

                     var fieldsArray=["Supervisor1Txt","Supervisor2Txt","Supervisor3Txt","Supervisor4Txt","Supervisor5Txt"];

                     var DataTobeInsert=[];

                    for(var a=0; a < fieldsArray.length;a++){

                        DataTobeInsert[a]=$("[name="+fieldsArray[a]+"]").val();

                    }

                      $.ajax({
                                url: 'php/empInfoAllFunction.php',
                                data:{functionNumber:6,DataArray3:DataTobeInsert,EmpIDIndi2:dataResources[0]},
                                type: 'post',
                                success: function(data){

                                var result=JSON.parse(data);

                                    if(result.length-1 > 0){
                                    
                                    
                                     dataResources=result;
                                     loadIndividualInfo(); 
                                     

                                      alert("Hierarchy record was successfully updated.");

                                    }else{
                                       
                                    alert("Error on updating information");

                                    }

                                }

                    });      


                    }else{


                        alert("Please fill up all fields,if not applicable encode -");

                    }


                });

             
                  //Hierarchy Info Update end

                function checkIfActive(EmpID,stat,staVal){
                      
                    if(stat==0 || stat=="0" ){

                         $("[name=InactiveTxt]").text(staVal);
                         $("[name=InactiveTxt]").show();
                        $.ajax({

                                url: 'php/empInfoAllFunction.php',
                                data:{functionNumber:9,EmpIDStatInfo:EmpID,checlstatusCat:staVal},
                                type: 'post',
                                success: function(data){

                                var result=JSON.parse(data);
                               
                                if(result[0]=="Leave of absences" || result[0]=="Request for RTWO" || result[0]=="Leave with Pay"){
                                    
                                    $("[name=LWDTxt]").val(result[1]);
                                    $("[name=EffectivedDateTxt]").val(result[2]);
                                    $("[name=ReturnDateTxt]").val(result[3]);
                                  
                                   
                                    $("[name=LWDTxt]").show();
                                    $("[name=EffectivedDateTxt]").show();
                                    $("[name=ReturnDateTxt]").show();

                                     if(result[0]=="Request for RTWO"){
                                        $("[name=ReturnDateTxt]").hide();
                                    }
                                }else if(result[0]=="Separated"){

                                    $("[name=LWDTxt]").val(result[1]);
                                    $("[name=EffectivedDateTxt]").val(result[2]);
                                    $("[name=SeparationDateTxt]").val(result[3]);
                                   
                                   
                                    $("[name=LWDTxt]").show();
                                    $("[name=EffectivedDateTxt]").show();
                                    $("[name=SeparationDateTxt]").show();

                                }else{

                                }
                            
                            }

                   });
                            
                     

                    }else{

                        $("#statusFieldsToggle").hide();
                    }
                }

        });
    

        //For dropdown list data init

        function setnameOflistinModal(arraySelected,nameOffields){

                currentFieldCmList=nameOffields;
                $("#slectionItem").empty();
                listdatasource=[];
                
                switch(arraySelected){

                    case 1:
                      
                    getBandwidthList(1,"");
                    break;
                    case 2:
                     $("[name=ProcessSelectTxt] option").each(function(){
                       var currentProcess=$(this).val();
                     
                    getBandwidthList(2,currentProcess);

                    });
                    break;

                    case 3:
                    
                    
                     $("[name=ProcessSelectTxt] option").each(function(){
                       var currentProcess=$(this).val();
                    
                    getBandwidthList(3,currentProcess);

                    });
                    
                    break;
                    
                    case 4:
                    
                    getBandwidthList(4,"");

                    break;
                    case 5:
                     
                    getBandwidthList(5,"");
                    break;
                    case 6:
                     
                    getBandwidthList(6,"");
                    break;
                    case 7:
                    getBandwidthList(7,"");
                    break;
                    case 8:

                    var getProcess=dataResources[5];
                    var tokenVal=getProcess.split("/");
                     for(var i=0;i < tokenVal.length;i++){
                    getBandwidthList(8,tokenVal[i]);
                     }
                    break;
                    case 9:
                     var getProcess=dataResources[5];
                    var tokenVal=getProcess.split("/");
                     for(var i=0;i < tokenVal.length;i++){
                     getBandwidthList(9,tokenVal[i]);
                     }
                    break;
                    case 10:
                     var getProcess=dataResources[5];
                    var tokenVal=getProcess.split("/");
                     for(var i=0;i < tokenVal.length;i++){
                     getBandwidthList(10,tokenVal[i]);
                     }
                    break;
                    case 11:
                     var getProcess=dataResources[5];
                    var tokenVal=getProcess.split("/");
                     for(var i=0;i < tokenVal.length;i++){
                     getBandwidthList(11,tokenVal[i]);
                     }
                    break;
                    case 12:
                    var getProcess=dataResources[5];
                    var tokenVal=getProcess.split("/");
                     for(var i=0;i < tokenVal.length;i++){
                     getBandwidthList(12,tokenVal[i]);
                     }
                    break;
                    case 13:
                    getBandwidthList(13,"");
                    break;
                    case 14:
                    getBandwidthList(14,"");
                    break;
                    case 15:
                    getBandwidthList(15,"");
                    break;
                    case 16:
                    getBandwidthList(16,"");
                    break;
                    
                }

                
              
              


        }

       





          function getBandwidthList(val1,val2){

                var selectedString=val1;
                var WherecolumnVal1=val2;
              
                var dataSource=[];


                 $.ajax({
                url: 'php/empInfoAllFunction.php',
                data:{functionNumber:1,selctedString:selectedString,Wherecolumn:WherecolumnVal1},
                type: 'post',
                success: function(data){

                var dataValue=JSON.parse(data);
                
                var index=listdatasource.length;
                var primIndex=0;

                for (var a=0;a < dataValue.length;a++){
                    var iterate=true;
                    var notExist=false;
                    var b=0;

                    while(iterate){
                    
                    if(b <= listdatasource.length){

                    if (listdatasource[b]==dataValue[a]){
                        iterate=false;
                        notExist=true;

                    }

                    b++;

                    }else{

                      iterate=false;  

                    }

                    }
                    
             
                   if (notExist==false){

                    listdatasource[index]=dataValue[a];
                    dataSource[primIndex]=dataValue[a]
                    index++;
                    primIndex++;
                    }                  
                
                }    
                
                

                var appendstring="";

               

                for(var j=0;j < dataSource.length;j++){

                   
                     
                appendstring=appendstring+"<option>"+dataSource[j]+"</option>";


               }   

              $("#slectionItem").append(appendstring);
             

           
                }

            });
              
            }

             //For dropdown list data init
          

               




    </script>
    

</body>
</html>
