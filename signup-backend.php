<php
function signupUser($username, $password, $email) {
    // Connect to the database
    $conn = new mysqli(DatabaseAddress, DatabaseUsername, DatabasePassword, DatabaseName);

    // Sanitize input to prevent SQL injection
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);
    $email = $conn->real_escape_string($email);

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database
    $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashed_password, $email);
    if ($stmt->execute()) {
        // User successfully signed up
        return true;
    } else {
        // Error occurred while signing up user
        return false;
    }
}
<?