<?php
// Page Dependency.
require("verify.php");
session_start();
if(isset($_SESSION['64id'])) {
// Misc Var Names set from Session Vars

$PlayerName = $_SESSION['cadusername'];
$PlayerEmail = $_SESSION['cademail'];
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


function transferMoney($fromUserId, $recipientId, $amount, $conn) { 
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
        $stmt->bind_param("di", $amount, $recipientId);
        $stmt->execute();
        $stmt->close();

        // Insert successful transfer transaction record
        $transactionDescription = "Sent $" . $amount . " to User " . $recipientId;
        insertTransaction($fromUserId, $transactionDescription, $conn);

        return true; // Successful Transfer
    
    } else {
       
        // Insert failed transfer transaction record
        $transactionDescription = "Failed transfer attempt - Insufficient balance";
        insertTransaction($fromUserId, $transactionDescription, $conn);

        return false;
    }
}

function insertTransaction($userId, $description, $conn) {
    $sql = "INSERT INTO transactions (user_id, description) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $userId, $description);
    $stmt->execute();
    $stmt->close();
}


function getRecipientName($recipientId, $conn) {
    $sql = "SELECT owner FROM CB WHERE owner = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $recipientId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        return $row['owner'];
    }

    return "Unknown Recipient"; // Default name if recipient not found
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