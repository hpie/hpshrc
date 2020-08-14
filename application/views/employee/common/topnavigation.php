<!-- wrap @s -->
<div class="nk-wrap ">
    <!-- main header @s -->
    <div class="nk-header nk-header-fixed is-light">
        <div class="container-fluid">
            <div class="nk-header-wrap">
                <div class="nk-menu-trigger d-xl-none ml-n1">
                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                </div>
                <div class="nk-header-brand d-xl-none">
                    <a href="<?php echo EMPLOYEE_DASHBOARD_LINK; ?>" class="logo-link">
                        <img class="logo-light logo-img" src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>images/logo.png" srcset="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>images/logo2x.png 2x" alt="logo">
                        <img class="logo-dark logo-img" src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>images/logo-dark.png" srcset="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>images/logo-dark2x.png 2x" alt="logo-dark">
                    </a>
                </div><!-- .nk-header-brand -->
                <div class="nk-header-tools">
                    <ul class="nk-quick-nav">
                        <li class="dropdown user-dropdown">
                            <a href="#" class="dropdown-toggle mr-n1" data-toggle="dropdown">
                                <div class="user-toggle">
                                    <div class="user-avatar sm">
                                        <em class="icon ni ni-user-alt"></em>
                                    </div>
                                    <div class="user-info d-none d-xl-block">
                                        <!--<div class="user-status user-status-unverified">Unverified</div>-->
                                        <div class="user-name dropdown-indicator"><?php echo $_SESSION['user_firstname'].' '.$_SESSION['user_lastname']; ?></div>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                    <div class="user-card">
                                        <div class="user-avatar">
                                            <span>AB</span>
                                        </div>
                                        <div class="user-info">
                                            <span class="lead-text"><?php echo $_SESSION['user_firstname'].' '.$_SESSION['user_lastname']; ?></span>
                                            <span class="sub-text"><?php echo $_SESSION['user_email_id']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-inner">
                                    <ul class="link-list">
                                        <li><a href="<?php echo EMPLOYEE_UPDATE_PROFILE_LINK; ?>"><em class="icon ni ni-user-alt"></em><span>Update Profile</span></a></li>
                                        <!--<li><a href="html/user-profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>-->
                                        <!--<li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>-->
                                    </ul>
                                </div>
                                <div class="dropdown-inner">
                                    <ul class="link-list">
                                        <li><a href="<?php echo EMPLOYEE_LOGOUT_LINK; ?>"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!-- .nk-header-wrap -->
        </div><!-- .container-fliud -->
    </div>
    <!-- main header @e -->