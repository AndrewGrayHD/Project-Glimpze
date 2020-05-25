

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
<!--<?php include "php/empRegistrationFunction.php" ?>-->

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
															<span class="admin-name">De Gracia, John Andrew</span>
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
                        <div class="all-form-element-inner">
                            
                            <div class="form-group">
                               <div class="row">
                                   <div class="col-sm-7">
                                      <h3>Employee Registration</h3>
                                   </div>
                               </div>
                            </div>

                            <label></label>

                            
                                <div class="form-group">
                                    <div class="row">
                                        
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Employee ID</label>
		                                </div>

    		                            <div class="col-sm-3">
      		                            <input type="text" class="form-control" name="NewEmpID"/>
                                        </div>

                                        <div class="col-sm-2">
                                              <button type="button" id="refreshButton" class="btn btn-custon-three btn-default btn-md "><i class="fa big-icon fa-refresh icon-wrap"></i></button>
                                          </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">First Name</label>
		                                </div>

    		                            <div class="col-sm-5">
      		                            <input type="text" class="form-control" name="NewFname" />
                                        </div>
                                    </div>
                                  </div>

                                   <div class="form-group">
                                    <div class="row">
                                        
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Middle Name</label>
		                                </div>

    		                            <div class="col-sm-5">
      		                            <input type="text" class="form-control" name="NewMname" />
                                        </div>
                                    </div>
                                  </div>

                                 <div class="form-group">
                                    <div class="row">
                                        
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Last Name</label>
		                                </div>

    		                            <div class="col-sm-5">
      		                            <input type="text" class="form-control" name="NewLname" />
                                        </div>
                                    </div>
                                  </div>

                                   <div class="form-group">
                                    <div class="row">
                                        
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Account Name</label>
                                        </div>

                                        <div class="col-sm-5">
                                        <input type="text" class="form-control" name="NewAccountname" disabled="" />
                                        </div>
                                    </div>
                                  </div>


                                 <div class="form-group">
                                     <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Process</label>
		                                </div>

    		                             <div class="col-sm-5">
                                         <select name="NewProcessModif" class="form-control" multiple="multiple" size="6" disabled="">
                                         </select> 
                                         </div>
                                         
                                       
                                        <div class="col-sm-2"> <button  type="button" id="NewProcessModifAndAccountName" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#processModif"><i class="fa big-icon fa-pencil icon-wrap"></i></button></div>
                                     </div>
                                </div>

                                <div class="form-group">
                                     <div class="row">
                                     <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Bandwidth</label>
		                                </div>
    		                            <div class="col-sm-5">
                                         <input type="text" name="NewBandwidth" class="form-control" disabled="" />   
                                         </div>

                                         <div class="col-sm-2"> <button onclick="setnameOflistinModal(1,'NewBandwidth')"  type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#DropdownList"><i class="fa big-icon fa-pencil icon-wrap"></i></button></div>

                                    </div>
                                </div>
                                
                              <div class="form-group">
                                <div class="row">
                                     <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Position</label>
		                                </div>

    		                            <div class="col-sm-5">
                                        <input type="text" name="NewPosition" class="form-control" disabled="" />   
                                        </div>

                                         <div class="col-sm-2"> <button onclick="setnameOflistinModal(2,'NewPosition')"  type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#DropdownList"><i class="fa big-icon fa-pencil icon-wrap"></i></button></div>

                                    </div>
                               </div>
                               
                                <div class="form-group">
                                <div class="row">
                                     <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Assignment</label>
		                                </div>
    		                             <div class="col-sm-5">
                                         <input type="text" name="NewAssignment" class="form-control" disabled="" />   
                                         </div>

                                         <div class="col-sm-2"> <button onclick="setnameOflistinModal(3,'NewAssignment')"  type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#DropdownList"><i class="fa big-icon fa-pencil icon-wrap"></i></button></div>

                                    </div>
                               </div>

                                  <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Hired Date</label>
		                                </div>
    		                             <div class="col-sm-5">
                                            
                                        <div class="form-group data-custon-pick" id="data_1">
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" name="NewHiredDate" class="form-control" value="" />
                                        </div>
                                        </div>

                                         </div>
                                     </div>

                                <div class="form-group">
                                <div class="row">
                                     <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Location</label>
		                                </div>
    		                            <div class="col-sm-5">
                                         <input type="text" name="NewLocation" class="form-control" disabled="" />   
                                         </div>

                                         <div class="col-sm-2"> <button onclick="setnameOflistinModal(4,'NewLocation')"  type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#DropdownList"><i class="fa big-icon fa-pencil icon-wrap"></i></button></div>

                                    </div>
                               </div>

                               <div class="form-group">
                                      <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Batch/Wave</label>
		                                </div>
    		                             <div class="col-sm-5">
                                            <input type="text" name="NewBatch" class="form-control" />
                                         </div>
                                     </div>
                                 </div>

                                <div class="form-group">
                                <div class="row">
                                     <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Channel</label>
		                                </div>
    		                             <div class="col-sm-5">
                                         <input type="text" name="NewChannel" class="form-control" disabled="" />   
                                         </div>

                                          <div class="col-sm-2"> <button onclick="setnameOflistinModal(5,'NewChannel')"  type="button" class="btn btn-custon-three btn-default btn-sm" data-toggle="modal" data-target="#DropdownList"><i class="fa big-icon fa-pencil icon-wrap"></i></button></div>

                                    </div>
                               </div>

                               <div class="form-group">
                                      <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Network/LAN ID</label>
		                                </div>
    		                             <div class="col-sm-5">
                                            <input type="text" name="NewLANID" class="form-control" />
                                         </div>
                                     </div>
                                 </div>

                               <div class="form-group">
                                      <div class="row">
                                        <div class="col-sm-3">
                                        <label class="login2 pull-right pull-right-pro">Company Email Address</label>
		                                </div>
    		                             <div class="col-sm-5">
                                            <input type="text" name="NewCmpnyemailAddress" class="form-control" />
                                         </div>
                                     </div>
                                 </div>

                          
                           
                                     
                            

                                     <div class="form-group">
                                          <div class="row">
                                          <div class="col-sm-9">
                                          <div class="login-horizental cancel-wp pull-right">
                                          
                                          <button class="btn btn-lg btn-primary login-submit-cs" type="submit" id="saveNewEmployee"><i class="fa big-icon fa-save icon-wrap"></i></button>
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


               <!-- Modal for process modification -->
            <div class="modal fade" id="processModif" role="dialog">
            <div id="fullwidth" class="modal-dialog">
    
             <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Process Modification</h4>
            </div>
           
            <div class="modal-body">
            <div class="container">
                <div class="row">
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="all-form-element-inner">
                               
                        
                               <div class="form-group">
                                <div class="row">
                                    

                                    <div class="col-sm-2">
                                       <label class="login2 pull-right  pull-right-pro">Account List</label>
                                    </div>
                                      
                                    <div class="col-sm-5">
                                            
                                        <select name="NewAccountOptionListProcess" class="form-control">
                                           
                                        </select>
                                            
                                    </div>

                                        
                                </div>
                            </div>


                               <div class="form-group">
                                <div class="row">
                                    

                                    <div class="col-sm-2">
                                       <label class="login2 pull-right  pull-right-pro">Process List</label>
                                    </div>
                                      
                                    <div class="col-sm-5">
                                            
                                        <select name="NewOptionListProcess" class="form-control">
                                           
                                        </select>
                                            
                                    </div>

                                    <div class="col-sm-2"><button name="AddNewProcessOnList"  type="button" class="btn btn-custon-three btn-default btn-sm" ><i class="fa big-icon fa-plus icon-wrap"></i></button></div>
                                        
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">

                                    <div class="col-sm-2">
                                       <label class="login2 pull-right  pull-right-pro"></label>
                                    </div>
                                 
                                     <div class="col-sm-5">
                                       <Select name="NewslectionItem" class="form-control" size="8"  >
                                       </Select>
                                    </div>

                                    <div class="col-sm-2"><button name="NewDeleteProcessOnList"  type="button" class="btn btn-custon-three btn-default btn-sm" ><i class="fa big-icon fa-trash icon-wrap"></i></button></div>
       
                                </div>
                            </div>



                       </div>
                </div>
            </div>  
            </div>




            <div class="modal-footer">
            
           <button name="SubmitProcessModif" type="button" class="btn btn-default"  data-dismiss="modal">Insert</button>
           
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

         var userName=<?php  echo json_encode($_SESSION['LastName'].", ".$_SESSION['FirstName']); ?>;

         $(document).ready(function () {

            $("#UserName").text(userName);
             $("[name=NewBatch]").val("Batch-");
            $("#NewProcessModifAndAccountName").click(function(){

                setnameOflistinModal(0,"");
                setnameOflistinModal(6,"");
            });

            $("#InputFieldButton").click(function(){
                $("[name="+selectedField+"]").val($("#slectionItem").val());
            });


            $("[name=NewDeleteProcessOnList]").click(function(){

             var deletedVal=$("[name=NewslectionItem]").prop('selectedIndex',$("[name=NewslectionItem] option:selected").index()).val();

             var appendString="";
            

              $("[name=NewslectionItem] option").each(function(){

                    if(deletedVal != $(this).val()){

                        appendString=appendString+"<option>" +$(this).val()+ "</option>";
                    }

             });

               $("[name=NewslectionItem]").empty();
               $("[name=NewslectionItem]").append(appendString);

             });


              $("[name=AddNewProcessOnList]").click(function(){

                var selectedValue=$("[name=NewOptionListProcess]").val();
                var appendString="";
                var AlreadyExist=false;

              $("[name=NewslectionItem] option").each(function(){

                    if(selectedValue == $(this).val()){

                        AlreadyExist=true;
                    }

             });

              if(!AlreadyExist){

               appendString=appendString+"<option>" + selectedValue + "</option>"; 
              }
               
               
               $("[name=NewslectionItem]").append(appendString);


              });

              
              $("[name=SubmitProcessModif]").click(function(){


                $("[name=NewAccountname]").val($("[name=NewAccountOptionListProcess]").val());

              var appendString="";
            

              $("[name=NewslectionItem] option").each(function(){

                
                        appendString=appendString+"<option>" +$(this).val()+ "</option>";
                

             });

               $("[name=NewProcessModif]").empty();
               $("[name=NewProcessModif]").append(appendString);


              });


               function FastEncodingdeleteFieldValue(){

                        $("[name=NewEmpID]").val("");
                        $("[name=NewFname]").val("");
                        $("[name=NewMname]").val("");
                        $("[name=NewLname]").val("");      
             
                        $("[name=NewLANID]").val("");
                        $("[name=NewCmpnyemailAddress]").val("");

              }

              function deleteFieldValue(){

                        $("[name=NewEmpID]").val("");
                        $("[name=NewFname]").val("");
                        $("[name=NewMname]").val("");
                        $("[name=NewLname]").val("");
                        $("[name=NewAccountname]").val("");
                        $("[name=NewProcessModif]").empty();
                        $("[name=NewBandwidth]").val("");
                        $("[name=NewPosition]").val("");
                        $("[name=NewAssignment]").val("");
                        $("[name=NewHiredDate]").val("");
                        $("[name=NewLocation]").val("");
                        $("[name=NewBatch]").val("");
                        $("[name=NewChannel]").val("");
                        $("[name=NewLANID]").val("");
                        $("[name=NewCmpnyemailAddress]").val("");

              }

              $("#saveNewEmployee").click(function(){

                if($("[name=NewEmpID]").val() !="" && $("[name=NewFname]").val() !="" && $("[name=NewMname]").val() && $("[name=NewLname]").val()!=""&& $("[name=NewAccountname]").val()!=""&& $("[name=NewProcessModif]").val()!=""&& $("[name=NewBandwidth]").val()!=""&& $("[name=NewPosition]").val()!=""&& $("[name=NewAssignment]").val()!=""&& $("[name=NewHiredDate]").val()!=""&& $("[name=NewLocation]").val()!=""&& $("[name=NewBatch]").val()!=""&& $("[name=NewChannel]").val()!=""&& $("[name=NewLANID]").val()!=""&& $("[name=NewCmpnyemailAddress]").val()!=""){

                    var validDateFormat=/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|[12][0-9]|3[01])[\/\-]\d{4}$/;
                    var validDateFormat2=/^\d{4}[\/\-](0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|[12][0-9]|3[01])$/;
                    var DateVal=$("[name=NewHiredDate]").val();

                    if(DateVal.match(validDateFormat) || DateVal.match(validDateFormat2)){
                        
                        var dataSource=[];

                        dataSource[0]=$("[name=NewEmpID]").val();
                        dataSource[1]=$("[name=NewFname]").val();
                        dataSource[2]=$("[name=NewMname]").val();
                        dataSource[3]=$("[name=NewLname]").val();
                        dataSource[4]=$("[name=NewAccountname]").val();

                        var processString="";


                        $("[name=NewProcessModif] option").each(function(){

                        if (processString==""){
                            processString=$(this).val();
                        }else{
                            processString=processString+"/"+$(this).val();
                        }
                        
                

                        });


                        dataSource[5]=processString;
                        dataSource[6]=$("[name=NewBandwidth]").val();
                        dataSource[7]=$("[name=NewPosition]").val();
                        dataSource[8]=$("[name=NewAssignment]").val();
                        dataSource[9]=$("[name=NewHiredDate]").val();
                        dataSource[10]=$("[name=NewLocation]").val();
                        dataSource[11]=$("[name=NewBatch]").val();
                        dataSource[12]=$("[name=NewChannel]").val();
                        dataSource[13]=$("[name=NewLANID]").val();
                        dataSource[14]=$("[name=NewCmpnyemailAddress]").val();

                        alert(dataSource);

                         $.ajax({
                                url: 'php/empRegistrationFunction.php',
                                data:{functionNumber:2,DatasourceNewEmployee:dataSource},
                                type: 'post',
                                success: function(data){

                                    var result=JSON.parse(data);
                                    if(result==1){
                                        alert("New employee information was successfully saved.");
                                        var fastEncoding=confirm("Keep other information for fast encoding?")
                                        if(fastEncoding){
                                            FastEncodingdeleteFieldValue();
                                        }else{
                                            deleteFieldValue();
                                        }
                                        
                                    }else if(result==2){
                                        alert("Employee information was already exist");
                                        deleteFieldValue();
                                    }else{
                                         alert("Saving information failed!");
                                    }
                                  
                                },
                                error:function(){
                                    alert("Saving information failed!");
                                }
                        });


                    }else{
                      alert("Error - Hired Date field was not on required format(M/d/yyyy)"); 
                    }

                }else{
                     alert("Please fill up all fields!");
                }

              });

              $("#refreshButton").click(function(){

                deleteFieldValue();
             

              });

         });

         var selectedField="";

         function setnameOflistinModal(listNumber,fieldSelected){

                selectedField=fieldSelected;


             $.ajax({
                                url: 'php/empRegistrationFunction.php',
                                data:{functionNumber:1,listNumberField:listNumber},
                                type: 'post',
                                success: function(data){

                                var result=JSON.parse(data);
                                  appendString="";
                                 
                                  if(listNumber != 0 && listNumber != 6 ){

                                    for(var a=0;a < result.length;a++){
                                         appendString= appendString+"<option>"+result[a]+"</option>";

                                    }

                                    $("#slectionItem").empty();
                                    $("#slectionItem").append(appendString);

                                  }else{


                                      for(var a=0;a < result.length;a++){
                                         appendString= appendString+"<option>"+result[a]+"</option>";

                                  }

                                    if(listNumber == 0){
                                    $("[name=NewOptionListProcess]").empty();
                                    $("[name=NewOptionListProcess]").append(appendString);
                                    }else{
                                    $("[name=NewAccountOptionListProcess]").empty();
                                    $("[name=NewAccountOptionListProcess]").append(appendString);
                                  }
                                }

                            }
                    

                    });      

         }



     </script>

</body>
</html>