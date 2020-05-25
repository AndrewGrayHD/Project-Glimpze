
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

<!--<?php include "php/notificationFunction.php"; ?>-->

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
                             <h1>Dashboard</h1>
                            </div>
                       </div>  
                   </div>


            
        <div class="product-sales-area mg-tb-30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <div class="product-sales-chart">
                            <div class="portlet-title">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="caption pro-sl-hd">
                                            <span class="caption-subject text-uppercase"><b>Headcount Chart</b></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="actions graph-rp">
                                            <div class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-grey">
                                                    <input type="radio" name="options" class="toggle" id="option1" checked="">Week</label>
                                                <label class="btn btn-grey active">
                                                    <input type="radio" name="options" class="toggle" id="option2">Month</label>
                                                <label class="btn btn-grey">
                                                    <input type="radio" name="options" class="toggle" id="option2">Year</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <ul class="list-inline cus-product-sl-rp">
                                <li>
                                    <h5><i class="fa fa-circle" style="color: #00b5c2;"></i>Active</h5>
                                </li>
                                <li>
                                    <h5><i class="fa fa-circle" style="color: #008efa;"></i>Inactive</h5>
                                </li>
                                <li>
                                    <h5><i class="fa fa-circle" style="color: #f75b36;"></i>Separated</h5>
                                </li>
                            </ul>
                            <div id="morris-area-chart" style="height: 356px;"></div>
                        </div>
                    </div>


                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">

                         <div class="analytics-adminpro-wrap ant-res-b-30 reso-mg-b-30">
                            <div class="skill-content-3 analytics-adminpro analytics-adminpro3">
                                <div class="skill">
                                    <div class="progress">
                                        <div class="lead-content">
                                            <h3><span class="counter">950</span></h3>
                                            <p>Productive</p>
                                        </div>
                                        <div class="progress-bar wow fadeInLeft" data-progress="95%" style="width: 82%;" data-wow-duration="1.5s" data-wow-delay="1.2s"> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="analytics-adminpro-wrap reso-mg-b-30">
                            <div class="skill-content-3 analytics-adminpro analytics-adminpro4">
                                <div class="skill">
                                    <div class="progress">
                                        <div class="lead-content">
                                            <h3>210</h3>
                                            <p>Unproductive</p>
                                        </div>
                                        <div class="progress-bar wow fadeInLeft" data-progress="85%" style="width: 18%;" data-wow-duration="1.5s" data-wow-delay="1.2s">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                           <div class="analytics-adminpro-wrap ant-res-b-30 reso-mg-b-30">
                            <div class="skill-content-3 analytics-adminpro">
                                <div class="skill">
                                    <div class="progress">
                                        <div class="lead-content">
                                            <h3><span class="counter">178</span></h3>
                                            <p>Support</p>
                                        </div>
                                        <div class="progress-bar wow fadeInLeft" data-progress="21%" style="width: 21%;" data-wow-duration="1.5s" data-wow-delay="1.2s">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                           <div class="analytics-adminpro-wrap ant-res-b-30 reso-mg-b-30">
                            <div class="skill-content-3 analytics-adminpro">
                                <div class="skill">
                                    <div class="progress">
                                        <div class="lead-content">
                                            <h3><span class="counter">80</span></h3>
                                            <p>Training</p>
                                        </div>
                                        <div class="progress-bar wow fadeInLeft" data-progress="11%" style="width: 11%;" data-wow-duration="1.5s" data-wow-delay="1.2s">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
       

            

         <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                        <table class="table table-bordered">
                            <tr>
                                <th>Process</th>
                                <th>Active</th>
                                <th>Inactive</th>
                                <th>Separated</th>
                            </tr>
                            <tr>
                                <td>Amax</td>
                                <td><label class="label bg-green">300</label></td>
                                <td><label class="label bg-blue">52</label></td>
                                <td><label class="label bg-red">20</label></td>
                            </tr>

                              <tr>
                                <td>Call Thru</td>
                                <td><label class="label bg-green">300</label></td>
                                <td><label class="label bg-blue">52</label></td>
                                <td><label class="label bg-red">20</label></td>
                            </tr>
                              <tr>
                                <td>Call Thru Delivery & Check Pickup</td>
                                <td><label class="label bg-green">300</label></td>
                                <td><label class="label bg-blue">52</label></td>
                                <td><label class="label bg-red">20</label></td>
                            </tr>
                              <tr>
                                <td>CBS Wireline</td>
                                <td><label class="label bg-green">300</label></td>
                                <td><label class="label bg-blue">52</label></td>
                                <td><label class="label bg-red">20</label></td>
                            </tr>
                              <tr>
                                <td>Centro Business - EG</td>
                                <td><label class="label bg-green">300</label></td>
                                <td><label class="label bg-blue">52</label></td>
                                <td><label class="label bg-red">20</label></td>
                            </tr>
                              <tr>
                                <td>Centro Business - SG</td>
                                <td><label class="label bg-green">300</label></td>
                                <td><label class="label bg-blue">52</label></td>
                                <td><label class="label bg-red">20</label></td>
                            </tr>
                              <tr>
                                <td>Centro Consumer Wireless - CXO</td>
                                <td><label class="label bg-green">300</label></td>
                                <td><label class="label bg-blue">52</label></td>
                                <td><label class="label bg-red">20</label></td>
                            </tr>
                              <tr>
                                <td>Centro Consumer Wireless - EC</td>
                                <td><label class="label bg-green">300</label></td>
                                <td><label class="label bg-blue">52</label></td>
                                <td><label class="label bg-red">20</label></td>
                            </tr>
                              <tr>
                                <td>Centro Consumer Wireline</td>
                                <td><label class="label bg-green">300</label></td>
                                <td><label class="label bg-blue">52</label></td>
                                <td><label class="label bg-red">20</label></td>
                            </tr>
                              <tr>
                                <td>Email Business</td>
                                <td><label class="label bg-green">300</label></td>
                                <td><label class="label bg-blue">52</label></td>
                                <td><label class="label bg-red">20</label></td>
                            </tr>
                              <tr>
                                <td>Email Consumer</td>
                                <td><label class="label bg-green">300</label></td>
                                <td><label class="label bg-blue">52</label></td>
                                <td><label class="label bg-red">20</label></td>
                            </tr>
                              <tr>
                                <td>Fizzback</td>
                                <td><label class="label bg-green">300</label></td>
                                <td><label class="label bg-blue">52</label></td>
                                <td><label class="label bg-red">20</label></td>
                            </tr>
                        </table>
                    </div>

                     <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    <table class="table table-bordered">
                            <tr>
                                <th>Alert</th>
                            </tr>
                          
                            <tr>
                                <td>No pending approval</td>
                            </tr>
                            
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

     <!-- morrisjs JS
        ============================================ -->
    <script src="js/morrisjs/raphael-min.js"></script>
    <script src="js/morrisjs/morris.js"></script>

    <!-- morrisjs JS
        ============================================ -->
    <script src="js/sparkline/jquery.sparkline.min.js"></script>
    <script src="js/sparkline/jquery.charts-sparkline.js"></script>
     <script src="js/sparkline/sparkline-active.js"></script>

    <!-- calendar JS
        ============================================ -->
    <script src="js/calendar/moment.min.js"></script>
    <script src="js/calendar/fullcalendar.min.js"></script>
    <script src="js/calendar/fullcalendar-active.js"></script>
  
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
     <!-- Charts JS
        ============================================ -->
    <script src="js/charts/Chart.js"></script>
    <script src="js/charts/line-chart.js"></script>

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
            

                 //end global variable

                $("#UserName").text(userName);

                


        Morris.Area({
        element: 'morris-area-chart',
        data: [{
            Month: 'Jan',
            Active: 0,
            Inactive: 0,
            Separated: 0
        }, {
            Month: 'Feb',
            Active: 130,
            Inactive: 100,
            Separated: 80
        }, {
            Month: 'Mar',
            Active: 80,
            Inactive: 60,
            Separated: 70
        }, {
            Month: 'Apr',
            Active: 70,
            Inactive: 200,
            Separated: 160
        }, {
            Month: 'May',
            Active: 180,
            Inactive: 150,
            Separated: 120
        }, {
            Month: 'Jun',
            Active: 105,
            Inactive: 100,
            Separated: 90
        },
         { 
            Month: 'July',
            Active: 250,
            Inactive: 150,
            Separated: 200
        },
         {
            Month: 'Aug',
            Active: 250,
            Inactive: 150,
            Separated: 200
        },
         {
            Month: 'Sep',
            Active: 250,
            Inactive: 150,
            Separated: 200
        },
         {
            Month: 'Oct',
            Active: 250,
            Inactive: 150,
            Separated: 200
        },
         {
            Month: 'Nov',
            Active: 250,
            Inactive: 150,
            Separated: 200
        },
         {
            Month: 'Dec', 
            Active: 250,
            Inactive: 150,
            Separated: 200
        }],
        xkey:  'Month',
        ykeys: ['Active', 'Inactive', 'Separated'],
        labels: ['Active', 'Inactive', 'Separated'],
        pointSize: 0,
        fillOpacity: 0.6,
        pointStrokeColors:[  '#00b5c2 ','#008efa','#f75b36'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth:0,
        hideHover: 'auto',
        lineColors: [  '#00b5c2 ','#008efa','#f75b36'],
        resize: true,
        parseTime:false




     
    });


        

         
});

            
</script>
   
    

</body>
</html>