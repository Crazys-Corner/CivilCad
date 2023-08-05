<?php
// Page Dependecy.
require("verify.php");
session_start();

// Start Banking. 


// Establish a database connection
$conn = new mysqli(DatabaseAddress, DatabaseUsername, DatabasePassword, DatabaseName);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Replace 'user_id' with the actual identifier of the user you want to get the balance for
$user_id = $_SESSION['64id']; // Replace 123 with the user's ID

// Prepare the SQL query
$sql = "SELECT SUM(balance) AS total_balance FROM CB WHERE owner = $user_id";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Fetch the result as an associative array
        $row = $result->fetch_assoc();
        $total_balance = number_format($row["total_balance"]);

        // Output the user's total balance
        
    } else {
       $total_balance = 0; 
    }
} else {
    echo "Error executing the query: " . $conn->error;
}

// Close the database connection
$conn->close();
// u here
// yes



?>