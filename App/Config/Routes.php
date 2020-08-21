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


//************************************Front side route****************************//
$routes->add('home', 'Home_c::index');
$routes->add('front-about', 'Home_c::about');
$routes->add('front-download', 'Home_c::download');
$routes->add('front-budget', 'Home_c::budget');
$routes->add('front-gallery', 'Home_c::gallery');
$routes->add('front-contact', 'Home_c::contact');


//************************************Employee side route****************************//
$routes->add('employee-login', 'Elogin_c::index');
$routes->add('employee-logout', 'Elogin_c::logout');
$routes->add('employee-update-profile', 'Employee_c::update_profile');
    $routes->add('employee-dashboard', 'Employee_c::dashboard');








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