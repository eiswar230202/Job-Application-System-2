<?php
include("db_connect.php");

if ($conn) {
    echo "Database connection successful.\n";
} else {
    die("Connection failed: " . mysqli_connect_error());
}

$email = "admin@gmail.com";
$password = "admin123";
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$name = "Administrator";

// Update or Insert the admin user
// We'll try to update first to preserve the ID if it exists, otherwise insert
$check = mysqli_query($conn, "SELECT * FROM admins WHERE email='$email'");

if (mysqli_num_rows($check) > 0) {
    // Update existing
    $sql = "UPDATE admins SET password='$hashed_password', name='$name' WHERE email='$email'";
    if (mysqli_query($conn, $sql)) {
        echo "Admin account '$email' updated successfully.\n";
    } else {
        echo "Error updating admin: " . mysqli_error($conn) . "\n";
    }
} else {
    // Insert new
    $sql = "INSERT INTO admins (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
    if (mysqli_query($conn, $sql)) {
        echo "Admin account '$email' created successfully.\n";
    } else {
        echo "Error creating admin: " . mysqli_error($conn) . "\n";
    }
}

echo "New Credentials:\nEmail: $email\nPassword: $password\n";
?>
