<?php
// Prerequisites
session_start();
include_once ($_SERVER ["DOCUMENT_ROOT"] . '/lib/application.php');
if ($_COOKIE['user'] == '') {
    header('location:' . ADDRESS_ADMIN . 'login.php');
}
if ($_SESSION ['admin_id'] != "") {
    
} else {
    header('location:' . ADDRESS_ADMIN . 'login.php');
}


if ($_SESSION['admin_id'] == 'demo') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_GET['action'] == 'del') {
        SetAlert('DEMO MODE ไม่สามารถกระทำรายการได้');
        header('location:' . ADDRESS_ADMIN_CONTROL . 'demo');
        exit();
    }
}
?>
<html lang="en">
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="Keywords" content="">
        <meta name="Description" content="">
        <link rel="stylesheet"
              href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        <!-- Bootstrap Stylesheet -->

        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"
              media="screen">

        <!-- Theme Stylesheet -->

        <link rel="stylesheet" href="assets/css/dandelion.theme.css"
              media="screen">

        <!-- Icon Stylesheet -->

        <link rel="stylesheet" href="assets/css/fonts/glyphicons/style.css"
              media="screen">

        <!--  Main Stylesheet -->

        <link rel="stylesheet" href="assets/css/dandelion.min.css"
              media="screen">
        <link rel="stylesheet" href="assets/css/customizer.css" media="screen">

        <!-- Demo Stylesheet -->

        <link rel="stylesheet" href="assets/css/demo.css" media="screen">

        <!-- Plugin Stylesheet -->

        <link rel="stylesheet"
              href="assets/js/plugins/wizard/dandelion.wizard.css" media="screen">

        <!-- JS Libs -->

        <script src="assets/js/libs/jquery-1.8.3.min.js"></script>
        <script src="assets/js/libs/jquery.placeholder.min.js"></script>
        <script src="assets/js/libs/jquery.mousewheel.min.js"></script>

        <!-- JS Bootstrap -->

        <script src="bootstrap/js/bootstrap.min.js"></script>

        <!-- jQuery-UI JavaScript Files -->

        <script src="assets/jui/js/jquery-ui-1.9.2.min.js"></script>
        <script src="assets/jui/jquery.ui.timepicker.min.js"></script>
        <script src="assets/jui/jquery.ui.touch-punch.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

        <!-- JS Plugins -->

        <!-- Validation Plugin -->

        <script src="plugins/validate/jquery.validate.min.js"></script>

        <!-- DataTables Plugin -->

        <script src="plugins/datatables/jquery.dataTables.min.js"></script>

        <!-- Flot Plugin -->

        <!--[if lt IE 9]>
                
                <script src="assets/js/libs/excanvas.min.js"></script>
                
                <![endif]-->

        <script src="plugins/flot/jquery.flot.min.js"></script>
        <script src="plugins/flot/plugins/jquery.flot.tooltip.min.js"></script>
        <script src="plugins/flot/plugins/jquery.flot.resize.min.js"></script>

        <!-- Circular Stat Plugin -->

        <script
        src="assets/js/plugins/circularstat/dandelion.circularstat.min.js"></script>

        <!-- Wizard Plugin -->

        <script src="assets/js/plugins/wizard/dandelion.wizard.min.js"></script>
        <script src="assets/js/libs/jquery.form.min.js"></script>

        <!-- Fullcalendar Plugin -->

        <script src="plugins/fullcalendar/fullcalendar.min.js"></script>
        <script src="plugins/fullcalendar/gcal.js"></script>
        <link rel="stylesheet" href="plugins/fullcalendar/fullcalendar.css"
              media="screen">
        <link rel="stylesheet"
              href="plugins/fullcalendar/fullcalendar.print.css" media="print">

        <!-- Select2 Plugin -->

        <script src="plugins/select2/select2.js"></script>
        <link rel="stylesheet" href="plugins/select2/select2.css" media="screen">

        <!-- Editor -->

        <script type="text/javascript"
        src="plugins/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>

        <!-- Picklist Plugin -->

        <script src="assets/js/plugins/picklist/picklist.min.js"></script>
        <link rel="stylesheet" href="assets/js/plugins/picklist/picklist.css"
              media="screen">

        <!-- Colorpicker Plugin -->

        <script src="plugins/colorpicker/colorpicker.js"></script>
        <link rel="stylesheet" href="plugins/colorpicker/colorpicker.css"
              media="screen">

        <!-- elRTE Plugin -->

        <script src="plugins/elrte/js/elrte.full.js"></script>
        <link rel="stylesheet" href="plugins/elrte/css/elrte.css" media="screen">

        <!-- elFinder Plugin -->

        <script src="plugins/elfinder/js/elfinder.min.js"></script>
        <link rel="stylesheet" href="plugins/elfinder/css/elfinder.css"
              media="screen">

        <!-- iButton Plugin -->

        <script src="plugins/ibutton/jquery.ibutton.min.js"></script>
        <style type="text/css"></style>
        <link rel="stylesheet" href="plugins/ibutton/jquery.ibutton.css"
              media="screen">

        <!-- Autosize Plugin -->

        <script src="plugins/autosize/jquery.autosize.min.js"></script>

        <!-- FilInput Plugin -->

        <script src="assets/js/plugins/fileinput/jquery.fileinput.js"></script>

        <!-- JS Demo -->

        <script src="assets/js/demo/demo.validation.js"></script>
        <script src="assets/js/demo/demo.dashboard.js"></script>
        <script src="assets/js/demo/demo.tables.js"></script>
        <script src="assets/js/demo/demo.form.js"></script>

        <!-- JS Login -->

        <script src="assets/js/core/dandelion.login.js"></script>

        <!-- JS Template -->

        <script src="assets/js/core/dandelion.core.js"></script>

        <!-- JS Customizer -->

        <script src="assets/js/core/dandelion.customizer.js"></script>

        <!-- Input Tag -->
        <script src="assets/input_tags/bootstrap-tagsinput-angular.js"></script>
        <script src="assets/input_tags/bootstrap-tagsinput.js"></script>
        <link rel="stylesheet" href="assets/input_tags/bootstrap-tagsinput.css">
        <link rel="icon" type="image/png" href="<?= ADDRESS ?>images/icon.png"/>



    </head>  

    <body cz-shortcut-listen="true">

        <!-- Main Wrapper. Set this to 'fixed' for fixed layout and 'fluid' for fluid layout' -->
        <div id="da-wrapper">

            <!-- Header -->
            <div id="da-header">
                <div id="da-header-top">

                    <!-- Container -->
                    <div class="da-container clearfix">

                        <!-- Logo Container. All images put here will be vertically centere -->
                        <div id="da-logo-wrap">
                            <div id="da-logo">
                                <div id="da-logo-img">

                                    <img src="../images/admin2.png" alt="" style="max-width: 144px;"> 

                                </div>
                            </div>
                        </div>

                        <!-- Header Toolbar Menu -->
                        <div id="da-header-toolbar" class="clearfix">
                            <div id="da-user-profile-wrap">
                                <div id="da-user-profile" data-toggle="dropdown" class="clearfix">
                                    <div id="da-user-avatar"></div>
                                    <div id="da-user-info">
                                        Admin Administrator <span class="da-user-title">Administrator</span>
                                    </div>
                                </div>
                                <ul class="dropdown-menu">

                                    <li><a
                                            href="<?php echo ADDRESS_ADMIN_CONTROL ?>profile&action=edit&id=1">เปลี่ยนรหัสผ่าน</a></li>
                                </ul>
                            </div>
                            <div id="da-header-button-container" >
                                <ul>

                                    <li class="da-header-button-wrap">
                                        <div class="da-header-button">
                                            <a href="javascript:void(0)"
                                               onclick="window.location = '<?php echo ADDRESS_ADMIN_CONTROL ?>logout'"
                                               title="ออกจากระบบ"><i class="icon-power"></i></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div id="da-content">

                <!-- Container -->
                <div class="da-container clearfix">

                    <!-- Sidebar Separator do not remove -->
                    <div id="da-sidebar-separator"></div>

                    <!-- Sidebar -->
                    <div id="da-sidebar">

                        <!-- Navigation Toggle for < 480px -->
                        <div id="da-sidebar-toggle"></div>

                        <!-- Main Navigation -->
                        <div id="da-main-nav" class="btn-container">
                            <ul>
                                <li class="<?= PAGE_CONTROLLERS == 'slides' || $_GET['type'] == 'index' || PAGE_CONTROLLERS == 'home' ? 'active' : '' ?>"><a href="#"> <!-- Icon Container --> <span
                                            class="da-nav-icon"> <img src="../images/icon-home.png"
                                                                  width="32" height="32">
                                        </span> หน้าแรก
                                    </a>
                                    <ul>
                                        <li class="<?= PAGE_CONTROLLERS == 'slides' ? 'active' : '' ?>"><a href="<?php echo ADDRESS_ADMIN_CONTROL ?>slides">ภาพสไลด์</a></li>

                                        <li class="<?= PAGE_CONTROLLERS == 'home' ? 'active' : '' ?>"><a  href="<?php echo ADDRESS_ADMIN_CONTROL ?>home&action=edit&id=1">รายละเอียด</a></li>


                                    </ul>
                                </li>

                                <li class="<?= PAGE_CONTROLLERS == 'about' ? 'active' : '' ?>"><a href="#"> <!-- Icon Container --> 
                                        <span
                                            class="da-nav-icon"> <img src="images/icon-about.png"
                                                                  width="32" height="32">
                                        </span>    About us
                                    </a>
                                    <ul>
                                        <li class="<?= PAGE_CONTROLLERS == 'about' ? 'active' : '' ?>"><a  href="<?php echo ADDRESS_ADMIN_CONTROL ?>about&action=edit&id=1">รายละเอียด</a></li>


                                    </ul>
                                </li>

                                <li class="<?= PAGE_CONTROLLERS == 'gallery' ? 'active' : '' ?>"><a href="#"> <!-- Icon Container --> 
                                        <span
                                            class="da-nav-icon"> <img src="images/icon-gallery.png"
                                                                  width="32" height="32">
                                        </span>จัดการ Gallery
                                    </a> 
                                    <ul>
                                        <li class="<?= PAGE_CONTROLLERS == 'gallery' ? 'active' : '' ?>"><a  href="<?php echo ADDRESS_ADMIN_CONTROL ?>gallery">Gallery</a></li>

                                    </ul> 
                                </li>


                                <li class="<?= PAGE_CONTROLLERS == 'programs' ? 'active' : '' ?>"><a href="#"> <!-- Icon Container --> <span
                                            class="da-nav-icon"> <img src="images/icon-program.png" 
                                                                  width="32" height="32">
                                        </span> จัดการ Program
                                    </a>
                                    <ul>
                                        <li class="<?= PAGE_CONTROLLERS == 'programs' ? 'active' : '' ?>"><a  href="<?php echo ADDRESS_ADMIN_CONTROL ?>programs">Program</a></li>


                                    </ul>
                                </li>
                                <li class="<?= PAGE_CONTROLLERS == 'guestbook' ? 'active' : '' ?>"><a href="#"> <!-- Icon Container --> <span
                                            class="da-nav-icon"> <img src="images/icon-people.png" 
                                                                  width="32" height="32">
                                        </span> จัดการ Guestbook
                                    </a>
                                    <ul>
                                        <li class="<?= PAGE_CONTROLLERS == 'guestbook' ? 'active' : '' ?>"><a  href="<?php echo ADDRESS_ADMIN_CONTROL ?>guestbook">Guestbook</a></li>


                                    </ul>
                                </li>

                                <li class="<?=
                                PAGE_CONTROLLERS == 'contact' || PAGE_CONTROLLERS == 'contact_message' || $_GET['type'] == 'contact' ? 'active' : ''
                                ?>"><a href="#"> <!-- Icon Container --> <span
                                            class="da-nav-icon"> <img src="../images/icon-contact.png"
                                                                  width="32" height="32">
                                        </span> ติดต่อเรา
                                    </a>
                                    <ul>
                                        <li class="<?= PAGE_CONTROLLERS == 'contact' ? 'active' : '' ?>"><a
                                                href="<?php echo ADDRESS_ADMIN_CONTROL ?>contact&action=edit&id=1">รายละเอียด</a></li>
                                        <li class="<?= PAGE_CONTROLLERS == 'contact_message' ? 'active' : '' ?>"><a
                                                href="<?php echo ADDRESS_ADMIN_CONTROL ?>contact_message">ข้อความ</a></li>
                                    </ul></li>

                            </ul>
                        </div>
                    </div>

                    <!-- Main Content Wrapper -->
                    <div id="da-content-wrap" class="clearfix">

                        <!-- Content Area -->
                        <div id="da-content-area">
                            <?php
                            include ("controllers/" . PAGE_CONTROLLERS . ".php");
                            ?>
                        </div>
                    </div>
                    <script type="text/javascript">
