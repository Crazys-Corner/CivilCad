<?php
// Page Dependency
require("verify.php");

// Ensure the script only processes POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("HTTP/1.1 405 Method Not Allowed");
    exit;
}

// Validate and sanitize user input
$username = trim($_POST['username']);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$password = $_POST['password'];

// Perform more validation on the input if needed
if (empty($username) || empty($email) || empty($password)) {
    header("Location: setupfail.php?error=" . urlencode("Please fill in all fields."));
    exit;
}

// Hash the password using bcrypt / default hash
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Create a new database connection
$conn = new mysqli(DatabaseAddress, DatabaseUsername, DatabasePassword, DatabaseName);

// Check for a successful connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$steamiddefault = "unlinked";

// Prepare and execute the SQL statement using prepared statements to prevent SQL injection
$sql = "INSERT INTO users (username, password, email, id64) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Use bind_param to bind variables and prevent SQL injection
$stmt->bind_param("ssss", $username, $hashed_password, $email, $steamiddefault);

if ($stmt->execute()) {
    // Close the statement
    $stmt->close();

    // Retrieve the newly created user
    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        session_start();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['cadusername'] = $row['username'];
        $_SESSION['cademail'] = $row['email'];

        // Close DB connection
        $stmt->close();
        $conn->close();
        header("Location: steam-link.php"); // Redirect to a success page
        exit;
    }
} else {
    $errorMessage = "Error creating user: " . $stmt->error;
}

// Close the statement and connection in case of failure
$stmt->close();
$conn->close();

// Redirect to the setupfail page with error message
header("Location: setupfail.php?error=" . urlencode($errorMessage));
exit;
?>
