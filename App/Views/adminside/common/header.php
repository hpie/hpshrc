<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">   
    <!--<meta http-equiv="Content-Security-Policy" content="script-src 'strict-dynamic' 'nonce-S51U26wMQz' 'unsafe-inline' http: https: https://www.gstatic.com https://csp.withgoogle.com https://www.google.com; object-src 'none'; base-uri 'none';">-->

    <title><?php echo $title ?></title>
    <!-- Bootstrap -->    
    <link href="<?php echo CENTRAL_ASSETS_FOLDER; ?>bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Font Awesome -->
    <link href="<?php echo CENTRAL_ASSETS_FOLDER; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">                 
    <link href="<?php echo ADMIN_MAIN_ASSETS_FOLDER; ?>icheck/green.css" rel="stylesheet" type="text/css"> 
    
    
    <link href="<?php echo CENTRAL_ASSETS_FOLDER; ?>datatable/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo CENTRAL_ASSETS_FOLDER; ?>datatable/dataTables.responsive.css" rel="stylesheet" type="text/css">    
    
    <!-- PNotify -->     
    <script nonce='S51U26wMQz' src="<?php echo BASE_URL; ?>/assets/pnotify/js/PNotify.js" type="text/javascript"></script>
    <script nonce='S51U26wMQz' src="<?php echo BASE_URL; ?>/assets/pnotify/js/PNotifyStyleMaterial.js" type="text/javascript"></script>
    <script nonce='S51U26wMQz' src="<?php echo BASE_URL; ?>/assets/pnotify/js/PNotifyButtons.js" type="text/javascript"></script>              
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/pnotify/css/PNotifyBrightTheme.css"/>
    <script nonce='S51U26wMQz' src="<?php echo BASE_URL; ?>/assets/pnotify/js/PNotifyConfirm.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/pnotify/css/animate.css" rel="stylesheet"/>      
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/pnotify/css/icon.css"/>
    <link href="<?php echo ADMIN_MAIN_ASSETS_FOLDER; ?>build/css/custom.min.css" rel="stylesheet" type="text/css">    
    <style>
        .navbar nav_title{
            border: 0 !important;
        }
        .modal-footer{
            border-top: 1px solid #0c97fe !important;
        }
        #modelboxstatus{
            color: #0c97fe !important;
        }
    </style>
    <style>
            .download{
                color:blue !important;
            }
        </style>
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title">
              <a href="#" class="site_title"><i class="fa fa-paw"></i> <span><?php echo APPNAME ?></span></a>
            </div>
            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                  <a href="javascript::void(0)"> <img src="<?php echo UPLOAD_FOLDER ?>original/default.png" height="60px" alt="..." class="img-circle profile_img"></a>
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <a href="javascript::void(0)"> <h2><?php echo $_SESSION['admin']['user_firstname'] .' '. $_SESSION['admin']['user_lastname']; ?></h2></a>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <br/>