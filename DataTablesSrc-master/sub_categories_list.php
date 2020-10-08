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

$table = 'hpshrc_categories hc';
// Table's primary key
$primaryKey = 'hc.category_code';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(      
    array('db' => 'hc.category_code', 'dt' =>'category_code'),
    array('db' => 'hc.category_title', 'dt' =>'category_title'),
    array('db' => 'hc.category_description', 'dt' =>'category_description'),
    array('db' => 'hc.ref_category_code', 'dt' =>'ref_category_code'),
    array('db' => 'hc.category_ref_type', 'dt' =>'category_ref_type'),
    array('db' => 'hc.category_status', 'dt' =>'category_status')    
);
include 'conn.php';

$where=" hc.category_ref_type='SUB_TYPE' ";    


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
require('ssp.class.php');
echo json_encode(
       SSP::sub_categories_list($_REQUEST, $sql_details, $table, $primaryKey, $columns,$where)
);


