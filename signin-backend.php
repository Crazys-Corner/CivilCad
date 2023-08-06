<?php 

// Page Dependency 
include("verify.php");

session_start();

// Function to check if the user is already logged in
function isUserLoggedIn() {
    return isset($_SESSION['user_id']);
}

function loginUser($username, $password) {

    $conn = new mysqli(DatabaseAddress, DatabaseUsername, DatabasePassword, DatabaseName);

    // Check for a successful connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

// Sanitize input to prevent SQL injection

    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Perform Query to check if the user exists and the password is correct

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    // Check if matching row / success

        if ($result->num_rows === 1){
            // fetch the user id and store it in session to indicate success
        $row = $result->fetch_assoc();
       
        // Set Session variables here VV Only works from users table

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['cadusername'] = $row['username'];
        $_SESSION['cademail'] = $row['email'];
        $_SESSION['64id'] = $row['id64'];
        $steamid = $_SESSION['64id'];
        // Set Session Variables here ^^
       
        return true;
        } else {
            // Login Failed
            return false;
        }

    
    // Close DB Conn

    $conn->close(); 
// Function to handle user logout
function logoutUser() {
// Destroy Session to log out.
session_destroy();

}

}

 
?>