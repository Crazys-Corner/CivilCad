<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="stylesheet" href="signup.css">
</head>
<body>
  <div class="container">
    <div id="signup-failed-div">Signup Failed</div>
    <form class="auth-form" action="signup-backend.php" method="POST">
      <h2>Sign Up</h2>
      <label for="username">Username:</label>
      <input class="form-input" type="text" id="username" name="username" required>
      <label for="password">Password:</label>
      <input class="form-input" type="password" id="password" name="password" required>
      <label for="username">Email:</label>
      <input class="form-input" type="text" id="email" name="email" required>
</a>
      <div class="remember-me">
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">Remember me</label>
      </div>
      <button type="submit">Sign Up</button>
    </form>
  </div>
    <script>function signupFailed() {
  var signupFailedDiv = document.getElementById("signup-failed-div");
  signupFailedDiv.style.visibility = "visible";
  signupFailedDiv.style.top = "5vh";
  setTimeout(function() {
    signupFailedDiv.style.top = "-30vh";
    setTimeout(function() {
      signupFailedDiv.style.visibility = "hidden"; 
    }, 5000);
  }, 5000);
  
  }
  </script>
</body>
</html>