<?php
session_start();
include("db_connect.php");

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="navbar">
    <div class="nav-brand">JobPortal</div>
    <div class="nav-links">
        <a href="jobs.php">Browse Jobs</a>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
</div>

<div class="main-content">
    <div class="container">
        <div class="welcome-banner">
            <h2>Welcome back, <?php echo isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'User'; ?>!</h2>
            <p>Track your applications and find your dream job.</p>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Your Job Applications</h3>
            </div>
            <div class="card-body">
                <?php
                $applications = mysqli_query($conn,
                    "SELECT jobs.job_title, jobs.company,
                            applications.status,
                            applications.application_date
                     FROM applications
                     JOIN jobs
                     ON applications.job_id = jobs.job_id
                     WHERE applications.user_id='$user_id'
                     ORDER BY applications.application_date DESC");

                if(mysqli_num_rows($applications) > 0) {
                    echo '<table class="app-table">';
                    echo '<thead><tr><th>Job Title</th><th>Company</th><th>Applied Date</th><th>Status</th></tr></thead>';
                    echo '<tbody>';
                    while($app = mysqli_fetch_assoc($applications)) {
                        $statusClass = strtolower($app['status']);
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($app['job_title']) . "</td>";
                        echo "<td>" . htmlspecialchars($app['company']) . "</td>";
                        echo "<td>" . date('M d, Y', strtotime($app['application_date'])) . "</td>";
                        echo "<td><span class='status-badge $statusClass'>" . htmlspecialchars($app['status']) . "</span></td>";
                        echo "</tr>";
                    }
                    echo '</tbody></table>';
                } else {
                    echo "<div class='empty-state'>
                            <p>You haven't applied to any jobs yet.</p>
                            <a href='jobs.php' class='btn'>Browse Jobs</a>
                          </div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<style>
/* Dashboard specific overrides */
body {
    background-color: #f3f4f6;
    display: block !important; /* Override flex from style.css */
    height: auto !important;
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #1e40af; /* Darker blue */
    padding: 15px 30px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.nav-brand {
    font-size: 20px;
    font-weight: bold;
    color: white;
}

.nav-links a {
    color: rgba(255,255,255,0.9);
    margin-left: 20px;
    font-size: 15px;
}

.nav-links a:hover {
    color: white;
}

.btn-logout {
    border: 1px solid rgba(255,255,255,0.3);
    padding: 5px 15px;
    border-radius: 4px;
}

.main-content {
    padding: 40px 0;
}

.welcome-banner {
    background: white;
    padding: 30px;
    border-radius: 12px;
    margin-bottom: 30px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    border-left: 5px solid #2563eb;
}

.welcome-banner h2 {
    margin: 0 0 10px 0;
    color: #111827;
}

.welcome-banner p {
    margin: 0;
    color: #6b7280;
}

.card {
    border: none;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    overflow: hidden;
}

.card-header {
    background: #fff;
    padding: 20px 25px;
    border-bottom: 1px solid #e5e7eb;
}

.card-header h3 {
    margin: 0;
    color: #374151;
    font-size: 18px;
}

.card-body {
    padding: 0;
}

.app-table {
    width: 100%;
    border-collapse: collapse;
}

.app-table th {
    background: #f9fafb;
    text-align: left;
    padding: 15px 25px;
    color: #6b7280;
    font-size: 13px;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 0.05em;
    border-bottom: 1px solid #e5e7eb;
}

.app-table td {
    padding: 16px 25px;
    border-bottom: 1px solid #e5e7eb;
    color: #374151;
}

.app-table tr:last-child td {
    border-bottom: none;
}

.status-badge {
    padding: 4px 10px;
    border-radius: 9999px;
    font-size: 12px;
    font-weight: 500;
    display: inline-block;
}

.status-badge.pending {
    background-color: #fef3c7;
    color: #d97706;
}

.status-badge.accepted, .status-badge.approved {
    background-color: #d1fae5;
    color: #059669;
}

.status-badge.rejected {
    background-color: #fee2e2;
    color: #dc2626;
}

.empty-state {
    padding: 40px;
    text-align: center;
    color: #6b7280;
}
</style>

</body>
</html>
