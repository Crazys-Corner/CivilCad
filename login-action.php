<?php
// Include the login script functions
require_once 'signin-backend.php';

// Initialize the error variable
$error = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted username and password from $_POST
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the login credentials
    if (loginUser($username, $password)) {
        // Redirect to the user's dashboard or any other authenticated area
        header('Location: bank.php');
        exit();
    } else {
        // Set the error message for login failure
        $error = 'Invalid credentials! Please try again.';
        header("Location: login.php?error=Wrong%20Password");
    }
}
?>