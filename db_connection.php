<?php

// Include the db_connection.php script to establish a database connection
include("db_connection.php");

// Set the user's information
$id = "34734324771390391432875";
$name = "John";
$balance = 1000;

// Insert the user into the database
$sql = "INSERT INTO accounts (id, name, balance) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssd", $id, $name, $balance);
if ($stmt->execute()) {
    echo "Test user created successfully!";
} else {
    echo "Error creating test user: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>
