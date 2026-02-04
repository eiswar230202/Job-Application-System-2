<?php
// Only show errors in development (remove in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "job_application_db"; // your DB name

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    // Stop only this script, don't break other pages
    die("Database connection failed: " . mysqli_connect_error());
}
?>
