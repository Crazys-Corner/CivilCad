<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Comrade Banking</title>
    <link rel="stylesheet" href="../css/Style.css">
</head>
<body>

    <section>
    <div class="comradebanklogo">
        <img src="../img/logo1.png" alt="comrade bank logo" style="text-align: center; background-color: transparent;">
</div> 
<div class="form-box">
    <div class="form-value; ">
        <form action="registerscript.php" method="post">
            <script src="rememberme.js"></script>
            <h2>Register</h2>
          <div style="color: white; font-weight: bold; margin-top: 1rem">
            <?php if (isset($_GET['error'])) { ?>

            <p class="error"><?php echo $_GET['error']; ?></p>

                    <?php } ?>
            </div> 
            <div class="inputbox">
                <ion-icon name="mail-outline" ></ion-icon>
                <input type="text"  name="uname"  required >
                <label for="uname">Username</label>
            </div>
            <div class="inputbox">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="password" name="password" required>
                <label for="password">Password</label>
            </div>
            <div class="forget">
                <label for="remember"><input name="remember" type="checkbox">Remember Me </input> <span> | </span>
                <label for="forgot"><a href="forgotpassword.php">Forgot Password</a>
                
            </div>
            <button type="submit">Register</button>
            <div class="register"> 
                <p>Already have an account? <a href="loginpage.php">Login</a></p><br>
                <p>Looking for the banker login? <a href="../banker/adminindex.php">Bankers</a></p>
            </div>
        </form>


    </div>


</div>


    </section>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>