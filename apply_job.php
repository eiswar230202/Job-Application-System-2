<?php
session_start();
include("db_connect.php");

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$job_id = $_GET['job_id'];

/* Check if already applied */
$check = mysqli_query($conn,
    "SELECT * FROM applications
     WHERE user_id='$user_id'
     AND job_id='$job_id'");

if(mysqli_num_rows($check) > 0) {
    echo "You already applied for this job.";
    echo "<br><a href='jobs.php'>Back to Jobs</a>";
    exit();
}

/* Insert application */
mysqli_query($conn,
    "INSERT INTO applications
     (user_id, job_id, status)
     VALUES ('$user_id','$job_id','Pending')");

echo "Application submitted successfully!";
echo "<br><a href='dashboard.php'>Go to Dashboard</a>";
?>
