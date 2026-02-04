<?php
$servername = "localhost";
$username = "root";       // change if needed
$password = "";           // your MySQL password
$dbname = "job_application";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
