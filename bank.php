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
      <a class="button-link" href="login">Login</a>
      <a class="button-link" href="signup">Signup</a>
    </div>
    <div class="dashboard">
      <h1>Welcome, Ziad Gold</h1>
      <div class="account-details">
        <h2>Your ID: 434619849528967179</h2>
        <div class="balance">
          <h2>Your Balance: $<span id="balance">1000</span></h2>
        </div>
      </div>
      <div class="transfer-form">
        <h2>Transfer Money</h2>
        <form id="transferForm">
          <label for="recipient">Recipient:</label>
          <input type="text" id="recipient" name="recipient" required>
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