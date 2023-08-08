<?php
// signup shit
require ("verify.php");


// check if user is logged in
// Function to check if the user is already logged in
function isUserLoggedIn() {
  return isset($_SESSION['user_id']);
}
function signupUser($username, $password, $email) {
  $conn = new mysqli(DatabaseAddress, DatabaseUsername, DatabasePassword, DatabaseName);
}
// Sanitize input to prevent SQL injection

$username = $conn->real_escape_string($username);
$password = $conn->real_escape_string($password);
$email = $conn->real_escape_string($password);