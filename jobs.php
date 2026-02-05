<?php
include("db_connect.php");

$jobs = mysqli_query($conn,
    "SELECT jobs.*, categories.category_name
     FROM jobs
     LEFT JOIN categories
     ON jobs.category_id = categories.category_id
     WHERE status='Open'");
?>

<!DOCTYPE html>
<html>
<head>
<title>Job Listings</title>
</head>

<body>

<h2>Available Jobs</h2>
<hr>

<?php while($job = mysqli_fetch_assoc($jobs)) { ?>

<h3><?php echo $job['job_title']; ?></h3>

<p><b>Company:</b> <?php echo $job['company']; ?></p>

<p><b>Category:</b> <?php echo $job['category_name']; ?></p>

<p><b>Salary:</b> <?php echo $job['salary']; ?></p>

<a href="job_details.php?id=<?php echo $job['job_id']; ?>">
View Details
</a>

<hr>

<?php } ?>

</body>
</html>
