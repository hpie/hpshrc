<?php
/*
 * Helper functions for building a DataTables server-side processing SQL query
 *
 * The static functions in this class are just helper functions to help build
 * the SQL used in the DataTables demo server-side processing scripts. These
 * functions obviously do not represent all that can be done with server-side
 * processing, they are intentionally simple to show how it works. More complex
 * server-side processing operations will likely require a custom script.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
//$protocol = (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS'])!== 'off') ? 'https' : 'http';
//$base_url = $protocol.'://'.$_SERVER['HTTP_HOST'];

include '../common_url.php';
//define('BASE_URL', $url);
// REMOVE THIS BLOCK - used for DataTables test environment only!
$file = $_SERVER['DOCUMENT_ROOT'].'/datatables/pdo.php';
if ( is_file( $file ) ) {
	include( $file );
}
class SSP {
	/**
	 * Create the data output array for the DataTables rows
	 *
	 *  @param  array $columns Column information array
	 *  @param  array $data    Data from the SQL get
	 *  @return array          Formatted data in a row based format
	 */
    
        static function data_output($columns, $data) {
//      print_r($columns);die;
        $out = array();
        for ($i = 0, $ien = count($data); $i < $ien; $i++) {
            $row = array();
            for ($j = 0, $jen = count($columns); $j < $jen; $j++) {
                $column = $columns[$j];
                // Is there a formatter?
                if (isset($column['formatter'])) {
                    $row[$column['dt']] = $column['formatter']($data[$i][$column['db']], $data[$i]);
                } else {                  
                    $row[$column['dt']] = $data[$i][$columns[$j]['dt']];
                }
            }
            $out[] = $row;
        }
        return $out;
    }
    
    
