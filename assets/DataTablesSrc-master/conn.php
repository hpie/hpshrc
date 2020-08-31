<?php
if($_SERVER['HTTP_HOST']=='localhost'){
    define('USERNAME','root');
    define('PASSWORD','hpie@edu');
    define('DATABASE','s7hpiein_hpshrc');
}
else{
     define('USERNAME','knebxnii_knebxnii');
    define('PASSWORD','v@siml00k!me');
    define('DATABASE','knebxnii_hpshrc');
}
// SQL server connection information
$sql_details = array(
    'user' => USERNAME,
    'pass' => PASSWORD,
    'db' => DATABASE,
    'host' => 'localhost'
);

