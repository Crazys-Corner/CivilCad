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
    <div class="header">
      <a class="button-link" href="login.php">Login</a>
      <a class="button-link" href="signup.php">Signup</a>
    </div>
    <div class="dashboard">
      <h1>Welcome, Ziad Gold</h1>
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
          <div class="transaction">Sent $1000 to John</div>
          <div class="transaction">Received $500 from Jane</div>
          <div class="transaction">Sent $200 to Alex</div>
      
          <!-- Add more transaction items here -->
        </div>
      </div>
    </div>
  </div>
  <script src="script.js"></script>
</body>
</html>