//	static function data_output ( $columns, $data )
//	{
//		$out = array();
//		for ( $i=0, $ien=count($data) ; $i<$ien ; $i++ ) {
//			$row = array();
//			for ( $j=0, $jen=count($columns) ; $j<$jen ; $j++ ) {
//				$column = $columns[$j];
//				// Is there a formatter?
//				if ( isset( $column['formatter'] ) ) {
//					$row[ $column['dt'] ] = $column['formatter']( $data[$i][ $column['db'] ], $data[$i] );
//				}
//				else {
//					$row[ $column['dt'] ] = $data[$i][ $columns[$j]['db'] ];
//				}
//			}
//			$out[] = $row;
//		}
//		return $out;
//	}
	/**
	 * Database connection
	 *
	 * Obtain an PHP PDO connection from a connection details array
	 *
	 *  @param  array $conn SQL connection details. The array should have
	 *    the following properties
	 *     * host - host name
	 *     * db   - database name
	 *     * user - user name
	 *     * pass - user password
	 *  @return resource PDO connection
	 */
	static function db ( $conn )
	{
		if ( is_array( $conn ) ) {
			return self::sql_connect( $conn );
		}
		return $conn;
	}
	/**
	 * Paging
	 *
	 * Construct the LIMIT clause for server-side processing SQL query
	 *
	 *  @param  array $request Data sent to server by DataTables
	 *  @param  array $columns Column information array
	 *  @return string SQL limit clause
	 */
	static function limit ( $request, $columns )
	{
		$limit = '';
		if ( isset($request['start']) && $request['length'] != -1 ) {
			$limit = "LIMIT ".intval($request['start']).", ".intval($request['length']);
		}
		return $limit;
	}
	/**
	 * Ordering
	 *
	 * Construct the ORDER BY clause for server-side processing SQL query
	 *
	 *  @param  array $request Data sent to server by DataTables
	 *  @param  array $columns Column information array
	 *  @return string SQL order by clause
	 */
	static function order ( $request, $columns )
	{
		$order = '';
		if ( isset($request['order']) && count($request['order']) ) {
			$orderBy = array();
			$dtColumns = self::pluck( $columns, 'dt' );
			for ( $i=0, $ien=count($request['order']) ; $i<$ien ; $i++ ) {
				// Convert the column index into the column data property
				$columnIdx = intval($request['order'][$i]['column']);
				$requestColumn = $request['columns'][$columnIdx];
				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column = $columns[ $columnIdx ];
				if ( $requestColumn['orderable'] == 'true' ) {
					$dir = $request['order'][$i]['dir'] === 'asc' ?
						'ASC' :
						'DESC';
					$orderBy[] = ''.$column['db'].' '.$dir;
				}
			}
			if ( count( $orderBy ) ) {
				$order = 'ORDER BY '.implode(', ', $orderBy);
			}
		}
		return $order;
	}
	/**
	 * Searching / Filtering
	 *
	 * Construct the WHERE clause for server-side processing SQL query.
	 *
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here performance on large
	 * databases would be very poor
	 *
	 *  @param  array $request Data sent to server by DataTables
	 *  @param  array $columns Column information array
	 *  @param  array $bindings Array of values for PDO bindings, used in the
	 *    sql_exec() function
	 *  @return string SQL where clause
	 */
	static function filter ( $request, $columns, &$bindings )
	{
		$globalSearch = array();
		$columnSearch = array();
		$dtColumns = self::pluck( $columns, 'dt' );
		if ( isset($request['search']) && $request['search']['value'] != '' ) {                    
			$str = $request['search']['value'];
			for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
				$requestColumn = $request['columns'][$i];
				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column = $columns[ $columnIdx ];
				if ( $requestColumn['searchable'] == 'true' ) {
					$binding = self::bind( $bindings, '%'.$str.'%', PDO::PARAM_STR );                                        
					$globalSearch[] = "".$column['db']." LIKE ".$binding;
				}
			}
		}
		// Individual column filtering
		if ( isset( $request['columns'] ) ) {
			for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
				$requestColumn = $request['columns'][$i];
				$columnIdx = array_search( $requestColumn['data'], $dtColumns );
				$column = $columns[ $columnIdx ];
				$str = $requestColumn['search']['value'];
				if ( $requestColumn['searchable'] == 'true' &&
				 $str != '' ) {
					$binding = self::bind( $bindings, '%'.$str.'%', PDO::PARAM_STR );
					$columnSearch[] = "".$column['db']." LIKE ".$binding;
				}
			}
		}
		// Combine the filters into a single string
		$where = '';
		if ( count( $globalSearch ) ) {
			$where = '('.implode(' OR ', $globalSearch).')';
		}
		if ( count( $columnSearch ) ) {
			$where = $where === '' ?
				implode(' AND ', $columnSearch) :
				$where .' AND '. implode(' AND ', $columnSearch);
		}
		if ( $where !== '' ) {
			$where = 'WHERE '.$where;
		}
		return $where;
	}
	/**
	 * Perform the SQL queries needed for an server-side processing requested,
	 * utilising the helper functions of this class, limit(), order() and
	 * filter() among others. The returned array is ready to be encoded as JSON
	 * in response to an SSP request, or can be modified if needed before
	 * sending back to the client.
	 *
	 *  @param  array $request Data sent to server by DataTables
	 *  @param  array|PDO $conn PDO connection resource or connection parameters array
	 *  @param  string $table SQL table to query
	 *  @param  string $primaryKey Primary key of the table
	 *  @param  array $columns Column information array
	 *  @return array          Server-side processing response array
	 */
	
         static function admin_customers_list ($request, $conn, $table, $primaryKey, $columns,$where_custom = '')
         {                         
		$bindings = array();
		$db = self::db( $conn );
                
                $columns_order=$columns;
		// Build the SQL query string from the request
                if (($request['order'][0]['column'])>0) {
                    $columnsArray = array();                   
                    foreach ($columns as $crow) {                       
                        if (substr_count($crow['db'], " as ")) {
                            $crow['db'] = explode(" as ", $crow['db'])[0];
                        }
                        array_push($columnsArray, $crow);
                    }
                    $columns_order = $columnsArray;
                }                
                
		$limit = self::limit( $request, $columns );                                               
		$order = self::order( $request, $columns_order );                               
                
		$where = self::filter( $request, $columns, $bindings );
//                $where="";
                if ($where_custom) {
                    if ($where) {
                        $where .= ' AND ' . $where_custom;
                    } else {
                        $where .= 'WHERE ' . $where_custom;
                    }
                } 
                
                $data = self::sql_exec( $db, $bindings,
			"SELECT ".implode(", ", self::pluck($columns, 'db'))."
			FROM $table                       
			$where
			$order 
			$limit"
		); 		
		// Data set length after filtering
		$resFilterLength = self::sql_exec( $db, $bindings,
			"SELECT COUNT({$primaryKey})
			FROM $table                       
			$where "
		);
		$recordsFiltered = $resFilterLength[0][0];
		// Total data set length
		$resTotalLength = self::sql_exec( $db,
			"SELECT COUNT({$primaryKey})
			FROM $table                       
                        "
		);
		$recordsTotal = $resTotalLength[0][0];                
                $result=self::data_output($columns,$data);
                $resData=array();
                if(!empty($result)){                    
                    foreach ($result as $row){                                                                         
                        $customer_id = $row['customer_id'];                                                                       
                        $verify_email_str='';
                        $title = 'Click to unverify email';
                        $class = 'btn_approve_reject_email btn btn-xs btn-success';
                        $text = "Email Verified <i class='fa fa-check'></i>";
                        $isactive = 1; 
                        $table='hpshrc_customer';
                        $table_update_field='customer_email_verified_status';
                        $table_where_field='customer_id';
                        if($row['customer_email_verified_status'] == 0){
                            $title = 'Click to verify email';
                            $class = 'btn_approve_reject_email btn btn-xs btn-danger';
                            $text  = "Verify Email <i class='fa fa-close'></i>";
                            $isactive = 0;                            
                        }                                                    
                        $verify_email_str="<button type='button' data-id='".$customer_id."' data-status = '".$isactive."' title='".$title."' class='".$class."' data-table = '".$table."' data-updatefield = '".$table_update_field."' data-wherefield = '".$table_where_field."'>".$text."</button>";                            //                                                
                        
                        
                        $locked_unlocked_str='';
                        $title = 'Click to locke customer';
                        $class = 'btn_lock_unlock_customer btn btn-xs btn-success';
                        $text = "Customer Unlocked <i class='fa fa-unlock'></i>";
                        $isactive = 1; 
                        $table='hpshrc_customer';
                        $table_update_field='customer_locked_status';
                        $table_where_field='customer_id';
                        if($row['customer_locked_status'] == 1){
                            $title = 'Click to unlocke customer';
                            $class = 'btn_lock_unlock_customer btn btn-xs btn-danger';
                            $text  = "Customer Locked <i class='fa fa-lock'></i></em>";
                            $isactive = 0;                            
                        }                                                    
                        $locked_unlocked_str="<button type='button' data-id='".$customer_id."' data-status = '".$isactive."' title='".$title."' class='".$class."' data-table = '".$table."' data-updatefield = '".$table_update_field."' data-wherefield = '".$table_where_field."'>".$text."</button>";                            //                                                
                        
                        $active_inactive_str='';
                        $title = 'Click to inactive customer';
                        $class = 'btn_active_inactive_customer btn btn-xs btn-success';
                        $text = "Customer Activated <i class='fa fa-check'></i>";
                        $isactive = "REMOVED"; 
                        $table='hpshrc_customer';
                        $table_update_field='customer_status';
                        $table_where_field='customer_id';
                        if($row['customer_status'] == "REMOVED"){
                            $title = 'Click to active customer';
                            $class = 'btn_active_inactive_customer btn btn-xs btn-danger';
                            $text  = "Customer Inactivated <i class='fa fa-close'></i>";
                            $isactive = "ACTIVE";                            
                        }                                                    
                        $active_inactive_str="<button type='button' data-id='".$customer_id."' data-status = '".$isactive."' title='".$title."' class='".$class."' data-table = '".$table."' data-updatefield = '".$table_update_field."' data-wherefield = '".$table_where_field."'>".$text."</button>";                            //                                                                                                
                        $row['index']='';
                        $row['action']="<a href='".BASE_URL_DATATABLES."admin-edit-customer/$customer_id' class='btn btn-xs btn-warning'>Edit  <em class='icon ni ni-edit-fill'></em></a>                            
                            $verify_email_str $locked_unlocked_str $active_inactive_str";
                        array_push($resData, $row);
                    }  
                }
		/*
		 * Output
		 */
		return array(
			"draw" => isset ( $request['draw'] ) ? intval( $request['draw'] ) : 0,
			"recordsTotal" => intval( $recordsTotal ),
			"recordsFiltered" => intval( $recordsFiltered ),
			"data" => $resData
		);
	}
        static function admin_employee_list ($request, $conn, $table, $primaryKey, $columns,$where_custom = '')
        {                         
		$bindings = array();
		$db = self::db( $conn );
                
                $columns_order=$columns;
		// Build the SQL query string from the request
                if (($request['order'][0]['column'])>0) {
                    $columnsArray = array();                   
                    foreach ($columns as $crow) {                       
                        if (substr_count($crow['db'], " as ")) {
                            $crow['db'] = explode(" as ", $crow['db'])[0];
                        }
                        array_push($columnsArray, $crow);
                    }
                    $columns_order = $columnsArray;
                }                
                
		$limit = self::limit( $request, $columns );                                               
		$order = self::order( $request, $columns_order );                               
                
		$where = self::filter( $request, $columns, $bindings );
//                $where="";
                if ($where_custom) {
                    if ($where) {
                        $where .= ' AND ' . $where_custom;
                    } else {
                        $where .= 'WHERE ' . $where_custom;
                    }
                } 
                
                $data = self::sql_exec( $db, $bindings,
			"SELECT ".implode(", ", self::pluck($columns, 'db'))."
			FROM $table                       
			$where
			$order 
			$limit"
		); 		
		// Data set length after filtering
		$resFilterLength = self::sql_exec( $db, $bindings,
			"SELECT COUNT({$primaryKey})
			FROM $table                       
			$where "
		);
		$recordsFiltered = $resFilterLength[0][0];
		// Total data set length
		$resTotalLength = self::sql_exec( $db,
			"SELECT COUNT({$primaryKey})
			FROM $table                       
                        "
		);
		$recordsTotal = $resTotalLength[0][0];                
                $result=self::data_output($columns,$data);
                $resData=array();
                if(!empty($result)){                    
                    foreach ($result as $row){                                                                         
                        $employee_id = $row['employee_user_id'];                                                                       
                        $verify_email_str='';
                        $title = 'Click to unverify email';
                        $class = 'btn_approve_reject_email btn btn-xs btn-success';
                        $text = "Email Verified <i class='fa fa-check'></i>";
                        $isactive = 1; 
                        $table='employee';
                        $table_update_field='user_email_verified_status';
                        $table_where_field='employee_user_id';
                        if($row['user_email_verified_status'] == 0){
                            $title = 'Click to verify email';
                            $class = 'btn_approve_reject_email btn btn-xs btn-danger';
                            $text  = "Verify Email <i class='fa fa-close'></i>";
                            $isactive = 0;                            
                        }                                                    
                        $verify_email_str="<button type='button' data-id='".$employee_id."' data-status = '".$isactive."' title='".$title."' class='".$class."' data-table = '".$table."' data-updatefield = '".$table_update_field."' data-wherefield = '".$table_where_field."'>".$text."</button>";                            //                                                
                        
                        
                        $locked_unlocked_str='';
                        $title = 'Click to locke employee';
                        $class = 'btn_lock_unlock_customer btn btn-xs btn-success';
                        $text = "Employee Unlocked <i class='fa fa-unlock'></i>";
                        $isactive = 1; 
                        $table='employee';
                        $table_update_field='user_locked_status';
                        $table_where_field='employee_user_id';
                        if($row['user_locked_status'] == 1){
                            $title = 'Click to unlocke employee';
                            $class = 'btn_lock_unlock_customer btn btn-xs btn-danger';
                            $text  = "Employee Locked <i class='fa fa-lock'></i></em>";
                            $isactive = 0;                            
                        }                                                    
                        $locked_unlocked_str="<button type='button' data-id='".$employee_id."' data-status = '".$isactive."' title='".$title."' class='".$class."' data-table = '".$table."' data-updatefield = '".$table_update_field."' data-wherefield = '".$table_where_field."'>".$text."</button>";                            //                                                
                        
                        $active_inactive_str='';
                        $title = 'Click to inactive employee';
                        $class = 'btn_active_inactive_customer btn btn-xs btn-success';
                        $text = "Employee Activated <i class='fa fa-check'></i>";
                        $isactive = "REMOVED"; 
                        $table='employee';
                        $table_update_field='user_status';
                        $table_where_field='employee_user_id';
                        if($row['user_status'] == "REMOVED"){
                            $title = 'Click to active employee';
                            $class = 'btn_active_inactive_customer btn btn-xs btn-danger';
                            $text  = "Employee Inactivated <i class='fa fa-close'></i>";
                            $isactive = "ACTIVE";                            
                        }                                                    
                        $active_inactive_str="<button type='button' data-id='".$employee_id."' data-status = '".$isactive."' title='".$title."' class='".$class."' data-table = '".$table."' data-updatefield = '".$table_update_field."' data-wherefield = '".$table_where_field."'>".$text."</button>";                            //                                                                                                
                        $row['index']='';
                        $row['action']="<a href='".BASE_URL_DATATABLES."admin-edit-employee/$employee_id' class='btn btn-xs btn-warning'>Edit  <em class='icon ni ni-edit-fill'></em></a>                            
                            $verify_email_str $locked_unlocked_str $active_inactive_str";
                        array_push($resData, $row);
                    }  
                }
		/*
		 * Output
		 */
		return array(
			"draw" => isset ( $request['draw'] ) ? intval( $request['draw'] ) : 0,
			"recordsTotal" => intval( $recordsTotal ),
			"recordsFiltered" => intval( $recordsFiltered ),
			"data" => $resData
		);
	}
        
         static function customers_list ($request, $conn, $table, $primaryKey, $columns,$where_custom = '')
         {                         
		$bindings = array();
		$db = self::db( $conn );
                
                $columns_order=$columns;
		// Build the SQL query string from the request
                if (($request['order'][0]['column'])>0) {
                    $columnsArray = array();                   
                    foreach ($columns as $crow) {                       
                        if (substr_count($crow['db'], " as ")) {
                            $crow['db'] = explode(" as ", $crow['db'])[0];
                        }
                        array_push($columnsArray, $crow);
                    }
                    $columns_order = $columnsArray;
                }                
                
		$limit = self::limit( $request, $columns );                                               
		$order = self::order( $request, $columns_order );                               
                
		$where = self::filter( $request, $columns, $bindings );
//                $where="";
                if ($where_custom) {
                    if ($where) {
                        $where .= ' AND ' . $where_custom;
                    } else {
                        $where .= 'WHERE ' . $where_custom;
                    }
                } 
                
                $data = self::sql_exec( $db, $bindings,
			"SELECT ".implode(", ", self::pluck($columns, 'db'))."
			FROM $table                       
			$where
			$order 
			$limit"
		); 		
		// Data set length after filtering
		$resFilterLength = self::sql_exec( $db, $bindings,
			"SELECT COUNT({$primaryKey})
			FROM $table                       
			$where "
		);
		$recordsFiltered = $resFilterLength[0][0];
		// Total data set length
		$resTotalLength = self::sql_exec( $db,
			"SELECT COUNT({$primaryKey})
			FROM $table                       
                        "
		);
		$recordsTotal = $resTotalLength[0][0];                
                $result=self::data_output($columns,$data);
                $resData=array();
                if(!empty($result)){                    
                    foreach ($result as $row){                                                                         
                        $customer_id = $row['customer_id'];                                               
                        
                        $verify_email_str='';
                        $title = 'Click to unverify email';
                        $class = 'btn_approve_reject_email btn btn-xs btn-success';
                        $text = "Email Verified <em class='icon ni ni-check-thick'></em>";
                        $isactive = 1; 
                        $table='hpshrc_customer';
                        $table_update_field='customer_email_verified_status';
                        $table_where_field='customer_id';
                        if($row['customer_email_verified_status'] == 0){
                            $title = 'Click to verify email';
                            $class = 'btn_approve_reject_email btn btn-xs btn-danger';
                            $text  = "Verify Email <em class='icon ni ni-edit-fill'></em>";
                            $isactive = 0;                            
                        }                                                    
                        $verify_email_str="<button type='button' data-id='".$customer_id."' data-status = '".$isactive."' title='".$title."' class='".$class."' data-table = '".$table."' data-updatefield = '".$table_update_field."' data-wherefield = '".$table_where_field."'>".$text."</button>";                            //                                                
                        
                        
                        $locked_unlocked_str='';
                        $title = 'Click to locke customer';
                        $class = 'btn_lock_unlock_customer btn btn-xs btn-success';
                        $text = "Customer Unlocked <em class='icon ni ni-unlock-fill'></em>";
                        $isactive = 1; 
                        $table='hpshrc_customer';
                        $table_update_field='customer_locked_status';
                        $table_where_field='customer_id';
                        if($row['customer_locked_status'] == 1){
                            $title = 'Click to unlocke customer';
                            $class = 'btn_lock_unlock_customer btn btn-xs btn-danger';
                            $text  = "Customer Locked <em class='icon ni ni-lock-fill'></em>";
                            $isactive = 0;                            
                        }                                                    
                        $locked_unlocked_str="<button type='button' data-id='".$customer_id."' data-status = '".$isactive."' title='".$title."' class='".$class."' data-table = '".$table."' data-updatefield = '".$table_update_field."' data-wherefield = '".$table_where_field."'>".$text."</button>";                            //                                                
                        
                        $active_inactive_str='';
                        $title = 'Click to inactive customer';
                        $class = 'btn_active_inactive_customer btn btn-xs btn-success';
                        $text = "Customer Activated <em class='icon ni ni-user-check-fill'></em>";
                        $isactive = "REMOVED"; 
                        $table='hpshrc_customer';
                        $table_update_field='customer_status';
                        $table_where_field='customer_id';
                        if($row['customer_status'] == "REMOVED"){
                            $title = 'Click to active customer';
                            $class = 'btn_active_inactive_customer btn btn-xs btn-danger';
                            $text  = "Customer Inactivated <em class='icon ni ni-user-cross-fill'></em>";
                            $isactive = "ACTIVE";                            
                        }                                                    
                        $active_inactive_str="<button type='button' data-id='".$customer_id."' data-status = '".$isactive."' title='".$title."' class='".$class."' data-table = '".$table."' data-updatefield = '".$table_update_field."' data-wherefield = '".$table_where_field."'>".$text."</button>";                            //                                                                                                
                        $row['index']='';
                        $row['action']="<a href='".BASE_URL_DATATABLES."employee-edit-customer/$customer_id' class='btn btn-xs btn-warning'>Edit  <em class='icon ni ni-edit-fill'></em></a>                            
                            $verify_email_str $locked_unlocked_str $active_inactive_str";
                        array_push($resData, $row);
                    }  
                }
		/*
		 * Output
		 */
		return array(
			"draw" => isset ( $request['draw'] ) ? intval( $request['draw'] ) : 0,
			"recordsTotal" => intval( $recordsTotal ),
			"recordsFiltered" => intval( $recordsFiltered ),
			"data" => $resData
		);
	}
        
           static function front_cases_list ($request, $conn, $table, $primaryKey, $columns,$where_custom = '')
         {               
		$bindings = array();
		$db = self::db( $conn );
                
                $columns_order=$columns;
		// Build the SQL query string from the request
                if (($request['order'][0]['column'])>0) {
                    $columnsArray = array();                   
                    foreach ($columns as $crow) {                       
                        if (substr_count($crow['db'], " as ")) {
                            $crow['db'] = explode(" as ", $crow['db'])[0];
                        }
                        array_push($columnsArray, $crow);
                    }
                    $columns_order = $columnsArray;
                }                
                
		$limit = self::limit( $request, $columns );                                               
		$order = self::order( $request, $columns_order );                               
                
		$where = self::filter( $request, $columns, $bindings );
//                $where="";
                if ($where_custom) {
                    if ($where) {
                        $where .= ' AND ' . $where_custom;
                    } else {
                        $where .= 'WHERE ' . $where_custom;
                    }
                } 
                
                $data = self::sql_exec( $db, $bindings,
			"SELECT ".implode(", ", self::pluck($columns, 'db'))."
			FROM $table
                        LEFT JOIN employee emp
                        ON emp.employee_user_id=cs.cases_assign_to
			$where
			$order 
			$limit"
		); 		
		// Data set length after filtering
		$resFilterLength = self::sql_exec( $db, $bindings,
			"SELECT COUNT({$primaryKey})
			FROM $table
                        LEFT JOIN employee emp
                        ON emp.employee_user_id=cs.cases_assign_to
			$where "
		);
		$recordsFiltered = $resFilterLength[0][0];
		// Total data set length
		$resTotalLength = self::sql_exec( $db,
			"SELECT COUNT({$primaryKey})
			FROM $table
                        LEFT JOIN employee emp
                        ON emp.employee_user_id=cs.cases_assign_to
                        "
		);
		$recordsTotal = $resTotalLength[0][0];                
                $result=self::data_output($columns,$data);
                $resData=array();
                if(!empty($result)){                    
                    foreach ($result as $row){                                                                         
                        $cases_id = $row['cases_id'];   
                        
                        
                        $hearing_date="0000-00-00";
                        $hearing_date_res = self::sql_exec($db,"SELECT comment_hearing_date FROM comment WHERE refCases_id = '{$cases_id}' ORDER BY comment_id DESC LIMIT 1"); 
                        if(!empty($hearing_date_res)){
                            $hearing_date=$hearing_date_res[0]['comment_hearing_date'];                        
                            
                        }
                        $row['hearing_date']=$hearing_date;
                        
                        
                        $row['index']='';
                        $row['employee_name']=$row['user_firstname'].' '.$row['user_lastname'];
                        $row['action']="<a href='".BASE_URL_DATATABLES."front-view-cases/$cases_id' class='btn btn-xs btn-primary'>View&nbsp;<em class='icon ni ni-eye-fill'></em></a>";
                        array_push($resData, $row);
                    }  
                }
		/*
		 * Output
		 */
		return array(
			"draw" => isset ( $request['draw'] ) ? intval( $request['draw'] ) : 0,
			"recordsTotal" => intval( $recordsTotal ),
			"recordsFiltered" => intval( $recordsFiltered ),
			"data" => $resData
		);
	}
        
        
         static function cases_list ($request, $conn, $table, $primaryKey, $columns,$where_custom = '')
         {               
		$bindings = array();
		$db = self::db( $conn );
                
                $columns_order=$columns;
		// Build the SQL query string from the request
                if (($request['order'][0]['column'])>0) {
                    $columnsArray = array();                   
                    foreach ($columns as $crow) {                       
                        if (substr_count($crow['db'], " as ")) {
                            $crow['db'] = explode(" as ", $crow['db'])[0];
                        }
                        array_push($columnsArray, $crow);
                    }
                    $columns_order = $columnsArray;
                }                
                
		$limit = self::limit( $request, $columns );                                               
		$order = self::order( $request, $columns_order );                               
                
		$where = self::filter( $request, $columns, $bindings );
//                $where="";
                if ($where_custom) {
                    if ($where) {
                        $where .= ' AND ' . $where_custom;
                    } else {
                        $where .= 'WHERE ' . $where_custom;
                    }
                }                 
                $data = self::sql_exec( $db, $bindings,
			"SELECT ".implode(", ", self::pluck($columns, 'db'))."
			FROM $table
                        LEFT JOIN employee emp
                        ON emp.employee_user_id=cs.cases_assign_to
                        LEFT JOIN hpshrc_customer cus
                        ON cus.customer_id=cs.refCustomer_id
			$where
			$order 
			$limit"
		); 		
		// Data set length after filtering
		$resFilterLength = self::sql_exec( $db, $bindings,
			"SELECT COUNT({$primaryKey})
			FROM $table
                        LEFT JOIN employee emp
                        ON emp.employee_user_id=cs.cases_assign_to
                        LEFT JOIN hpshrc_customer cus
                        ON cus.customer_id=cs.refCustomer_id
			$where "
		);
		$recordsFiltered = $resFilterLength[0][0];
		// Total data set length
		$resTotalLength = self::sql_exec( $db,
			"SELECT COUNT({$primaryKey})
			FROM $table
                        LEFT JOIN employee emp
                        ON emp.employee_user_id=cs.cases_assign_to
                        LEFT JOIN hpshrc_customer cus
                        ON cus.customer_id=cs.refCustomer_id
                        "
		);
		$recordsTotal = $resTotalLength[0][0];                
                $result=self::data_output($columns,$data);
                $resData=array();
                if(!empty($result)){                    
                    foreach ($result as $row){                                                                         
                        $cases_id = $row['cases_id'];

                        
                        $hearing_date="0000-00-00";
                        $hearing_date_res = self::sql_exec($db,"SELECT comment_hearing_date FROM comment WHERE refCases_id = '{$cases_id}' ORDER BY comment_id DESC LIMIT 1"); 
                        if(!empty($hearing_date_res)){
                            $hearing_date=$hearing_date_res[0]['comment_hearing_date'];                        
                            
                        }
                        $row['hearing_date']=$hearing_date;
                                                
                        $locked_unlocked_str='';
                        $title = 'Click to locke customer';
                        $class = 'btn_lock_unlock_customer btn btn-xs btn-success';
                        $text = "Customer Unlocked <em class='icon ni ni-unlock-fill'></em>";
                        $isactive = 1; 
                        $table='cases';
                        $table_update_field='is_block_user';
                        $table_where_field='cases_id';
                        if($row['is_block_user'] == 1){
                            $title = 'Click to unlocke customer';
                            $class = 'btn_lock_unlock_customer btn btn-xs btn-danger';
                            $text  = "Customer Locked <em class='icon ni ni-lock-fill'></em>";
                            $isactive = 0;                            
                        }                                                    
                        $locked_unlocked_str="<button type='button' data-id='".$cases_id."' data-status = '".$isactive."' title='".$title."' class='".$class."' data-table = '".$table."' data-updatefield = '".$table_update_field."' data-wherefield = '".$table_where_field."'>".$text."</button>";
                        
                        $row['index']='';
                                                                                                
                        $cases_status='';
                        if($row['cases_status']=='open'){
                            $cases_status="<button type='button' class='btn btn-xs btn-success'>OPEN</button>";                                                
                        }
                        if($row['cases_status']=='closed'){
                            $cases_status="<button type='button' class='btn btn-xs btn-danger'>CLOSED</button>";                                                
                        }
                        if($row['cases_status']=='inprogress'){
                            $cases_status="<button type='button' class='btn btn-xs btn-warning'>INPROGRESS</button>";                                                
                        }
                        $row['cases_status']=$cases_status;
                        
                        if($row['cases_assign_to']==0){                            
                            $row['user_firstname']="<button type='button' class='btn btn-xs btn-danger'>Not Assigned</button>";
                        }else{ 
                            $row['user_firstname']=$row['user_firstname'].' '.$row['user_lastname'];                        
                        }
                        $row['action']="<a href='".BASE_URL_DATATABLES."employee-edit-cases/$cases_id' class='btn btn-xs btn-warning'>Edit&nbsp;<em class='icon ni ni-edit-fill'></em></a>
                                <a href='".BASE_URL_DATATABLES."employee-view-cases/$cases_id' class='btn btn-xs btn-primary'>View&nbsp;<em class='icon ni ni-eye-fill'></em></a>                                
                                $locked_unlocked_str";
                        
//                        $row['customer_first_name']=$row['customer_first_name'].' '.$row['customer_middle_name'].' '.$row['customer_last_name'];
                                                                        
                        array_push($resData, $row);
                    }  
                }
		/*
		 * Output
		 */
		return array(
			"draw" => isset ( $request['draw'] ) ? intval( $request['draw'] ) : 0,
			"recordsTotal" => intval( $recordsTotal ),
			"recordsFiltered" => intval( $recordsFiltered ),
			"data" => $resData
		);
	}
        
        static function categories_list ($request, $conn, $table, $primaryKey, $columns,$where_custom = '')
	{                         
		$bindings = array();
		$db = self::db( $conn );
                
                $columns_order=$columns;
		// Build the SQL query string from the request
                if (($request['order'][0]['column'])>0) {
                    $columnsArray = array();                   
                    foreach ($columns as $crow) {                       
                        if (substr_count($crow['db'], " as ")) {
                            $crow['db'] = explode(" as ", $crow['db'])[0];
                        }
                        array_push($columnsArray, $crow);
                    }
                    $columns_order = $columnsArray;
                }                
                
		$limit = self::limit( $request, $columns );                                               
		$order = self::order( $request, $columns_order );                               
                
		$where = self::filter( $request, $columns, $bindings );
//                $where="";
                if ($where_custom) {
                    if ($where) {
                        $where .= ' AND ' . $where_custom;
                    } else {
                        $where .= 'WHERE ' . $where_custom;
                    }
                } 
                
                $data = self::sql_exec( $db, $bindings,
			"SELECT ".implode(", ", self::pluck($columns, 'db'))."
			FROM $table                        
			$where
			$order 
			$limit"
		); 		
		// Data set length after filtering
		$resFilterLength = self::sql_exec( $db, $bindings,
			"SELECT COUNT({$primaryKey})
			FROM   $table                        
			$where "
		);
		$recordsFiltered = $resFilterLength[0][0];
		// Total data set length
		$resTotalLength = self::sql_exec( $db,
			"SELECT COUNT({$primaryKey})
			FROM   $table                        
                        "
		);
		$recordsTotal = $resTotalLength[0][0];                
                $result=self::data_output($columns,$data);
                $resData=array();
                if(!empty($result)){                    
                    foreach ($result as $row){ 
                        $category_code = $row['category_code'];
                        $row['index']='';
                        $row['action']="<a href='".BASE_URL_DATATABLES."admin-edit-category/$category_code' class='btn btn-xs btn-warning'>Edit  <i class='fa fa-pencil'></i></a>";                ;                        
                        $title = 'Click to deactivate category';
                        $class = 'btn_approve_reject btn btn-success btn-xs';
                        $text = 'Active';
                        $isactive = 1;
                        if($row['category_status'] == 'REMOVED'){
                            $title = 'Click to active category';
                            $class = 'btn_approve_reject btn btn-danger btn-xs';
                            $text  = 'Removed';
                            $isactive = 0;
                        }                       
                        $row['category_status'] = "<button type='button' data-id='".$category_code."' data-status = '".$isactive."' title='".$title."' class='".$class." btn-xs'>".$text."</button>";                        
                        array_push($resData, $row);
                    }  
                }
		/*
		 * Output
		 */
		return array(
			"draw" => isset ( $request['draw'] ) ? intval( $request['draw'] ) : 0,
			"recordsTotal" => intval( $recordsTotal ),
			"recordsFiltered" => intval( $recordsFiltered ),
			"data" => $resData
		);
	}
        
        
          static function expense_list ($request, $conn, $table, $primaryKey, $columns,$where_custom = '')
	{                         
		$bindings = array();
		$db = self::db( $conn );
                
                $columns_order=$columns;
		// Build the SQL query string from the request
                if (($request['order'][0]['column'])>0) {
                    $columnsArray = array();                   
                    foreach ($columns as $crow) {                       
                        if (substr_count($crow['db'], " as ")) {
                            $crow['db'] = explode(" as ", $crow['db'])[0];
                        }
                        array_push($columnsArray, $crow);
                    }
                    $columns_order = $columnsArray;
                }                
                
		$limit = self::limit( $request, $columns );                                               
		$order = self::order( $request, $columns_order );                               
                
		$where = self::filter( $request, $columns, $bindings );
//                $where="";
                if ($where_custom) {
                    if ($where) {
                        $where .= ' AND ' . $where_custom;
                    } else {
                        $where .= 'WHERE ' . $where_custom;
                    }
                } 
                
                $data = self::sql_exec( $db, $bindings,
			"SELECT ".implode(", ", self::pluck($columns, 'db'))."
			FROM $table                        
			$where
			$order 
			$limit"
		); 		
		// Data set length after filtering
		$resFilterLength = self::sql_exec( $db, $bindings,
			"SELECT COUNT({$primaryKey})
			FROM   $table                        
			$where "
		);
		$recordsFiltered = $resFilterLength[0][0];
		// Total data set length
		$resTotalLength = self::sql_exec( $db,
			"SELECT COUNT({$primaryKey})
			FROM   $table                        
                        "
		);
		$recordsTotal = $resTotalLength[0][0];                
                $result=self::data_output($columns,$data);
                $resData=array();
                if(!empty($result)){                    
                    foreach ($result as $row){ 
                        $budget_id = $row['budget_id'];
                        $row['index']='';
                        $row['action']="<a href='".BASE_URL_DATATABLES."admin-edit-expense/$budget_id' class='btn btn-xs btn-warning'>Edit  <i class='fa fa-pencil'></i></a>";                                                                                       
                        array_push($resData, $row);
                    }  
                }
		/*
		 * Output
		 */
		return array(
			"draw" => isset ( $request['draw'] ) ? intval( $request['draw'] ) : 0,
			"recordsTotal" => intval( $recordsTotal ),
			"recordsFiltered" => intval( $recordsFiltered ),
			"data" => $resData
		);
	}
        
        static function sub_categories_list ($request, $conn, $table, $primaryKey, $columns,$where_custom = '')
	{                         
		$bindings = array();
		$db = self::db( $conn );
                
                $columns_order=$columns;
		// Build the SQL query string from the request
                if (($request['order'][0]['column'])>0) {
                    $columnsArray = array();                   
                    foreach ($columns as $crow) {                       
                        if (substr_count($crow['db'], " as ")) {
                            $crow['db'] = explode(" as ", $crow['db'])[0];
                        }
                        array_push($columnsArray, $crow);
                    }
                    $columns_order = $columnsArray;
                }                
                
		$limit = self::limit( $request, $columns );                                               
		$order = self::order( $request, $columns_order );                               
                
		$where = self::filter( $request, $columns, $bindings );
//                $where="";
                if ($where_custom) {
                    if ($where) {
                        $where .= ' AND ' . $where_custom;
                    } else {
                        $where .= 'WHERE ' . $where_custom;
                    }
                } 
                
                $data = self::sql_exec( $db, $bindings,
			"SELECT ".implode(", ", self::pluck($columns, 'db'))."
			FROM $table                        
			$where
			$order 
			$limit"
		); 		
		// Data set length after filtering
		$resFilterLength = self::sql_exec( $db, $bindings,
			"SELECT COUNT({$primaryKey})
			FROM   $table                        
			$where "
		);
		$recordsFiltered = $resFilterLength[0][0];
		// Total data set length
		$resTotalLength = self::sql_exec( $db,
			"SELECT COUNT({$primaryKey})
			FROM   $table                        
                        "
		);
		$recordsTotal = $resTotalLength[0][0];                
                $result=self::data_output($columns,$data);
                $resData=array();
                if(!empty($result)){                    
                    foreach ($result as $row){ 
                        $category_code = $row['category_code'];
                        $row['index']='';
                        $row['action']="<a href='".BASE_URL_DATATABLES."admin-edit-sub-category/$category_code' class='btn btn-xs btn-warning'>Edit  <i class='fa fa-pencil'></i></a>";                       
                        $title = 'Click to deactivate category';
                        $class = 'btn_approve_reject btn btn-success btn-xs';
                        $text = 'Active';
                        $isactive = 1;
                        if($row['category_status'] == 'REMOVED'){
                            $title = 'Click to active category';
                            $class = 'btn_approve_reject btn btn-danger btn-xs';
                            $text  = 'Removed';
                            $isactive = 0;
                        }                       
                        $row['category_status'] = "<button type='button' data-id='".$category_code."' data-status = '".$isactive."' title='".$title."' class='".$class." btn-xs'>".$text."</button>";                        
                        array_push($resData, $row);
                    }  
                }
		/*
		 * Output
		 */
		return array(
			"draw" => isset ( $request['draw'] ) ? intval( $request['draw'] ) : 0,
			"recordsTotal" => intval( $recordsTotal ),
			"recordsFiltered" => intval( $recordsFiltered ),
			"data" => $resData
		);
	}
          static function file_list ($request, $conn, $table, $primaryKey, $columns,$where_custom = '')
	{                         
		$bindings = array();
		$db = self::db( $conn );
                
                $columns_order=$columns;
		// Build the SQL query string from the request
                if (($request['order'][0]['column'])>0) {
                    $columnsArray = array();                   
                    foreach ($columns as $crow) {                       
                        if (substr_count($crow['db'], " as ")) {
                            $crow['db'] = explode(" as ", $crow['db'])[0];
                        }
                        array_push($columnsArray, $crow);
                    }
                    $columns_order = $columnsArray;
                }                
                
		$limit = self::limit( $request, $columns );                                               
		$order = self::order( $request, $columns_order );                               
                
//		$where = self::filter( $request, $columns, $bindings );
                $where="";
                if ($where_custom) {
                    if ($where) {
                        $where .= ' AND ' . $where_custom;
                    } else {
                        $where .= 'WHERE ' . $where_custom;
                    }
                } 
                
                $data = self::sql_exec( $db, $bindings,
			"SELECT ".implode(", ", self::pluck($columns, 'db'))."
			FROM $table
                        INNER JOIN hpshrc_categories hc
                        ON huf.upload_file_type=hc.category_code
                        INNER JOIN hpshrc_categories hc1
                        ON huf.upload_file_sub_type=hc1.category_code
			$where
			$order 
			$limit"
		); 		
		// Data set length after filtering
		$resFilterLength = self::sql_exec( $db, $bindings,
			"SELECT COUNT({$primaryKey})
			FROM   $table
                        INNER JOIN hpshrc_categories hc
                        ON huf.upload_file_type=hc.category_code
                        INNER JOIN hpshrc_categories hc1
                        ON huf.upload_file_sub_type=hc1.category_code
			$where "
		);
		$recordsFiltered = $resFilterLength[0][0];
		// Total data set length
		$resTotalLength = self::sql_exec( $db,
			"SELECT COUNT({$primaryKey})
			FROM   $table 
                        INNER JOIN hpshrc_categories hc
                        ON huf.upload_file_type=hc.category_code
                        INNER JOIN hpshrc_categories hc1
                        ON huf.upload_file_sub_type=hc1.category_code
                        "
		);
		$recordsTotal = $resTotalLength[0][0];                
                $result=self::data_output($columns,$data);
                $resData=array();
                if(!empty($result)){                    
                    foreach ($result as $row){ 
//                            print_r($row);die;
                        $upload_file_id = $row['upload_file_id'];
                        $row['index']='';
                        $row['action']="<a href='".BASE_URL_DATATABLES."admin-edit-causes/$upload_file_id' class='btn btn-xs btn-warning'>Edit  <i class='fa fa-pencil'></i></a>";
                        
                        $title = 'Click to deactivate causes';
                        $class = 'btn_approve_reject btn btn-success btn-xs';
                        $text = 'Active';
                        $isactive = 1;
                        if($row['upload_file_status'] == 'REMOVED'){
                            $title = 'Click to active causes';
                            $class = 'btn_approve_reject btn btn-danger btn-xs';
                            $text  = 'Removed';
                            $isactive = 0;
                        }
                        $row['upload_file_original_name']="<a target='_blank' class='download' href=".BASE_URL.'/uploads/doc/causes/'.$row['upload_file_location']."><u>".$row['upload_file_original_name']."</u></a>"; 
                        $row['upload_file_status'] = "<button type='button' data-id='".$upload_file_id."' data-status = '".$isactive."' title='".$title."' class='".$class." btn-xs'>".$text."</button>";                        
                        array_push($resData, $row);
                    }  
                }
		/*
		 * Output
		 */
		return array(
			"draw" => isset ( $request['draw'] ) ? intval( $request['draw'] ) : 0,
			"recordsTotal" => intval( $recordsTotal ),
			"recordsFiltered" => intval( $recordsFiltered ),
			"data" => $resData
		);
	}
        static function file_list_download ($request, $conn, $table, $primaryKey, $columns,$where_custom = '')
	{                         
		$bindings = array();
		$db = self::db( $conn );
                
		// Build the SQL query string from the request
                
                $columns_order=$columns;
		// Build the SQL query string from the request
                if (($request['order'][0]['column'])>0) {
                    $columnsArray = array();                   
                    foreach ($columns as $crow) {                       
                        if (substr_count($crow['db'], " as ")) {
                            $crow['db'] = explode(" as ", $crow['db'])[0];
                        }
                        array_push($columnsArray, $crow);
                    }
                    $columns_order = $columnsArray;
                }                
                
		$limit = self::limit( $request, $columns );                                               
		$order = self::order( $request, $columns_order );                 
//		$where = self::filter( $request, $columns, $bindings );   
                $where="";                                
                if ($where_custom) {
                    if ($where) {
                        $where .= ' AND ' . $where_custom;
                    } else {
                        $where .= 'WHERE ' . $where_custom;
                    }
                }                  
                             
                $data = self::sql_exec( $db, $bindings,
			"SELECT ".implode(", ", self::pluck($columns, 'db'))."
			FROM $table
                        INNER JOIN hpshrc_categories hc
                        ON huf.upload_file_type=hc.category_code
                        INNER JOIN hpshrc_categories hc1
                        ON huf.upload_file_sub_type=hc1.category_code
			$where
			$order
			$limit"
		); 		
		// Data set length after filtering
		$resFilterLength = self::sql_exec( $db, $bindings,
			"SELECT COUNT({$primaryKey})
			FROM   $table
                        INNER JOIN hpshrc_categories hc
                        ON huf.upload_file_type=hc.category_code
                        INNER JOIN hpshrc_categories hc1
                        ON huf.upload_file_sub_type=hc1.category_code
			$where "
		);
		$recordsFiltered = $resFilterLength[0][0];
		// Total data set length
		$resTotalLength = self::sql_exec( $db,
			"SELECT COUNT({$primaryKey})
			FROM   $table 
                        INNER JOIN hpshrc_categories hc
                        ON huf.upload_file_type=hc.category_code
                        INNER JOIN hpshrc_categories hc1
                        ON huf.upload_file_sub_type=hc1.category_code                        
                        "
		);
		$recordsTotal = $resTotalLength[0][0];                
                $result=self::data_output($columns,$data);
                $resData=array();
                if(!empty($result)){                    
                    foreach ($result as $row){ 
                        $upload_file_id = $row['upload_file_id'];
                        $row['index']=''; 
                        $row['download']="<a class='download' href=".BASE_URL.'/uploads/doc/causes/'.$row['upload_file_location']." download><u>Click here to download</u></a>"; 
                        array_push($resData, $row);
                    }  
                }
		/*
		 * Output
		 */
		return array(
			"draw" => isset ( $request['draw'] ) ? intval( $request['draw'] ) : 0,
			"recordsTotal" => intval( $recordsTotal ),
			"recordsFiltered" => intval( $recordsFiltered ),
			"data" => $resData
		);
	}
        
	/**
	 * The difference between this method and the simple one, is that you can
	 * apply additional where conditions to the SQL queries. These can be in
	 * one of two forms:
	 *
	 * * 'Result condition' - This is applied to the result set, but not the
	 *   overall paging information query - i.e. it will not effect the number
	 *   of records that a user sees they can have access to. This should be
	 *   used when you want apply a filtering condition that the user has sent.
	 * * 'All condition' - This is applied to all queries that are made and
	 *   reduces the number of records that the user can access. This should be
	 *   used in conditions where you don't want the user to ever have access to
	 *   particular records (for example, restricting by a login id).
	 *
	 *  @param  array $request Data sent to server by DataTables
	 *  @param  array|PDO $conn PDO connection resource or connection parameters array
	 *  @param  string $table SQL table to query
	 *  @param  string $primaryKey Primary key of the table
	 *  @param  array $columns Column information array
	 *  @param  string $whereResult WHERE condition to apply to the result set
	 *  @param  string $whereAll WHERE condition to apply to all queries
	 *  @return array          Server-side processing response array
	 */
	static function complex ( $request, $conn, $table, $primaryKey, $columns, $whereResult=null, $whereAll=null )
	{
		$bindings = array();
		$db = self::db( $conn );
		$localWhereResult = array();
		$localWhereAll = array();
		$whereAllSql = '';
		// Build the SQL query string from the request
		$limit = self::limit( $request, $columns );
		$order = self::order( $request, $columns );
		$where = self::filter( $request, $columns, $bindings );
		$whereResult = self::_flatten( $whereResult );
		$whereAll = self::_flatten( $whereAll );
		if ( $whereResult ) {
			$where = $where ?
				$where .' AND '.$whereResult :
				'WHERE '.$whereResult;
		}
		if ( $whereAll ) {
			$where = $where ?
				$where .' AND '.$whereAll :
				'WHERE '.$whereAll;
			$whereAllSql = 'WHERE '.$whereAll;
		}
		// Main query to actually get the data
		$data = self::sql_exec( $db, $bindings,
			"SELECT ".implode(", ", self::pluck($columns, 'db'))."
			 FROM $table
			 $where
			 $order
			 $limit"
		);
		// Data set length after filtering
		$resFilterLength = self::sql_exec( $db, $bindings,
			"SELECT COUNT({$primaryKey})
			 FROM   $table
			 $where"
		);
		$recordsFiltered = $resFilterLength[0][0];
		// Total data set length
		$resTotalLength = self::sql_exec( $db, $bindings,
			"SELECT COUNT({$primaryKey})
			 FROM   $table ".
			$whereAllSql
		);
		$recordsTotal = $resTotalLength[0][0];
		/*
		 * Output
		 */
		return array(
			"draw"            => isset ( $request['draw'] ) ?
				intval( $request['draw'] ) :
				0,
			"recordsTotal"    => intval( $recordsTotal ),
			"recordsFiltered" => intval( $recordsFiltered ),
			"data"            => self::data_output( $columns, $data )
		);
	}
	/**
	 * Connect to the database
	 *
	 * @param  array $sql_details SQL server connection details array, with the
	 *   properties:
	 *     * host - host name
	 *     * db   - database name
	 *     * user - user name
	 *     * pass - user password
	 * @return resource Database connection handle
	 */
	static function sql_connect ( $sql_details )
	{
		try {
			$db = @new PDO(
				"mysql:host={$sql_details['host']};dbname={$sql_details['db']}",
				$sql_details['user'],
				$sql_details['pass'],
				array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION )
			);
		}
		catch (PDOException $e) {
			self::fatal(
				"An error occurred while connecting to the database. ".
				"The error reported by the server was: ".$e->getMessage()
			);
		}
		return $db;
	}
	/**
	 * Execute an SQL query on the database
	 *
	 * @param  resource $db  Database handler
	 * @param  array    $bindings Array of PDO binding values from bind() to be
	 *   used for safely escaping strings. Note that this can be given as the
	 *   SQL query string if no bindings are required.
	 * @param  string   $sql SQL query to execute.
	 * @return array         Result from the query (all rows)
	 */
	static function sql_exec ( $db, $bindings, $sql=null )
	{
		// Argument shifting
		if ( $sql === null ) {
			$sql = $bindings;
		}
		$stmt = $db->prepare( $sql );
		//echo $sql;
		// Bind parameters
		if ( is_array( $bindings ) ) {
			for ( $i=0, $ien=count($bindings) ; $i<$ien ; $i++ ) {
				$binding = $bindings[$i];
				$stmt->bindValue( $binding['key'], $binding['val'], $binding['type'] );
			}
		}
		// Execute
		try {
			$stmt->execute();
		}
		catch (PDOException $e) {
			self::fatal( "An SQL error occurred: ".$e->getMessage() );
		}
		// Return all
		return $stmt->fetchAll( PDO::FETCH_BOTH );
	}
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Internal methods
	 */
	/**
	 * Throw a fatal error.
	 *
	 * This writes out an error message in a JSON string which DataTables will
	 * see and show to the user in the browser.
	 *
	 * @param  string $msg Message to send to the client
	 */
	static function fatal ( $msg )
	{
		echo json_encode( array( 
			"error" => $msg
		) );
		exit(0);
	}
	/**
	 * Create a PDO binding key which can be used for escaping variables safely
	 * when executing a query with sql_exec()
	 *
	 * @param  array &$a    Array of bindings
	 * @param  *      $val  Value to bind
	 * @param  int    $type PDO field type
	 * @return string       Bound key to be used in the SQL where this parameter
	 *   would be used.
	 */
	static function bind ( &$a, $val, $type )
	{
		$key = ':binding_'.count( $a );
		$a[] = array(
			'key' => $key,
			'val' => $val,
			'type' => $type
		);               
		return $key;
	}
	/**
	 * Pull a particular property from each assoc. array in a numeric array, 
	 * returning and array of the property values from each item.
	 *
	 *  @param  array  $a    Array to get data from
	 *  @param  string $prop Property to read
	 *  @return array        Array of property values
	 */
	static function pluck ( $a, $prop )
	{
		$out = array();
		for ( $i=0, $len=count($a) ; $i<$len ; $i++ ) {
			$out[] = $a[$i][$prop];
		}
		return $out;
	}
	/**
	 * Return a string from an array or a string
	 *
	 * @param  array|string $a Array to join
	 * @param  string $join Glue for the concatenation
	 * @return string Joined string
	 */
	static function _flatten ( $a, $join = ' AND ' )
	{
		if ( ! $a ) {
			return '';
		}
		else if ( $a && is_array($a) ) {
			return implode( $join, $a );
		}
		return $a;
	}
}