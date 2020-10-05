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

$table = 'cases cs';
// Table's primary key
$primaryKey = 'cs.cases_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(      
    array('db' => 'cs.cases_id', 'dt' =>'cases_id'),
    array('db' => 'cs.cases_priority', 'dt' =>'cases_priority'),
    array('db' => 'cs.cases_title', 'dt' =>'cases_title'),
    array('db' => 'cs.cases_assign_to', 'dt' =>'cases_assign_to'),
    array('db' => 'cs.cases_status', 'dt' =>'cases_status'),
    array('db' => 'cs.cases_dt_created', 'dt' =>'cases_dt_created'),
    array('db' => 'emp.user_firstname', 'dt' =>'user_firstname'),
    array('db' => 'emp.user_lastname', 'dt' =>'user_lastname')    
);
include 'conn.php';
$customer_id=$_REQUEST['customer_id'];
$where=" cs.refCustomer_id=$customer_id ";

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
    SSP::front_cases_list($_REQUEST, $sql_details, $table, $primaryKey, $columns,$where)
);


