<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', '/Applications/XAMPP/xamppfiles/logs/php_error_log');

$host = 'localhost';
$username = 'sunapp_scoredev';
$password = 'SunappDev';
$dbname = 'sunapp_basketball';

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully";
}

mysqli_close($conn);
?>