//$( document ).ready(function() {
                        function addfile() {
                            $("#filecopy:first").clone().insertAfter("div #filecopy:last");
                        }
                        function delfile() {
                            //$("#filecopy").clone().insertAfter("div #filecopy:last");
                            var conveniancecount = $("div #filecopy").length;
                            if (conveniancecount > 2) {
                                $("div #filecopy:last").remove();
                            }




                        }

//});

                    </script>
                    <script>
                        $(function () {
                            // $( "#datepicker" ).datepicker();
                            $("#activity_date").datepicker({dateFormat: "yy-mm-dd"}).val()
                        });


                    </script>
                    <style>
                        /*Colored Label Attributes*/
                        .label {
                            background-color: #BFBFBF;
                            border-bottom-left-radius: 3px;
                            border-bottom-right-radius: 3px;
                            border-top-left-radius: 3px;
                            border-top-right-radius: 3px;
                            color: #FFFFFF;
                            font-size: 9.75px;
                            font-weight: bold;
                            padding-bottom: 2px;
                            padding-left: 4px;
                            padding-right: 4px;
                            padding-top: 2px;
                            text-transform: uppercase;
                            white-space: nowrap;
                        }

                        .label:hover {
                            opacity: 80;
                        }

                        .label.success {
                            background-color: #46A546;
                        }

                        .label.success2 {
                            background-color: #CCC;
                        }

                        .label.success3 {
                            background-color: #61a4e4;
                        }

                        .label.warning {
                            background-color: #FC9207;
                        }

                        .label.failure {
                            background-color: #D32B26;
                        }

                        .label.alert {
                            background-color: #33BFF7;
                        }

                        .label.good-job {
                            background-color: #9C41C6;
                        }
                    </style>
                </div>
            </div>

            <!-- Footer -->
            <div id="da-footer">
                <div class="da-container clearfix">
                    <p>Copyright 2016.</p>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Localized -->
<style>
    tr {
        font-size: 12px;
    }
    .hidden{
        display: none !important;

    }
    .active{
        background-color: #CCC;
    }
</style>
<textarea tabindex="-1"
          style="position: absolute; top: -9999px; left: -9999px; right: auto; bottom: auto; border: 0px; box-sizing: content-box; word-wrap: break-word; overflow: hidden; height: 0px !important; min-height: 0px !important;"></textarea>
<div
    class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable"
    tabindex="-1" role="dialog" aria-labelledby="ui-id-1"
    style="display: none; outline: 0px; z-index: 1000;">
    <div
        class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
        <span id="ui-id-1" class="ui-dialog-title">Get CSS Style</span><a
            href="#" class="ui-dialog-titlebar-close ui-corner-all"
            role="button"><span class="ui-icon ui-icon-closethick">close</span></a>
    </div>
    <div id="da-customizer-dialog"
         class="ui-dialog-content ui-widget-content" style="">
        <textarea readonly id="da-customizer-css"></textarea>
    </div>
</div>
</body>
</html>