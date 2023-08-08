<?php
session_start();

// Page Dependency
require("verify.php");

$conn = new mysqli(DatabaseAddress, DatabaseUsername, DatabasePassword, DatabaseName);

// Check for a successful connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username and password from user
$username = $_POST['username'];
$password = $_POST['password'];

// sanitize sql to prevent sql injections
$username = $conn->real_escape_string($username);
$password = $conn->real_escape_string($password);

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user into database
$sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
$result = $conn->query($sql);

$_SESSION['cadusername'] = $username;

if ($result) {
    // User successfully signed up
    return true;
} else {
    // Error occurred while signing up user
    return false;
}

// Function to handle user logout
function logoutUser() {
    // Destroy Session to log out.
    session_destroy();
}
?>
