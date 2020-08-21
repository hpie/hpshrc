<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta http-equiv="X-Content-Type-Options" content="nosniff">   
        <meta http-equiv="Content-Security-Policy" content="script-src 'strict-dynamic' 'nonce-S51U26wMQz' 'unsafe-inline' http: https: https://www.gstatic.com https://csp.withgoogle.com https://www.google.com; object-src 'none'; base-uri 'none';">
        <!-- Fonts -->
       <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Dosis:400,700' rel='stylesheet' type='text/css'>-->

        <link href="<?php echo BASE_URL; ?>/assets/front/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo BASE_URL; ?>/assets/front/css/dataTables.responsive.css" rel="stylesheet" type="text/css">

        <!-- favico -->
        <link rel='icon' href="<?php echo FRONT_ASSETS_FOLDER; ?>assets/images/favico/favicon.ico" type="image/x-icon"/ >

        <!-- Bootsrap -->
        <link rel="stylesheet" href="<?php echo FRONT_ASSETS_FOLDER; ?>assets/css/bootstrap.min.css" type="text/css">
        <!-- Font awesome -->
        <link rel="stylesheet" href="<?php echo FRONT_ASSETS_FOLDER; ?>assets/css/font-awesome.min.css" type="text/css">

        <!-- Owl carousel -->
        <link rel="stylesheet" href="<?php echo FRONT_ASSETS_FOLDER; ?>assets/css/owl.carousel.css" type="text/css">
        <link href="<?php echo FRONT_ASSETS_FOLDER; ?>assets/css/prettyPhoto.css" rel="stylesheet" type="text/css"/>
        <!-- Template main Css -->
        <link rel="stylesheet" href="<?php echo FRONT_ASSETS_FOLDER; ?>assets/css/style.css" type="text/css">

        <!-- Modernizr -->
        <script nonce='S51U26wMQz' src="<?php echo FRONT_ASSETS_FOLDER; ?>assets/js/modernizr-2.6.2.min.js"></script>
     
        <script nonce='S51U26wMQz' src="<?php echo BASE_URL; ?>/assets/pnotify/js/PNotify.js" type="text/javascript"></script>
        <script nonce='S51U26wMQz' src="<?php echo BASE_URL; ?>/assets/pnotify/js/PNotifyStyleMaterial.js" type="text/javascript"></script>
        <script nonce='S51U26wMQz' src="<?php echo BASE_URL; ?>/assets/pnotify/js/PNotifyButtons.js" type="text/javascript"></script>              
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/pnotify/css/PNotifyBrightTheme.css"/>
        <script nonce='S51U26wMQz' src="<?php echo BASE_URL; ?>/assets/pnotify/js/PNotifyConfirm.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/pnotify/css/animate.css" rel="stylesheet"/>      
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/pnotify/css/icon.css"/>
        <!--<link href="<?php echo ADMIN_ASSETS_FOLDER; ?>build/css/custom.min.css" rel="stylesheet" type="text/css">-->
        
        <style>
            .download{
                color:blue !important;
            }
        </style>
    </head>

    <body>


        <header class="main-header">


            <nav class="navbar navbar-static-top">

                <div class="navbar-top">

                    <div class="container">
                        <div class="row">

                            <div class="col-sm-6 col-xs-12">

                                <ul class="list-unstyled list-inline header-contact">
                                    <li> <i class="fa fa-phone"></i> <a href="tel:">+91 177 262 4908 </a> </li>
                                    <li> <i class="fa fa-envelope"></i> <a href="mailto:info@hpshrc.hp.gov.in">info(at)hpshrc.hp.gov.in</a> </li>
                                </ul> <!-- /.header-contact  -->

                            </div>

                            <div class="col-sm-6 col-xs-12 text-right">

                                <ul class="list-unstyled list-inline header-social">
                                    <li> <a href="#"> <i class="fa fa-facebook"></i> </a> </li>
                                    <li> <a href="#"> <i class="fa fa-twitter"></i>  </a> </li>
                                    <li> <a href="#"> <i class="fa fa-google"></i>  </a> </li>
                                    <li> <a href="#"> <i class="fa fa-youtube"></i>  </a> </li>
                                    <li> <a href="#"> <i class="fa fa fa-pinterest-p"></i>  </a> </li>
                                </ul> <!-- /.header-social  -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="navbar-main">

                    <div class="container">

                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>

                            </button>

                            <a class="navbar-brand" href="<?php echo BASE_URL; ?>"><img src="<?php echo FRONT_ASSETS_FOLDER; ?>assets/images/hpshrc-logo-1.png" alt=""></a>

                        </div>

                        <div id="navbar" class="navbar-collapse collapse pull-right">

                            <ul class="nav navbar-nav">

                                <li><a class="is-active" href="<?php echo BASE_URL; ?>">HOME</a></li>
                                <li><a href="<?php echo FRONT_ABOUT_LINK; ?>">ABOUT</a></li>
                                <li class="has-child"><a href="#">CAUSES</a>

                                    <ul class="submenu">
                                        <li class="submenu-item"><a href="<?php echo FRONT_DOWNLOAD_LINK; ?>">Downloads</a></li>
                                        <li class="submenu-item"><a href="<?php echo FRONT_BUDGET_LINK; ?>">Budget and Finance</a></li>
                                    </ul>

                                </li>
                                <li><a href="<?php echo FRONT_GALLERY_LINK; ?>">GALLERY</a></li>
                                <li><a href="<?php echo FRONT_CONTACT_LINK; ?>">CONTACT</a></li>

                            </ul>

                        </div> <!-- /#navbar -->

                    </div> <!-- /.container -->

                </div> <!-- /.navbar-main -->


            </nav> 

        </header> <!-- /. main-header -->