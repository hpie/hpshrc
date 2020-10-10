<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home_c');  
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


$routes->get('/', 'Home_c::index');
$routes->add('404_override', 'Home_c::page404');
$routes->add('errorpage', 'Home_c::page404');
//************************************Admin side route****************************//
$routes->add('admin-login', 'Login_c::index');
$routes->add('admin-logout', 'Login_c::logout');
$routes->add('admin-update-profile', 'Admin_c::update_profile');
$routes->add('admin-dashboard', 'Admin_c::dashboard');

//************causes*****************//
$routes->add('admin-file-list', 'Causes_c::file_list');
$routes->add('admin-add-causes', 'Causes_c::add_causes');
$routes->add('admin-active-causes', 'Causes_c::active_causes');
$routes->add('admin-edit-causes/(:any)', 'Causes_c::edit_causes/$1');
$routes->add('admin-load-sub-categories', 'Causes_c::load_sub_type');
$routes->add('admin-customers-list', 'Customers_a::customers_list');
$routes->add('admin-customer-approve-status', 'Customers_a::approve_status');
$routes->add('admin-customer-registration', 'Customers_a::create_customer');
$routes->add('admin-edit-customer/(:any)', 'Customers_a::edit_customer/$1');

$routes->add('admin-employee-list', 'Employee_a::employee_list');
$routes->add('admin-employee-approve-status', 'Employee_a::approve_status');
$routes->add('admin-employee-registration', 'Employee_a::create_employee');
$routes->add('admin-edit-employee/(:any)', 'Employee_a::edit_employee/$1');

$routes->add('admin-add-category', 'Categories_c::add_category');
$routes->add('admin-categories-list', 'Categories_c::categories_list');
$routes->add('admin-active-category', 'Categories_c::active_category');
$routes->add('admin-edit-category/(:any)', 'Categories_c::edit_category/$1');

$routes->add('admin-add-sub-category', 'Categories_c::add_sub_category');
$routes->add('admin-edit-sub-category/(:any)', 'Categories_c::edit_sub_category/$1');

$routes->add('admin-add-expense', 'Expense_c::add_expense');
$routes->add('admin-expense-list/(:any)', 'Expense_c::expense_list/$1');
$routes->add('admin-edit-expense/(:any)', 'Expense_c::edit_expense/$1');

//************************************Front side route****************************//
$routes->add('home', 'Home_c::index');
$routes->add('front-about', 'Home_c::about');
$routes->add('front-download', 'Home_c::download');
$routes->add('front-budget/(:any)', 'Home_c::budget/$1');
$routes->add('front-gallery', 'Home_c::gallery');
$routes->add('front-contact', 'Home_c::contact');
$routes->add('customer-login', 'Home_c::login');
$routes->add('customer-logout', 'Home_c::logout');
$routes->add('case-request', 'Common_c::add_cases');
$routes->add('front-view-cases/(:any)', 'Cases_f::view_cases/$1');
$routes->add('front-list-cases', 'Cases_f::cases_list');
$routes->add('front-add-comment', 'Cases_f::add_comment');

//************************************Employee side route****************************//
$routes->add('employee-login', 'Elogin_c::index');
$routes->add('employee-logout', 'Elogin_c::logout');
$routes->add('employee-update-profile', 'Employee_c::update_profile');
$routes->add('employee-dashboard', 'Employee_c::dashboard');
$routes->add('employee-customers-list', 'Customers_e::customers_list');
$routes->add('employee-customer-registration', 'Customers_e::create_customer');
$routes->add('employee-edit-customer/(:any)', 'Customers_e::edit_customer/$1');

$routes->add('approve-status', 'Customers_e::approve_status');
$routes->add('employee-add-cases', 'Cases_e::add_cases');
$routes->add('employee-edit-cases/(:any)', 'Cases_e::edit_cases/$1');
$routes->add('employee-list-cases', 'Cases_e::cases_list');
$routes->add('employee-view-cases/(:any)', 'Cases_e::view_cases/$1');
$routes->add('employee-add-comment', 'Cases_e::add_comment');



//************************************Customer Registration****************************//
$routes->add('customer-registration', 'Common_c::create_customer');
$routes->add('email-verify/(:any)/(:any)', 'Common_c::verify_email/$1/$2');







/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
