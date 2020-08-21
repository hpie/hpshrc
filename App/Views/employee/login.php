<!DOCTYPE html>
<html lang="en" class="js">
    <head>        
        <meta charset="utf-8">
        <meta name="author" content="Softnio">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
        <!-- Fav Icon  -->
        <link rel="shortcut icon" href="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>images/favicon.png">
        <!-- Page Title  -->
        <title><?php echo $title; ?></title>
        <!-- StyleSheets  -->
        <link rel="stylesheet" href="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>css/dashlite.css">
        <link id="skin-default" rel="stylesheet" href="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>css/theme.css">
        <link href="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>css/toastr.min.css" rel="stylesheet" type="text/css"/>        
    </head>
    <body class="nk-body bg-white npc-general pg-auth">
        <div class="nk-app-root">
            <!-- main @s -->
            <div class="nk-main ">
                <!-- wrap @s -->
                <div class="nk-wrap nk-wrap-nosidebar">
                    <!-- content @s -->
                    <div class="nk-content ">
                        <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                            <div class="brand-logo pb-4 text-center">
                                <a href="<?php echo BASE_URL; ?>" class="logo-link">
                                    <img class="logo-light logo-img logo-img-lg" src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>images/logo.png" srcset="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>images/logo2x.png 2x" alt="logo">
                                    <img class="logo-dark logo-img logo-img-lg" src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>images/logo-dark.png" srcset="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>images/logo-dark2x.png 2x" alt="logo-dark">
                                </a>
                            </div>
                            <div class="card">
                                <div class="card-inner card-inner-lg">
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h4 class="nk-block-title">Sign-In</h4>
                                            <div class="nk-block-des">
                                                <p>Enter username and password for access</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php                        
                                        echo form_open(EMPLOYEE_LOGIN_LINK);
                                    ?>                                                                        
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <label class="form-label" for="default-01">Email or Username</label>
                                            </div>
                                            <input type="text" class="form-control form-control-lg" name="username" id="default-01" placeholder="Enter your email address or username" required="">
                                        </div>
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <label class="form-label" for="password">Password</label>
                                                <a class="link link-primary link-sm" href="#">Forgot Code?</a>
                                            </div>
                                            <div class="form-control-wrap">
                                                <a href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                                </a>
                                                <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Enter your password" autocomplete="off" required="">
                                            </div>
                                        </div>                                                                                                       
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
                                        
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary btn-block" disabled  id="btnLogin" >Sign in</button>
                                        </div>
                                      <?php echo form_close();?>        
                                </div>
                            </div>
                        </div>
                        <div class="nk-footer nk-auth-footer-full">
                            <div class="container wide-lg">
                                <div class="row g-3">
                                    <div class="col-lg-12">
                                        <div class="nk-block-content text-center text-lg-center">
                                            <p class="text-soft">&copy; <?php echo date("Y"); ?> <?php echo APPNAME; ?> All Rights Reserved.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- wrap @e -->
                </div>
                <!-- content @e -->
            </div>
            <!-- main @e -->
        </div>
        <!-- app-root @e -->
        <!-- JavaScript -->
        <script src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>js/bundle.js"></script>
        <script src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>js/scripts.js"></script>
        <script src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>js/toastr.min.js" type="text/javascript"></script>
        <?php include(APPPATH . "Views/employee/common/notify.php"); ?>
</html>