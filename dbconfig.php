<?php
date_default_timezone_set('Asia/Calcutta');
error_reporting(0);
session_start();
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ceramica_db'); 

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($con === false){
    die("<h1 style='color:red;'>Error: Could not connect to the database.</h1>");
}
error_reporting(E_ALL);
?>