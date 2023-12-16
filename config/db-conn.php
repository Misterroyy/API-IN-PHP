<?php
session_start();
ob_get_clean();
/*error_reporting(0); 
@ini_set('display_errors', 0);*/ 
date_default_timezone_set("Asia/Kolkata"); 

$hostname = 'localhost'; 
$username = 'root'; 
$password = ''; 
$database = 'crmadmin_panel'; 

$charset = 'utf8';

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
 
