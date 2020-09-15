<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta http-equiv="X-Content-Type-Options" content="nosniff">   
        <!--<meta http-equiv="Content-Security-Policy" content="script-src 'strict-dynamic' 'nonce-S51U26wMQz' 'unsafe-inline' http: https: https://www.gstatic.com https://csp.withgoogle.com https://www.google.com; object-src 'none'; base-uri 'none';">-->

        <title><?php echo $title; ?></title>
        <!-- Bootstrap -->

        <link href="<?php echo CENTRAL_ASSETS_FOLDER; ?>bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <!-- Font Awesome -->
        <link href="<?php echo CENTRAL_ASSETS_FOLDER; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- NProgress -->              

        <!-- Custom Theme Style -->
        <link href="<?php echo ADMIN_MAIN_ASSETS_FOLDER; ?>build/css/custom.min.css" rel="stylesheet" type="text/css">

        <script src="<?php echo CENTRAL_ASSETS_FOLDER; ?>jquery/jquery.min.js" type="text/javascript" nonce='S51U26wMQz'></script>       
        <script src="<?php echo CENTRAL_ASSETS_FOLDER; ?>bootstrap/bootstrap.min.js" type="text/javascript" nonce='S51U26wMQz'></script>         
        <script nonce='S51U26wMQz' src="<?php echo BASE_URL; ?>/assets/pnotify/js/PNotify.js" type="text/javascript"></script>
        <script nonce='S51U26wMQz' src="<?php echo BASE_URL; ?>/assets/pnotify/js/PNotifyStyleMaterial.js" type="text/javascript"></script>
        <script nonce='S51U26wMQz' src="<?php echo BASE_URL; ?>/assets/pnotify/js/PNotifyButtons.js" type="text/javascript"></script>              
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/pnotify/css/PNotifyBrightTheme.css"/>
        <script nonce='S51U26wMQz' src="<?php echo BASE_URL; ?>/assets/pnotify/js/PNotifyConfirm.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/pnotify/css/animate.css" rel="stylesheet"/>      
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/pnotify/css/icon.css"/>                       
        <style>
            .login_wrapper{
                padding-top: 200px !important;
            }
            #validdiv{
                color:red;
                padding-top: 30px;
            }
        </style>
    </head>
    <body class="login">
        <div>           
            <div class="login_wrapper" id="validdiv1">
                <div class="animate form login_form">
                    <section class="login_content">                        
                       <?php
                        $attributes = ['id' => 'loginform'];
                        echo form_open(ADMIN_LOGIN_LINK,$attributes);
                       ?>                                    
                            <h1>Login Form</h1>
                            <div>
                                <input type="text" class="form-control" placeholder="Username" name="username" id="username" required="" maxlength="50" autocomplete="off">
                            </div>
                            <div>
                                <input type="password" class="form-control" placeholder="Password" required="" id="password" name="password" autocomplete="off" maxlength="50" autocomplete="off">
                            </div>                            
                            <div>                               
                                <script nonce='S51U26wMQz' type="text/javascript" src="https://www.google.com/recaptcha/api.js" async defer></script>
                                <script nonce='S51U26wMQz' type="text/javascript">
                                    function enableLogin() {
                                        document.getElementById("btnSubmit").disabled = false;
                                    }
                                </script>

                                <div class="g-recaptcha" style="" data-sitekey="6LdnvCQUAAAAAGmHBukXVzjs5NupVLlaIHJdpFWo" data-callback="enableLogin"></div>                        
                                <br>
                            </div>
                            <div>                                
                                <input type="submit"   id="btnSubmit" disabled="" class="btn primary_btn btn_disabled submit col-xs-12 btn-info" value="Log in" name="login"/>
                            </div>
                            <div class="clearfix"></div>

                            <div class="separator">                                             
                                <?php
                                if (isset($_SESSION['valid'])) {
                                    if ($_SESSION['valid'] == 1) {
                                        ?>
                                        <center><div id="validdiv">Invalid Username And Password</div></center>
                                        <br/>
                                        <?php
                                    }
                                }
                                ?>                                                                
                                <div>
                                    <h1><i class="fa fa-modx">&nbsp;</i><?php echo APPNAME ?></h1>
                                    <p>©<?php echo date("Y"); ?> All Rights Reserved <?php echo APPNAME ?>.</p>
                                </div>
                            </div>
                        <?php echo form_close();?>                                                                  
                    </section>
                </div>
            </div>
        </div>        
        <?php include(APPPATH."Views/adminside/common/notify.php"); ?>      
        <script nonce='S51U26wMQz' type="text/javascript">
            $(document).ready(function () {
                $('input[type=text]').keyup(function (e) {
                    if ($(this).hasClass("novalidation")) {
                    } else {
                        var str = $(this).val();
                        for (var i = 0; i < str.length; i++) {
                            var charCode = str.charAt(i).charCodeAt(0);
                            if (charCode === 60 || charCode === 96 || charCode === 126 || charCode === 33 || charCode === 35 || charCode === 36 || charCode === 37 || charCode === 94 || charCode === 96 || charCode === 38 || charCode === 42 || charCode == 40 || charCode === 41 || charCode === 61 || charCode === 43 || charCode === 123 || charCode === 125 || charCode === 91 || charCode === 93 || charCode === 124 || charCode === 92 || charCode === 58 || charCode === 59 || charCode === 34 || charCode === 39 || charCode === 44 || charCode === 63 || charCode === 47 || charCode === 62)
                            {
                                alert('Special Characters are not allowed. Only use A-Z, a-z and 0-9');
                                $(this).val('');
                                return false;
                            }
                        }
                        return true;
                    }
                });
            });
        </script>
    </body>
</html>
