<?php
if($_SERVER['HTTP_HOST']=='localhost'){
    define('USERNAME','root');
    define('PASSWORD','hpie@edu');
    define('DATABASE','s7hpiein_hpshrc');
}
else{
    define('USERNAME','s7hpiein_rmsauser');
    define('PASSWORD','Hp!#Rm%aD*');
    define('DATABASE','s7hpiein_rmsa');
}
// SQL server connection information
$sql_details = array(
    'user' => USERNAME,
    'pass' => PASSWORD,
    'db' => DATABASE,
    'host' => 'localhost'
);

