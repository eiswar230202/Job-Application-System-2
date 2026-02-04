<?php
session_start();
include 'db_connect.php';

// Fetch all jobs from the jobs table
$jobs = [];
$tableCheck = mysqli_query($conn, "SHOW TABLES LIKE 'jobs'");
if(mysqli_num_rows($tableCheck) == 0){
    die("<p style='text-align:center; margin-top:50px;'>Jobs table does not exist. Please create it first.</p>");
}

$sql = "SELECT id, job_title, company_name, location, description FROM jobs ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

if($result){
    while($row = mysqli_fetch_assoc($result)){
        $jobs[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Jobs | CareerGate</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', Arial, sans-serif;
}

body{
    background: linear-gradient(135deg, #f97316, #38bdf8);
    min-height:100vh;
}

/* NAVBAR */
header{
    background:#1f2933;
    padding:15px 0;
}

nav ul{
    display:flex;
    justify-content:center;
    list-style:none;
}

nav ul li{
    margin:0 15px;
}

nav ul li a{
    color:#fff;
    text-decoration:none;
    font-weight:600;
}

nav ul li a:hover{
    color:#fb923c;
}

/* MAIN SECTION */
section{
    padding:80px 10%;
    display:flex;
    justify-content:center;
    align-items:center;
    flex-direction:column;
}

/* JOB BOX */
.job-box{
    background:#ffffff;
    max-width:900px;
    width:100%;
    padding:30px;
    border-radius:15px;
    box-shadow:0 15px 40px rgba(0,0,0,0.15);
    position:relative;
    margin-bottom:30px;
}

/* ORANGE ACCENT BAR */
.job-box::before{
    content:"";
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:6px;
    background: linear-gradient(to right, #f97316, #fb923c);
    border-radius:15px 15px 0 0;
}

/* HEADING */
.job-box h3{
    color:#1f2933;
    font-size:1.8rem;
    margin-bottom:10px;
}

.job-box p{
    font-size:1rem;
    margin-bottom:8px;
    color:#374151;
}

.apply-btn{
    display:inline-block;
    background:#f97316;
    color:#fff;
    padding:8px 15px;
    border-radius:8px;
    text-decoration:none;
    font-weight:600;
    transition:0.3s;
}

.apply-btn:hover{
    background:#fb923c;
}

.no-jobs{
    text-align:center;
    font-size:1.2rem;
    margin-top:20px;
    color:#374151;

/* APPLY BUTTON */
.apply-btn{
    display:inline-block;
    background:#f97316;
    color:#fff;
    padding:8px 15px;
    border-radius:8px;
    text-decoration:none;
    font-weight:600;
    transition:0.3s;
    margin-top:10px;
}

.apply-btn:hover{
    background:#fb923c;
}

}
</style>
</head>
<body>

<header>
<nav>
<ul>
    <li><a href="homepage.php">Home</a></li>
    <li><a href="dashboard.php">Dashboard</a></li>
    <li><a href="about.php">About</a></li>
    <li><a href="jobs.php">Jobs</a></li>
    <li><a href="status.php">Status</a></li>
    <?php if(isset($_SESSION['user_id'])): ?>
        <li><a href="logout.php">Logout</a></li>
    <?php endif; ?>
</ul>
</nav>
</header>

<section>
<h2 style="color:#fff; margin-bottom:30px;">Available Jobs</h2>

<?php if(count($jobs) > 0): ?>
   <?php foreach($jobs as $job): ?>
    <div class="job-box">
        <h3><?= htmlspecialchars($job['job_title']); ?></h3>
        <p><strong>Company:</strong> <?= htmlspecialchars($job['company_name']); ?></p>
        <p><strong>Location:</strong> <?= htmlspecialchars($job['location']); ?></p>
        <p><?= nl2br(htmlspecialchars($job['description'])); ?></p>

        <?php if(isset($_SESSION['user_id'])): ?>
            <!-- Apply Now button -->
            <a class="apply-btn" href="apply.php?job_id=<?= $job['id']; ?>">Apply Now!</a>
        <?php else: ?>
            <p style="margin-top:10px; color:#374151; font-weight:600;">Login required to apply.</p>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
<?php else: ?>
    <p class="no-jobs">No jobs are currently available. Please check back later.</p>
<?php endif; ?>
</section>

</body>
</html>
