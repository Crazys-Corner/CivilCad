<?php
// Page Dependency.
require("verify.php");
session_start();
if(isset($_SESSION['64id'])) {
// Establish a database connection
$conn = new mysqli(DatabaseAddress, DatabaseUsername, DatabasePassword, DatabaseName);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Function to get the total balance of a user account
function getUserTotalBalance($userId, $conn) {
    // Prepare the SQL query
    $sql = "SELECT balance FROM CB WHERE owner = '$userId'";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result) {
        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Fetch the result as an associative array
            $row = $result->fetch_assoc();
            $total_balance = number_format($row["balance"]);
            return $total_balance;
        } else {
            return 0;
        }

    } else {
        echo "Error executing the query: " . $conn->error;

        return null;
    }
}

// Replace 'user_id' with the actual identifier of the user you want to get the balance for
$user_id = $_SESSION['64id']; // Replace 123 with the user's ID

// Get the user's total balance
$balance = getUserTotalBalance($user_id, $conn);



function transferMoney($fromUserId, $toUserId, $amount, $conn) { 
    // Check if the 'from user' has enough balance
    $from_balance = getUserTotalBalance($fromUserId, $conn);
    if ($from_balance >= $amount) {

        // Use prepared statements to prevent SQL injection
        $sql = "UPDATE CB SET balance = balance - ? WHERE owner = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("di", $amount, $fromUserId);
        $stmt->execute();
        $stmt->close();

        $sql = "UPDATE CB SET balance = balance + ? WHERE owner = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("di", $amount, $toUserId);
        $stmt->execute();
        $stmt->close();

        return "Money sent to $toUserId"; // Successful Transfer
    
    } else {
       
        return "Not enough balance for transfer";
    }
}


/* function bankQuery(){
    $sql = "SELECT * FROM CB WHERE owner='$user_id'";
  $result = $conn->query($sql);
    if ($result->num_rows === 1){
            // Fetch CB Table data
        $row = $result->fetch_assoc();
            // Set CB Session Vars here, for banking module. 
  
    $_SESSION['personalAccountNumber'] = $row['personalAccountNumber'];
    $_SESSION['balance'] = $row['balance'];
    $_SESSION['cbEasySend'] = $row['easySend']; 
    $balance = $_SESSION['balance'];       
        
    } else {
        // CB Connection / Login Failed
            return false;
    }
  } 
*/ 

// Close the database connection



}
else {

    header("location: login.php");

}