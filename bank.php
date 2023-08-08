<?php 
require("verify.php");
require("banking-backend.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bank Account Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">

    <div class="dashboard">
      <h1>Welcome, <?php echo "$PlayerName"; ?></h1>
      <div class="account-details">
        <h2>Your ID: <?php echo "$user_id"; ?></h2>
        <div class="balance">
          <h2>Your Balance: $<span id="balance"><?php echo "$balance";?></span></h2>
        </div>
      </div>
      <div class="transfer-form">
        <h2>Transfer Money</h2>
        <form id="transferForm" method="post" action="banking-transfer.php">
          <label for="recipient">Recipient:</label>
          <input type="text" id="recipient" name="toUserId" required>
          <label for="amount">Amount:</label>
          <input type="number" id="amount" name="amount" min="1" required>
          <button type="submit">Transfer</button>
        </form>
      </div>
      <div class="transaction-history">
        <h2>Transaction History</h2>
        <div class="transactions">
        <?php
            $sql = "SELECT description FROM transactions WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            while ($row = $result->fetch_assoc()) {
                echo '<div class="transaction">' . $row['description'] . '</div>';
            }
            
            $stmt->close();
        ?>
          <!-- Add more transaction items here -->
        </div>
      </div>
    </div>
  </div>
  <script src="script.js"></script>
</body>
</html>