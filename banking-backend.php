<?php
// Page Dependency.
require("verify.php");
session_start();

// Function to get the total balance of a user account
function getUserTotalBalance($userId, $conn) {
    // Prepare the SQL query
    $sql = "SELECT SUM(balance) AS total_balance FROM CB WHERE owner = $userId";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result) {
        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Fetch the result as an associative array
            $row = $result->fetch_assoc();
            $total_balance = number_format($row["total_balance"]);
            return $total_balance;
        } else {
            return 0;
        }
    } else {
        echo "Error executing the query: " . $conn->error;
        return null;
    }
}

// Establish a database connection
$conn = new mysqli(DatabaseAddress, DatabaseUsername, DatabasePassword, DatabaseName);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Replace 'user_id' with the actual identifier of the user you want to get the balance for
// $user_id = $_SESSION['64id']; // Replace 123 with the user's ID

// Get the user's total balance
$total_balance = getUserTotalBalance($user_id, $conn);

// Close the database connection
$conn->close();



function transferMoney($fromUserId, $toUserId, $amount, $conn) { 
    // Check if the 'from user' has enough balance

    $from_balance = getUserTotalBalance($fromUserId, $conn);
    if ($from_balance >= $amount) {

        $sql = "UPDATE CB SET balance = balance - $amount WHERE owner = $fromUserId";
        $conn->query($sql);

        $sql = "UPDATE CB SET balance = balance + $amount WHERE owner = $toUserId";
        $conn->query($sql);
     
    return true; // Successful Tranfer
    } else {
        return false; // Not enough balance for transfer
    }

}
