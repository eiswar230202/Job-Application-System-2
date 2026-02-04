<?php
session_start();
include("db_connect.php");

if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

// Fetch stats
$users_query = mysqli_query($conn, "SELECT COUNT(*) as count FROM users");
$users_count = mysqli_fetch_assoc($users_query)['count'];

$jobs_query = mysqli_query($conn, "SELECT COUNT(*) as count FROM jobs");
$jobs_count = mysqli_fetch_assoc($jobs_query)['count'];

$apps_query = mysqli_query($conn, "SELECT COUNT(*) as count FROM applications");
$apps_count = mysqli_fetch_assoc($apps_query)['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f3f4f6;
            display: flex; /* Sidebar layout */
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background: #1e3a8a;
            color: white;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }

        .sidebar-header {
            padding: 20px;
            font-size: 20px;
            font-weight: bold;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        .sidebar-menu {
            flex: 1;
            padding: 20px 0;
            overflow-y: auto;
        }

        .sidebar-menu a {
            display: block;
            padding: 15px 25px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-size: 15px;
            transition: background 0.3s;
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left: 4px solid #3b82f6;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            overflow-y: auto;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #111827;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }

        .stat-card h3 {
            margin: 0 0 10px 0;
            font-size: 14px;
            color: #6b7280;
            text-transform: uppercase;
            font-weight: 600;
        }

        .stat-card .value {
            font-size: 30px;
            font-weight: bold;
            color: #111827;
        }

        .recent-section {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .recent-section h2 {
            margin-top: 0;
            font-size: 18px;
            color: #374151;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
        }

        .placeholder-text {
            color: #9ca3af;
            text-align: center;
            padding: 20px;
            background: #f9fafb;
            border-radius: 6px;
            border: 1px dashed #d1d5db;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">Admin Panel</div>
        <div class="sidebar-menu">
            <a href="admin_dashboard.php" class="active">Dashboard</a>
            <a href="#">Post a Job</a> <!-- Placeholder link -->
            <a href="#">Manage Jobs</a> <!-- Placeholder link -->
            <a href="#">Applications</a> <!-- Placeholder link -->
            <a href="#">Users</a> <!-- Placeholder link -->
            <a href="admin_logout.php" style="margin-top: 20px; border-top: 1px solid rgba(255,255,255,0.1);">Logout</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Dashboard Overview</h1>
            <span style="color: #6b7280;">Welcome, <b><?php echo htmlspecialchars($_SESSION['admin_name']); ?></b></span>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Users</h3>
                <div class="value"><?php echo $users_count; ?></div>
            </div>
            <div class="stat-card">
                <h3>Active Jobs</h3>
                <div class="value"><?php echo $jobs_count; ?></div>
            </div>
            <div class="stat-card">
                <h3>Total Applications</h3>
                <div class="value"><?php echo $apps_count; ?></div>
            </div>
        </div>

        <div class="recent-section">
            <h2>Recent Activity</h2>
            <div class="placeholder-text">
                Recent activity log will appear here. <br>
                (Functionality to be implemented)
            </div>
        </div>
    </div>

</body>
</html>
