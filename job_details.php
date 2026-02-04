<?php
session_start();
include("db_connect.php");

if(!isset($_GET['id'])) {
    echo "Job not found.";
    exit();
}

$job_id = $_GET['id'];

$result = mysqli_query($conn,
    "SELECT jobs.*, categories.category_name
     FROM jobs
     LEFT JOIN categories
     ON jobs.category_id = categories.category_id
     WHERE job_id='$job_id'");

$job = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<title>Job Details</title>
</head>

<body>

<h2><?php echo $job['job_title']; ?></h2>

<p><b>Company:</b> <?php echo $job['company']; ?></p>

<p><b>Category:</b> <?php echo $job['category_name']; ?></p>

<p><b>Salary:</b> <?php echo $job['salary']; ?></p>

<hr>

<h3>Job Description</h3>

<p><?php echo $job['description']; ?></p>

<hr>

<?php if(isset($_SESSION['user_id'])) { ?>
    <a href="apply_job.php?job_id=<?php echo $job_id; ?>">
        Apply for this Job
    </a>
    <br><br>
<?php } else { ?>
    <p>Please login to apply.</p>
<?php } ?>

<a href="jobs.php">Back to Job List</a>

</body>
</html>
