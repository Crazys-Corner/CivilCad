<?php
require("verify.php");
require("banking-backend.php");

// Assuming you have a function to perform the transfer and get recipient's name, like getRecipientName($recipientId, $conn)
$recipientName = getRecipientName($_POST['toUserId'], $conn);
$transactionDescription = "Sent $" . $_POST['amount'] . " to " . $recipientName;

// Perform the transfer and update the transaction history in the database
if (transferMoney($user_id, $_POST['toUserId'], $_POST['amount'], $conn)) {
    // Insert the transaction into the database
    $sql = "INSERT INTO transactions (user_id, description) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $user_id, $transactionDescription);
    $stmt->execute();
    $stmt->close();
    
    header("Location: bank.php");
} else {
    echo "Transfer failed.";
}
 ?>