
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

  


</head>
<body>

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
                             <h4 id="NotifTitle">Separation</h4>
                            </div>
                       </div>  
                   </div>

                  
                    <div class="row">
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <div class="all-form-element-inner">
                                  

                                

                                <div class="form-group">
                                    <div class="row">
                                        
                                        <div class="col-sm-4">
                                        <label class="login2 pull-right pull-right-pro">Employee ID</label>
                                        </div>

                                        <div class="col-sm-3">
                                         <input type="text" name="termEmpID" class="form-control" value="" placeholder="Press Enter" />
                                        
                                        </div>
                                    </div>
                                  </div>


                                  <div class="form-group">
                                    <div class="row">
                                        
                                        <div class="col-sm-4">
                                        <label class="login2 pull-right pull-right-pro">Full Name</label>
                                        </div>

                                        <div class="col-sm-5">
                                         <input type="text" name="termName" class="form-control" value="" disabled="" />
                                        </div>
                                    </div>
                                  </div>

                                
                                  
                                    
                                  <div class="form-group">

                                      <div class="row">
                                       <div class="col-sm-4">
                                        <label class="login2 pull-right pull-right-pro">Process</label>
                                        </div>
                                      
                                        <div class="col-sm-5">
                                          <select class="form-control" name="termProcess"  multiple="multiple" disabled="" >
                                                        
                                          </select>
                                        </div>
                                     
                                      </div>
                                         
                                  </div>


                                
                                <div class="form-group">

                                      <div class="row">
                                       <div class="col-sm-4">
                                        <label class="login2 pull-right pull-right-pro">Supervisor</label>
                                        </div>
                                      
                                        <div class="col-sm-5">
                                          <select class="form-control" name="termSupervisor"  multiple="multiple" disabled="" >
                                                        
                                          </select>
                                        </div>
                                     
                                      </div>
                                         
                                  </div>  

          
                            
                                    <div class="row">
                                        
                                        <div class="col-sm-4">
                                        <label class="login2 pull-right pull-right-pro">Last working day</label>
                                        </div>

                                        <div class="col-sm-5">
                                        <div class="form-group data-custon-pick" id="data_1">
                                        <div class="input-group date">
                                           
                                            <input type="text" class="form-control" name="termLWD"  />
                                             <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        </div>
                                        </div>
                                    </div>

                                      <div class="row">
                                        
                                        <div class="col-sm-4">
                                        <label class="login2 pull-right pull-right-pro">Effective Date</label>
                                        </div>

                                        <div class="col-sm-5">
                                        <div class="form-group data-custon-pick" id="data_1">
                                        <div class="input-group date">
                                           
                                            <input type="text" class="form-control" name="termEffective"  />
                                             <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                 

                                       <div class="form-group">
                                         <div class="row">
                                        <div class="col-sm-4">
                                        <label id="resonTxt" class="login2 pull-right pull-right-pro">Reason of separation</label>
                                        </div>
                                         <div class="col-sm-5">
                                            <textarea  class="form-control" name="termReasonTerm"  rows="4" placeholder="max 50 characters"></textarea>
                                            
                                         </div>
                                     </div>
                                    </div>

                                   
                            

                               <div class="form-group">
                                          <div class="row">
                                          <div class="col-sm-9">
                                          <div class="login-horizental cancel-wp pull-right">
                                          <button class="btn btn-md btn-primary login-submit-cs" id="SubmitTerm" type="submit">Submit</button>
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

            
                
                  
                

             $(document).ready(function () {

                  var userName=<?php  echo json_encode($_SESSION['LastName'].", ".$_SESSION['FirstName']); ?>;

                $("#UserName").text(userName);
                

                var retrievedValue=[];
                var IndertOrUpdate="Insert";
                
                $("[name=termEmpID]").keyup(function(event){

                if(event.keyCode==13){
                 
                     validateExistedandAutofill();
                 

                    }

                   
                });

               
                 function validateExistedandAutofill(){

                                var EmpdID=$("[name=termEmpID]").val();
                                EmptyField();
                                $("[name=termEmpID]").val(EmpdID);
                                $.ajax({
                                url: 'php/empInfoAllFunction.php',
                                data:{functionNumber:8,EmpIDforNotif:EmpdID},
                                type: 'post',
                                success: function(data){
                                     var result=JSON.parse(data);

                                     
                                if(result.length-1 > 0){

                        
                                  $("[name=termName]").val(result[0]);

                                     var processVal=result[1]
                                     var arrayProcess=processVal.split("/");

                                     var appendString="";

                                     for(var i=0;i < arrayProcess.length;i++){

                                        appendString=appendString+"<option>"+arrayProcess[i]+"</option>";


                                     }

                                     $("[name=termProcess]").empty();
                                     $("[name=termProcess]").append(appendString);

                                     appendString="";

                                     for(var a=2;a <= 6;a++){

                                        if(result[a] != "" && result[a] != null && result[a]!= "-"){

                                        appendString=appendString+"<option>"+result[a]+"</option>";

                                        }
                                     }

                                    $("[name=termSupervisor]").empty();
                                    $("[name=termSupervisor]").append(appendString);


                                $.ajax({
                                url: 'php/notificationFunction.php',
                                data:{functionNumber:3,AutoEmpID:EmpdID,categoryCode:3},
                                type: 'post',
                                success: function(data){

                                    var dataValue=JSON.parse(data);
                                    
                                    if(dataValue.length-1 > 0){
                                    
                                        if(dataValue[4]==0 || dataValue[4]=="0"){

                                           var confirmVal=confirm("Already have termination notification,Would you like to update?");
                                           if(confirmVal==true){

                                            IndertOrUpdate="Update";
                                             

                                             for(var i=0;i < dataValue.length;i++ ){

                                                retrievedValue[i]=dataValue[i];

                                             }

                                               
                                                $("[name=termLWD]").val(retrievedValue[0]);
                                                $("[name=termEffective]").val(retrievedValue[1]);
                                                $("[name=termReasonTerm]").val(retrievedValue[3]);
                                                


                                           }else{

                                            EmptyField();

                                           }
                                        }else{

                                             alert("Already have termination notification, Modification is lock!");
                                             EmptyField();
                                        }

                                    }else{

                                        IndertOrUpdate="Insert";
                                        
                                    }
                                }
                                });

                                }else{
                                    alert("Employee information not found");
                                }

                                   

                                                     
                                }
                    
                        });
                    }

                    
                     function EmptyField(){


                        $("[name=termEmpID]").val("");
                        $("[name=termName]").val("");
                        $("[name=termProcess]").empty();
                        $("[name=termSupervisor]").empty();
                        $("[name=termLWD]").val("");
                        $("[name=termEffective]").val("");
                        $("[name=termReasonTerm]").val("");
                    }


            $("#SubmitTerm").click(function(){


                if($("[name=termName]").val() !="" && $("[name=termProcess] option").size() > 0 && $("[name=termLWD]").val() != "" && $("[name=termEffective]").val() != "" && $("[name=termReasonTerm]").val() != "" ){

                     var validDateFormat=/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|[12][0-9]|3[01])[\/\-]\d{4}$/;
                     var validDateFormat2=/^\d{4}[\/\-](0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|[12][0-9]|3[01])$/;

                      var dateVal=$("[name=termLWD]").val();
                     if(dateVal.match(validDateFormat) || dateVal.match(validDateFormat2)){
                        var dateVal=$("[name=termEffective]").val();
                     if(dateVal.match(validDateFormat) || dateVal.match(validDateFormat2)){

                         savedDetails();

                    }else{

                            alert("Error - Effective Date field was not on required format");

                    }

                    }else{

                            alert("Error - Last working day field was not on required format");

                    }

                }else{

                    alert("Please fill up all fields!");

                }

                });


                    function savedDetails(){

                    var confirmsaving=confirm("Confirm to save and send?");

                    if(confirmsaving==true){

                    var EmpIDVal=$("[name=termEmpID]").val();
                    var EmpName=$("[name=termName]").val();
                    var ProcessVal="";
                    if($("[name=termProcess] option").size() > 0){
                     $("[name=termProcess] option").each(function(){
                        
                        if(ProcessVal==""){
                            ProcessVal=$(this).val();
                        }else{

                             ProcessVal=ProcessVal+"/"+$(this).val();
                        }

                    });
                }
                 var SupervisorVal="";
                if($("[name=termSupervisor] option").size() > 0){
                     $("[name=termSupervisor] option").each(function(){
                        
                        if(SupervisorVal==""){
                            SupervisorVal=$(this).val();
                        }else{

                             SupervisorVal=SupervisorVal+"/"+$(this).val();
                        }

                    });
                }

               
                var LWDVal=$("[name=termLWD]").val();
                var EffectivedVal=$("[name=termEffective]").val();
                var ReasonTermVal=$("[name=termReasonTerm]").val();
                
               
                
                var dataVal=[EmpIDVal,EmpName,ProcessVal,SupervisorVal,LWDVal,EffectivedVal,"3",ReasonTermVal];

                
            

                  $.ajax({
                                url: 'php/notificationFunction.php',
                                data:{functionNumber:4,ArrayValAuto:dataVal,ToUpdateRefAuto:retrievedValue,WhatTodoAuto:IndertOrUpdate},
                                type: 'post',
                                success: function(data){
                                                          
                                    validateIfSuccessfullySave();
                                },
                                error: function(){
                                    alert("Notification saving and sending failed!");
                                }
                        }); 

                    }               

             }


               function validateIfSuccessfullySave(){
                        var successfullySaved;
                     $.ajax({

                        url: 'php/notificationFunction.php',
                                data:{functionNumber:5},
                                type: 'post',
                                success: function(data){
                                    var result=JSON.parse(data);
                                    successfullySaved=result;
                                     alert(successfullySaved);

                                      if(successfullySaved==1){
                    
                                        alert("Notification successfully saved and send");
                                        EmptyField();

                                    }else if(successfullySaved==2){
                                        alert("Problem in updating employee status, Notification was successfully saved and send");
                                        EmptyField();
                   

                                     }else if(successfullySaved==3){

                                        alert("Notification was already exist");

                                    }else{

                                        alert("Notification saving and sending failed!");
                    
                                    }
                                }

                       }); 
                   
                  
               
                            
            }
              

         

        });

          
           


    </script>
   
    

</body>
</html>