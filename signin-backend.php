<?php

// Page Dependency
require("verify.php");
session_start();

// Function to check if the user is already logged in
function isUserLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Function to handle user login
function loginUser($username, $password) {
    $conn = new mysqli(DatabaseAddress, DatabaseUsername, DatabasePassword, DatabaseName);

    // Check for a successful connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize input to prevent SQL injection
    $username = $conn->real_escape_string($username);

    // Perform Query to check if the user exists
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['cadusername'] = $row['username'];
            $_SESSION['cademail'] = $row['email'];
            $_SESSION['64id'] = $row['id64'];

            // Close DB connection
            $conn->close();
            return true;
        } else {

            header("Location: login.php?error=Wrong%20Password");



        }
    }

    // Close DB connection
    $conn->close();
    return false;
}

// Function to handle user logout
function logoutUser() {
    // Destroy session to log out
    session_destroy();
}

?>
