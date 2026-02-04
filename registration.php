<?php
session_start();
include("db_connect.php");

$message = "";

if(isset($_POST['register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if(mysqli_num_rows($check) > 0) {
        $message = "Email already registered!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert = mysqli_query($conn, "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')");

        if($insert) {
            $message = "Registration successful! You can now login.";
        } else {
            $message = "Error registering user: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
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
    <h2>User Registration</h2>

    <form method="post">
        <label>Name:</label>
        <input type="text" name="name" placeholder="Enter your name" required>

        <label>Email:</label>
        <input type="email" name="email" placeholder="Enter your email" required>

        <label>Password:</label>
        <input type="password" name="password" placeholder="Enter your password" required>

        <button type="submit" name="register">Register</button>
    </form>

    <p style="text-align:center; margin-top: 15px;">
        Already have an account? 
        <a href="login.php" class="btn">Login</a>
    </p>

    <p style="color:red; text-align:center;">
        <?php echo $message; ?>
    </p>

    <a href="index.php" class="back-link">Back to Home</a>
</div>

</body>
</html>
