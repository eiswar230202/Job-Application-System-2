<?php
include("db_connect.php");

if ($conn) {
    echo "Database connection successful.\n";
} else {
    die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT * FROM admins");

if ($result) {
    $count = mysqli_num_rows($result);
    echo "Number of admins found: " . $count . "\n";
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Admin Email: " . $row['email'] . "\n";
        // Do not print password hash for security, but we can verify it exists
        echo "Password Hash Length: " . strlen($row['password']) . "\n";
    }

    if ($count == 0) {
        echo "No admin accounts found. Attempting to create default admin...\n";
        $email = "admin@example.com";
        $password = "admin123";
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $name = "Admin User";
        
        $sql = "INSERT INTO admins (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
        if (mysqli_query($conn, $sql)) {
            echo "Default admin created.\nEmail: $email\nPassword: $password\n";
        } else {
            echo "Error creating admin: " . mysqli_error($conn) . "\n";
        }
    }
} else {
    echo "Error querying admins table: " . mysqli_error($conn) . "\n";
    echo "Attempting to create generic admins table structure...\n";
    $sql = "CREATE TABLE IF NOT EXISTS admins (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100),
        email VARCHAR(100) UNIQUE,
        password VARCHAR(255)
    )";
    if (mysqli_query($conn, $sql)) {
        echo "Admins table created successfully.\n";
    } else {
        echo "Error creating table: " . mysqli_error($conn) . "\n";
    }
}
?>
