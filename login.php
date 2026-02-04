<?php
session_start();
include("db_connect.php");

$message = "";

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if(password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['name'];

            header("Location: dashboard.php");
            exit();
        } else {
            $message = "Wrong password!";
        }
    } else {
        $message = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: linear-gradient(to right, #2563eb, #1e40af);
        }
        .back-link {
            display: block;
            margin-top: 15px;
            color: #2563eb;
            text-decoration: none;
            text-align: center;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>User Login</h2>

    <form method="post">
        <label>Email:</label>
        <input type="email" name="email" placeholder="Enter your email" required>

        <label>Password:</label>
        <input type="password" name="password" placeholder="Enter your password" required>

        <button type="submit" name="login">Login</button>
    </form>

    <p style="text-align:center; margin-top: 15px;">
        Don't have an account? 
        <a href="registration.php" class="btn">Register</a>
    </p>

    <p style="color:red; text-align:center;">
        <?php echo $message; ?>
    </p>

    <a href="index.php" class="back-link">Back to Home</a>
</div>

</body>
</html>
