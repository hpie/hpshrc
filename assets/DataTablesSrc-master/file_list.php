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

$table = 'user_uploadd_files';
// Table's primary key
$primaryKey = 'uploadd_file_id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(      
    array('db' => 'uploadd_file_id', 'dt' =>'uploadd_file_id'),
    array('db' => 'uploadd_file_original_name', 'dt' =>'uploadd_file_original_name')
);
include 'conn.php';

$where="";
//print_r($_REQUEST);die;

//$emp_rmsa_user_id = $_REQUEST['emp_rmsa_user_id'];
//$uploaded_file_tag=$_REQUEST['uploaded_file_tag'];
//$uploaded_file_class=$_REQUEST['uploaded_file_class'];
//$uploaded_file_subject=$_REQUEST['uploaded_file_subject'];
//
//$where=" uploaded_file_volroot is null AND rmsa_employee_users_id=$emp_rmsa_user_id ";
//
//if(!empty($uploaded_file_tag)){
//        $where .=" AND uploaded_file_tag LIKE '%$uploaded_file_tag%' ";
//}
//if(!empty($uploaded_file_class)){
//    $where.=" AND uploaded_file_class = '$uploaded_file_class' ";
//}
//if(!empty($uploaded_file_subject)){
//    $where.=" AND uploaded_file_subject = '$uploaded_file_subject' ";
//}
//
//if(!empty($_REQUEST['search']['value'])){
//    $value=$_REQUEST['search']['value'];
//    $where.=" AND (uploaded_file_title LIKE '%$value%' OR uploaded_file_type LIKE '%$value%' OR uploaded_file_category LIKE '%$value%' OR uploaded_file_desc LIKE '%$value%' OR uploaded_file_group LIKE '%$value%') ";
//}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
require('ssp.class.php');
echo json_encode(
       SSP::file_list($_REQUEST, $sql_details, $table, $primaryKey, $columns,$where)
);


