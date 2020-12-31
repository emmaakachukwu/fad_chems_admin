<?php

$is_local = getenv('HTTP_HOST') == '127.0.0.1' || getenv('HTTP_HOST') == 'localhost';

if ( $is_local ) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}

session_start();
date_default_timezone_set('Africa/Lagos');

define('DB_SERVER', '127.0.0.1');

if ( $is_local ) { 
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'fadchems');
} else {
    define('DB_USERNAME', 'cresjvym_crestminers');
    define('DB_PASSWORD', 'tydev2020');
    define('DB_NAME', 'cresjvym_crestminers');
}
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if (!$link) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if ( in_array('forms', explode('/', $_SERVER['REQUEST_URI'])) ) {
    require_once "./../lib/migration.php";
    require_once "./../lib/functions.php";
} else {
    require_once "./lib/migration.php";
    require_once "./lib/functions.php";
}
