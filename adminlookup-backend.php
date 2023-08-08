<?php
// Include the db_connection.php script to establish a database connection
include("db_connection.php");
require ("verify.php");

// Check if the form was submitted
if (isset($_POST['username'])) {
    // Get the submitted username
    $username = $_POST['username'];

    // Query the database to get the user's information
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // User found, display their information
        $row = $result->fetch_assoc();
        echo "<h2>User Information</h2>";
        echo "<p>ID: " . htmlspecialchars($row['id']) . "</p>";
        echo "<p>Username: " . htmlspecialchars($row['username']) . "</p>";
        // Add additional user information here as needed

        // Display a form to allow the admin to update the user's information
        echo "<h2>Update User</h2>";
        echo "<form action='update_user.php' method='post'>";
        echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>";
        echo "<label for='username'>New Username:</label>";
        echo "<input type='text' id='username' name='username' value='" . htmlspecialchars($row['username']) . "'>";
        echo "<input type='submit' value='Update'>";
        echo "</form>";
    } else {
        // User not found, display an error message
        echo "<p>User not found.</p>";
    }
}
?>
