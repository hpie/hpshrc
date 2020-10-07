<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:index.html');
    exit;
}
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
// DB table to use

$table = 'employee emp';
// Table's primary key
$primaryKey = 'emp.employee_user_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(      
    array('db' => 'emp.employee_user_id', 'dt' =>'employee_user_id'),
    array('db' => 'emp.user_firstname', 'dt' =>'user_firstname'),
    array('db' => 'emp.user_lastname', 'dt' =>'user_lastname'),   
    array('db' => 'emp.user_email_id', 'dt' =>'user_email_id'),               
    array('db' => 'emp.user_email_verified_status', 'dt' =>'user_email_verified_status'),
    array('db' => 'emp.user_locked_status', 'dt' =>'user_locked_status'),
    array('db' => 'emp.user_status', 'dt' =>'user_status')   
);
include 'conn.php';

$where="";

//if(!empty($_REQUEST['search']['value'])){
//    $value=$_REQUEST['search']['value'];
//    $where.=" (hc.category_title LIKE '%$value%' OR hc1.category_title LIKE '%$value%' OR huf.upload_file_title LIKE '%$value%' OR huf.upload_file_desc LIKE '%$value%' OR huf.upload_file_original_name LIKE '%$value%' OR huf.upload_file_status LIKE '%$value%') ";
//}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
require('ssp.class.php');
echo json_encode(
       SSP::admin_employee_list($_REQUEST, $sql_details, $table, $primaryKey, $columns,$where)
);


