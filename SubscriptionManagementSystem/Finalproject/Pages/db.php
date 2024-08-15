<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

// Define database parameters
$hostname = "localhost";
$username = "root";
$password = "";
$database = "PHPConnect";
// Create a new mysqli object
$conn = new mysqli($hostname, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

?>