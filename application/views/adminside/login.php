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
        <script src="<?php echo ADMIN_ASSETS_FOLDER; ?>jquery/dist/jquery.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
        <link href="<?php echo ADMIN_ASSETS_FOLDER; ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <!-- Font Awesome -->
        <link href="<?php echo ADMIN_ASSETS_FOLDER; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- NProgress -->
        <link href="<?php echo ADMIN_ASSETS_FOLDER; ?>nprogress/nprogress.css" rel="stylesheet" type="text/css">
        <!-- Animate.css -->
        <!--<link href="<?php echo ADMIN_ASSETS_FOLDER; ?>animate.css/animate.min.css" rel="stylesheet">-->

        <!-- Custom Theme Style -->
        <link href="<?php echo ADMIN_ASSETS_FOLDER; ?>build/css/custom.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?php echo ADMIN_ASSETS_FOLDER; ?>jqueryui/jquery-ui.css" type="text/css">
        <script src="<?php echo ADMIN_ASSETS_FOLDER; ?>jquery/dist/jquery.js" type="text/javascript" nonce='S51U26wMQz'></script>
        <script src="<?php echo ADMIN_ASSETS_FOLDER; ?>jqueryui/jquery-ui.js" type="text/javascript" nonce='S51U26wMQz'></script>
        
        <script type="text/javascript" nonce='S51U26wMQz'>
            $(document).ready(function () {               
                var valid =<?php if($_SESSION['invalid_login']==1){echo $_SESSION['invalid_login'];} else{ echo '0';} ?>;
                if (valid)
                {
                    if (valid == 1)`                        `
                    {
                        $("#validdiv1").effect("shake");                        
                    }
                }
            });
        </script>
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
                        <form method="post">              
<!--                          <center><div id="validdiv">Invalid Username And Password</div></center>-->
                            <h1>Login Form</h1>
                            <div>
                                <input type="text" class="form-control" placeholder="Username" required="" name="username"/>
                            </div>
                            <div>
                                <input type="password" class="form-control" placeholder="Password" required="" name="password"/>
                            </div>
                            <div>
                                <input type="submit" class="btn btn-default submit col-xs-12 btn-info" value="Log in" name="login"/>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">                                             
                                <?php if(isset($_SESSION['valid'])){ if($_SESSION['valid']==1){
                                    ?>
                                <center><div id="validdiv">Invalid Username And Password</div></center>
                                <br />
                                <?php
                                }} ?>                                                                
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
    </body>
</html>
