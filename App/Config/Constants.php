<?php

//--------------------------------------------------------------------
// App Namespace
//--------------------------------------------------------------------
// This defines the default Namespace that is used throughout
// CodeIgniter to refer to the Application directory. Change
// this constant to change the namespace that all application
// classes should use.
//
// NOTE: changing this will require manually modifying the
// existing namespaces of App\* namespaced-classes.
//
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
|--------------------------------------------------------------------------
| Composer Path
|--------------------------------------------------------------------------
|
| The path that Composer's autoload file is expected to live. By default,
| the vendor folder is in the Root directory, but you can customize that here.
*/
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php'); 

/*
|--------------------------------------------------------------------------
| Timing Constants
|--------------------------------------------------------------------------
|
| Provide simple ways to work with the myriad of PHP functions that
| require information to be in seconds.
*/
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2592000);
defined('YEAR')   || define('YEAR', 31536000);
defined('DECADE') || define('DECADE', 315360000);

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


//**************************************ADMIN ROUTE****************************//
define('ADMIN_LOGIN_LINK', BASE_URL_CI.'/admin-login');
define('ADMIN_LOGOUT_LINK', BASE_URL_CI.'/admin-logout');
define('ADMIN_PROFILE_LINK', BASE_URL_CI.'/admin-profile');
define('ADMIN_DASHBOARD_LINK', BASE_URL_CI.'/admin-dashboard');
define('ADMIN_UPDATE_PROFILE_LINK', BASE_URL_CI.'/admin-update-profile');



define('ADMIN_FILE_LIST_LINK', BASE_URL_CI.'/admin-file-list');
define('ADMIN_FILE_DATATABLE_LIST_LINK', BASE_URL_CI.'/admin-file-datatables-list');
define('ADMIN_ADD_FILES_LINK', BASE_URL_CI.'/admin-add-causes');
define('ADMIN_EDIT_FILES_LINK', BASE_URL_CI.'/admin-edit-causes/');
define('ADMIN_FILES_ACTIVE_LINK',BASE_URL_CI."/admin-active-causes");
define('ADMIN_LOAD_SUB_CATEGORIES_LINK', BASE_URL_CI.'/admin-load-sub-categories');
define('ADMIN_CUSTOMER_LIST_LINK', BASE_URL_CI.'/admin-customers-list');
define('ADMIN_APPROVE_STATUS',BASE_URL."/admin-customer-approve-status");

//**************************************EMPLOYEE ROUTE****************************//
define('EMPLOYEE_LOGIN_LINK', BASE_URL_CI.'/employee-login');
define('EMPLOYEE_LOGOUT_LINK', BASE_URL_CI.'/employee-logout');
define('EMPLOYEE_PROFILE_LINK', BASE_URL_CI.'/employee-profile');
define('EMPLOYEE_DASHBOARD_LINK', BASE_URL_CI.'/employee-dashboard');
define('EMPLOYEE_UPDATE_PROFILE_LINK', BASE_URL_CI.'/employee-update-profile');
define('EMPLOYEE_CUSTOMER_LIST_LINK', BASE_URL_CI.'/employee-customers-list');
define('APPROVE_STATUS',BASE_URL."/approve-status");

//**************************************FRONT ROUTE****************************//
define('FRONT_ABOUT_LINK', BASE_URL_CI.'/front-about');
define('FRONT_DOWNLOAD_LINK', BASE_URL_CI.'/front-download');
define('FRONT_BUDGET_LINK', BASE_URL_CI.'/front-budget');
define('FRONT_GALLERY_LINK', BASE_URL_CI.'/front-gallery');
define('FRONT_CONTACT_LINK', BASE_URL_CI.'/front-contact');

define('CUSTOMER_EDIT_LINK',BASE_URL."/edit-customer/");
define('CUSTOMER_REGISTER_LINK',BASE_URL."/customer-registration");
define('CUSTOMER_ACTIVE_EMAIL_LINK',BASE_URL_CI."/email-verify/");


//**************************************COMMON ROUTE****************************//
define('PAGE_404_LINK', BASE_URL_CI.'/errorpage');


//**************************************FRONT TITLE****************************//
define('FRONT_HOME_TITLE', 'HPSHRC-FRONT-HOME');
define('FRONT_ABOUT_TITLE', 'HPSHRC-FRONT-ABOUT');
define('FRONT_DOWNLOAD_TITLE', 'HPSHRC-FRONT-DOWNLOAD');
define('FRONT_BUDGET_TITLE', 'HPSHRC-FRONT-BUDGET');
define('FRONT_GALLERY_TITLE', 'HPSHRC-FRONT-GALLERY');
define('FRONT_CONTACT_TITLE', 'HPSHRC-FRONT-CONTACT');
define('FRONT_404_TITLE', 'HPSHRC-404');
define('CUSTOMER_REGISTRATION_TITLE', 'HPSHRC-CUSTOMER-REGISTRATION');
define('EDIT_CUSTOMER_TITLE', 'HPSHRC-EDIT-CUSTOMER');

//**************************************Employee TITLE****************************//
define('EMPLOYEE_LOGIN_TITLE', 'HPSHRC-EMPLOYEE-LOGIN');
define('EMPLOYEE_PROFILE_TITLE', 'HPSHRC-EMPLOYEE-PROFILE');
define('EMPLOYEE_UPDATE_PROFILE_TITLE', 'HPSHRC-EMPLOYEE-UPDATE-PROFILE');
define('EMPLOYEE_DASHBOARD_TITLE', 'HPSHRC-EMPLOYEE-DASHBOARD');
define('EMPLOYEE_CUSTOMER_LIST_TITLE', 'HPSHRC-EMPLOYEE-CUSTOMER-LIST');


//**************************************ADMIN TITLE****************************//
define('ADMIN_LOGIN_TITLE', 'HPSHRC-ADMIN-LOGIN');
define('ADMIN_PROFILE_TITLE', 'HPSHRC-ADMIN-PROFILE');
define('ADMIN_UPDATE_PROFILE_TITLE', 'HPSHRC-ADMIN-UPDATE-PROFILE');
define('ADMIN_DASHBOARD_TITLE', 'HPSHRC-ADMIN-DASHBOARD');
define('ADMIN_FILE_LIST_TITLE', 'HPSHRC-ADMIN-FILE-LIST');
define('ADMIN_ADD_CAUSES_TITLE', 'HPSHRC-ADMIN-ADD-CAUSES');
define('ADMIN_EDIT_CAUSES_TITLE', 'HPSHRC-ADMIN-EDIT-CAUSES');
define('ADMIN_CUSTOMER_LIST_TITLE', 'HPSHRC-ADMIN-CUSTOMER-LIST');

