<?php

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

$table = 'hpshrc_upload_files huf';
// Table's primary key
$primaryKey = 'huf.upload_file_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(      
    array('db' => 'huf.upload_file_id', 'dt' =>'upload_file_id'),
    array('db' => 'huf.upload_file_original_name', 'dt' =>'upload_file_original_name'),
     array('db' => 'huf.upload_file_title', 'dt' =>'upload_file_title'),
     array('db' => 'huf.upload_file_desc', 'dt' =>'upload_file_desc'),
    array('db' => 'huf.upload_file_ref_no', 'dt' =>'upload_file_ref_no'),
    array('db' => 'huf.upload_file_type', 'dt' =>'upload_file_type'),
    array('db' => 'huf.upload_file_sub_type', 'dt' =>'upload_file_sub_type'),
    array('db' => 'huf.upload_file_status', 'dt' =>'upload_file_status'),
     array('db' => 'huf.upload_file_location', 'dt' =>'upload_file_location'),
    array('db' => 'hc.category_title as category_title_main', 'dt' =>'category_title_main'),
    array('db' => 'hc1.category_title as category_title_sub', 'dt' =>'category_title_sub')
);
include 'conn.php';

$where="";
$category_code = $_REQUEST['category_code'];
$where=" huf.upload_file_status='ACTIVE' AND huf.upload_file_type='$category_code' ";

if(!empty($_REQUEST['search']['value'])){
    $value=$_REQUEST['search']['value'];
    $where.=" AND (hc.category_title LIKE '%$value%' OR hc1.category_title LIKE '%$value%' OR huf.upload_file_title LIKE '%$value%' OR huf.upload_file_desc LIKE '%$value%' OR huf.upload_file_original_name LIKE '%$value%' OR huf.upload_file_status LIKE '%$value%') ";
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
require('ssp.class.php');
echo json_encode(
       SSP::file_list_download($_REQUEST, $sql_details, $table, $primaryKey, $columns,$where)
);


