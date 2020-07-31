<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta http-equiv="X-Content-Type-Options" content="nosniff">   
        <meta http-equiv="Content-Security-Policy" content="script-src 'strict-dynamic' 'nonce-S51U26wMQz' 'unsafe-inline' http: https: https://www.gstatic.com https://csp.withgoogle.com https://www.google.com; object-src 'none'; base-uri 'none';">

        <title><?php echo $title; ?></title>
        <!-- Bootstrap -->

        <link href="<?php echo ADMIN_ASSETS_FOLDER; ?>bootstrap/dist/css/bootstrap.min.css?v=1.0" rel="stylesheet" type="text/css">

        <!-- Font Awesome -->
        <link href="<?php echo ADMIN_ASSETS_FOLDER; ?>font-awesome/css/font-awesome.min.css?v=1.0" rel="stylesheet" type="text/css">

        <!-- NProgress -->
        <link href="<?php echo ADMIN_ASSETS_FOLDER; ?>nprogress/nprogress.css?v=1.0" rel="stylesheet" type="text/css">            

        <!-- Custom Theme Style -->
        <link href="<?php echo ADMIN_ASSETS_FOLDER; ?>build/css/custom.min.css?v=1.0" rel="stylesheet" type="text/css">

        <script src="<?php echo ADMIN_ASSETS_FOLDER; ?>jquery/dist/jquery.min.js?v=1.0" type="text/javascript" nonce='S51U26wMQz'></script>        
        <script src="<?php echo ADMIN_ASSETS_FOLDER; ?>bootstrap/dist/js/bootstrap.min.js?v=1.0" type="text/javascript" nonce='S51U26wMQz'></script>         
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
                        <form method="post" id='loginform'>              
                            <h1>Login Form</h1>
                            <div>
                                <input type="text" class="form-control" placeholder="Username" required="" name="username"/>
                            </div>
                            <div>
                                <input type="password" class="form-control" placeholder="Password" required="" name="password" autocomplete="on"/>
                            </div>
                            <?php
                            $csrf = array(
                                'name' => $this->security->get_csrf_token_name(),
                                'hash' => $this->security->get_csrf_hash()
                            );
                            ?>
                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />                                                        
                            <div>                               
                                <script nonce='S51U26wMQz' type="text/javascript" src="https://www.google.com/recaptcha/api.js" async defer></script>
                                <script nonce='S51U26wMQz' type="text/javascript">
                                    function enableLogin() {
                                        document.getElementById("btnLogin").disabled = false;
                                    }
                                </script>

                                <div class="g-recaptcha" style="" data-sitekey="6LdnvCQUAAAAAGmHBukXVzjs5NupVLlaIHJdpFWo" data-callback="enableLogin"></div>                        
                                <br>
                            </div>
                            <div>                                
                                <input type="submit" disabled  id="btnLogin" class="btn primary_btn btn_disabled submit col-xs-12 btn-info" value="Log in" name="login"/>
                            </div>
                            <div class="clearfix"></div>

                            <div class="separator">                                             
                                <?php
                                if (isset($_SESSION['valid'])) {
                                    if ($_SESSION['valid'] == 1) {
                                        ?>
                                        <center><div id="validdiv">Invalid Username And Password</div></center>
                                        <br />
                                        <?php
                                    }
                                }
                                ?>                                                                
                                <div>
                                    <h1><i class="fa fa-modx">&nbsp;</i><?php echo APPNAME ?></h1>
                                    <p>©<?php echo date("Y"); ?> All Rights Reserved <?php echo APPNAME ?>.</p>
                                </div>
                            </div>
                        </form>                                                                       
                    </section>
                </div>
            </div>
        </div>        
        <?php include(VIEWPATH . "adminside/common/notify.php"); ?>
        <script nonce='S51U26wMQz' src="<?php echo BASE_URL ?>/assets/front/js/bootstrapValidator.min.js?v=1.0" type="text/javascript"></script>
        <script nonce='S51U26wMQz' type="text/javascript">
                                    $(document).ready(function () {                                       
                                        $('#overrideOptionsForm').bootstrapValidator({
                                            fields: {
                                                username: {
                                                    validators: {
                                                        notEmpty: {
                                                            message: 'The username is required'
                                                        },
                                                        uri: {
                                                            message: 'The website address is not valid'
                                                        }
                                                    }
                                                }
                                            }
                                        });
                                    });
        </script>

    </body>
</html>
