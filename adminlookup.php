<!DOCTYPE html>
<html>
    <head>
        <title>Admin Lookup</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h1>Admin Lookup</h1>
        <form action="adminlookup.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">
            <input type="submit" value="Search">
        </form>
        <?php
        // Check if the form was submitted
        if (isset($_POST['username'])) {
            // Get the submitted username
            $username = $_POST['username'];

            // Include the db_connection.php script to establish a database connection
            include("db_connection.php");

            // Query the database to get the user's information
            $sql = "SELECT * FROM accounts WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                // User found, display their information
                $row = $result->fetch_assoc();
                echo "<h2>User Information</h2>";
                echo "<p>ID: " . htmlspecialchars($row['id']) . "</p>";
                echo "<p>Name: " . htmlspecialchars($row['name']) . "</p>";
                echo "<p>Balance: $" . number_format($row['balance'], 2) . "</p>";
                // Add additional user information here as needed
            } else {
                // User not found, display an error message
                echo "<p>User not found.</p>";
            }
        }
        ?>
    </body>
</html>
