<body class="nk-body bg-lighter npc-default has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="<?php echo EMPLOYEE_DASHBOARD_LINK; ?>" class="logo-link nk-sidebar-logo">
                            <h5>EMPLOYEE PANEL</h5>
<!--                            <img class="logo-light logo-img" src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>images/logo.png" srcset="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>images/logo2x.png 2x" alt="logo">
                            <img class="logo-dark logo-img" src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>images/logo-dark.png" srcset="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>images/logo-dark2x.png 2x" alt="logo-dark">
                            <img class="logo-small logo-img logo-img-small" src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>images/logo-small.png" srcset="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>images/logo-small2x.png 2x" alt="logo-small">-->
                        </a>
                    </div>
                    <div class="nk-menu-trigger mr-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <li class="nk-menu-heading">
                                    <h6 class="overline-title text-primary-alt">Employee Panel</h6>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item">
                                    <a href="<?php echo EMPLOYEE_DASHBOARD_LINK; ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                                        <span class="nk-menu-text">Dashboard</span>
                                    </a>
                                </li> 
                                 <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-book-read"></em></span>
                                        <span class="nk-menu-text">Cases</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="<?php echo EMPLOYEE_CASES_LIST_LINK; ?>" class="nk-menu-link"><span class="nk-menu-text">Cases List</span></a>
                                            <a href="<?php echo EMPLOYEE_ADD_CASES_LINK; ?>" class="nk-menu-link"><span class="nk-menu-text">Add Cases</span></a>
                                        </li>                                       
                                    </ul>                                     
                                </li>                                                               
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                                        <span class="nk-menu-text">Complainant</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="<?php echo EMPLOYEE_CUSTOMER_LIST_LINK; ?>" class="nk-menu-link"><span class="nk-menu-text">Complainant List</span></a>
                                            <a href="<?php echo EMPLOYEE_CUSTOMER_REGISTER_LINK; ?>" class="nk-menu-link"><span class="nk-menu-text">Add Complainant</span></a>
                                        </li>                                       
                                    </ul>                                     
                                </li>                               
                                <!-- .nk-menu-item -->                                                              
                                <!--                                <li class="nk-menu-item has-sub">
                                                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                                                        <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                                                                        <span class="nk-menu-text">User Manage</span>
                                                                    </a>
                                                                    <ul class="nk-menu-sub">
                                                                        <li class="nk-menu-item">
                                                                            <a href="#" class="nk-menu-link"><span class="nk-menu-text">User List - Default</span></a>
                                                                        </li>                                       
                                                                    </ul> 
                                                                    .nk-menu-sub 
                                                                </li>-->
                                <!-- .nk-menu-item -->
                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-sidebar-menu -->
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-element -->
            </div>
            <!-- sidebar @e -->