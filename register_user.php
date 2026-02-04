<?php
// Step 1: Database connection (replace with your own details)
$servername = "localhost";  // Change if you're using a different server
$username = "root";         // Default username for MySQL is root
$password = "";             // Default password for MySQL is empty
$dbname = "user_registration"; // Make sure the database is named correctly

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Get data from the form
$user_name = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Basic validation (you can extend this as needed)
if (empty($user_name) || empty($email) || empty($password)) {
    echo "All fields are required!";
    exit();
}

// Step 3: Hash the password (always hash passwords before storing them)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Step 4: Prepare the SQL query to insert data into the database
$sql = "INSERT INTO users (username, email, password) VALUES ('$user_name', '$email', '$hashed_password')";

// Step 5: Execute the query
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    // Redirect to a success page or show a message
    header("Location: success.php"); // Redirect to a success page
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
