<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login Choice - Job Application System</title>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    
    /* Background image */
    background: url('bg.jpg') no-repeat center center fixed;
    background-size: cover;
}

.choice-box {
    background: rgba(255, 255, 255, 0.95); /* slightly transparent */
    padding: 50px 40px;
    border-radius: 12px;
    text-align: center;
    width: 350px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
}

.choice-box img {
    width: 80px;
    margin-bottom: 20px;
}

.choice-box h2 {
    color: #1e3a8a;
    margin-bottom: 25px;
}

.choice-box .btn {
    display: block;
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    color: white;
    cursor: pointer;
    text-decoration: none;
    text-align: center;
    transition: 0.3s;
}

.choice-box .user-btn {
    background: #2563eb;
}

.choice-box .user-btn:hover {
    background: #1d4ed8;
}

.choice-box .admin-btn {
    background: #f59e0b;
}

.choice-box .admin-btn:hover {
    background: #d97706;
}
</style>
</head>
<body>

<div class="choice-box">
    <!-- Logo -->
    <img src="logo.jpg" alt="Job Application Logo">

    <h2>Choose Login Type</h2>

    <a href="login.php" class="btn user-btn">User Login</a>
    <a href="admin_login.php" class="btn admin-btn">Admin Login</a>
</div>

</body>
</html>
