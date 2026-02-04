<?php
session_start();
include("db_connect.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "Invalid email or password!";
        }
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>
<style>
body {
    font-family: Arial, sans-serif;
    margin:0;
    background: linear-gradient(to right,#2563eb,#1e40af);
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.login-box {
    background:white;
    padding:40px;
    border-radius:12px;
    width:350px;
    text-align:center;
    box-shadow:0 4px 15px rgba(0,0,0,0.2);
    position: relative;
    z-index: 100;
}

.login-box img {
    width:80px;
    margin-bottom:20px;
}

.login-box h2 {
    color: #1e3a8a;
    margin-bottom:20px;
}

input[type="email"], input[type="password"] {
    width:100%;
    padding:10px;
    margin:10px 0;
    font-size:14px;
    border-radius:5px;
    border:1px solid #ccc;
}

button {
    width:100%;
    padding:12px;
    background:#2563eb;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
    margin-top:10px;
}

button:hover { background:#1d4ed8; }

.error { color:red; margin-bottom:15px; }

a {
    display: block;
    margin-top: 15px;
    color:#2563eb;
    text-decoration:none;
}
a:hover { text-decoration:underline; }
</style>
</head>
<body>

<div class="login-box">
    <img src="logo.jpg" alt="Logo">
    <h2>Admin Login</h2>

    <?php if($error != "") { echo "<div class='error'>$error</div>"; } ?>

    <form method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <a href="index.php">Back to Home</a>
</div>

</body>
</html>
