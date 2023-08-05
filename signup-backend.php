<?php
// Page Dependecy
require("verify.php");
session_start();




createAccountsTable();


$con = mysqli_connect(DatabaseAddress, DatabaseUsername, DatabasePassword, DatabaseName);

if (mysqli_connect_errno()) {
  die("Failed to connect to MySQL: " . mysqli_connect_error());
}

$username = $_POST['username'];
$password = $_POST['password'];

if (empty($username)) {
  header("Location: register.php?error=Username is required");
  exit();
} else if (empty($password)) {
  header("Location: register.php?error=Password is required");
  exit();
} else {
  $credit_score = 0;

  // Check if account already exists
  $account = getAccount($username);
  if ($account) {
    header("Location: register.php?error=Username already exists");
    exit();
  }

  // Generate new unique ID
  $id = generateUniqueID();

  // Create new account
  $success = saveAccount($id, $username, $password, $credit_score);

  if ($success) {
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['credit_score'] = $credit_score;
    $_SESSION['id'] = $id;
    echo ("success");
    // header("Location: "); Change Later
    exit();
  } else {
    header("Location: index.php?error=Unknown error occurred");
    exit();
  }
}

function generateUniqueID() {
  global $con;

  $id = generateID();
  $query = "SELECT * FROM bankaccounts WHERE id='$id'";
  $result = mysqli_query($con, $query);

  while (mysqli_num_rows($result) != 0) {
    $id = generateID();
    $query = "SELECT * FROM bankaccounts WHERE id='$id'";
    $result = mysqli_query($con, $query);
  }

  return $id;
}

function generateID() {
  $chars = "0123456789";
  $id = "";

  for ($i = 0; $i < 10; $i++) {
    $id .= $chars[rand(0, strlen($chars) - 1)];
  }

  return $id;
}

function getAccount($username) {
  global $con;

  $query = "SELECT * FROM bankaccounts WHERE username='$username'";
  $result = mysqli_query($con, $query);

  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  } else {
    return null;
  }
}

function saveAccount($id, $username, $password, $credit_score) {
  global $con;

  
  // Insert new account
  $query = "INSERT INTO bankaccounts (id, username, password, credit_score) VALUES ('$id', '$username', '$password', '$credit_score')";
  $result = mysqli_query($con, $query);

  return $result;
}

?>