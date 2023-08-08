<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">

    <form class="auth-form" method="post" action="login-action.php">
      <h2>Login</h2>
      <div style="text-align: center" id="login-failed-div"></div>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      <div class="auth-options">
        <a href="signout.php">Forgot Password?</a>
        <button type="submit">Login</button>
      </div>
    </form>
  </div>
  <script>
document.addEventListener("DOMContentLoaded", function() {
    // Get the query parameter from the URL
    var urlParams = new URLSearchParams(window.location.search);
    
    // Check if the "success" parameter exists and has a value
    if (urlParams.has("success") && urlParams.get("success") === "1") {
        // Display a success message to the user
        var messageDiv = document.getElementById("login-failed-div");
        messageDiv.innerHTML = "Operation was successful!";
        messageDiv.style.color = "green";
    }
    // If you're using a "message" parameter instead, you can check and display accordingly
    else if (urlParams.has("message")) {
        var messageDiv = document.getElementById("login-failed-div");
        messageDiv.innerHTML = decodeURIComponent(urlParams.get("message"));
        messageDiv.style.color = "green";
    }
    // If you're using an "error" parameter instead
    else if (urlParams.has("error")) {
        var messageDiv = document.getElementById("login-failed-div");
        messageDiv.innerHTML = decodeURIComponent(urlParams.get("error"));
        messageDiv.style.color = "red";
    }
});
</script>
</body>
</html>
