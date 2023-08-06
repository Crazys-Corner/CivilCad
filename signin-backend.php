<?php 
ob_start();
session_start(); 


include("verify.php");

if (isset($_POST['username']) && isset($_POST['password'])) {

    // validate and sanitize input data
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = strtolower(validate($_POST['username']));
    $pass = validate($_POST['password']);

    if (empty($username)) {
        header("Location: loginpage.php?error=User Name is required");
        exit();
    } else if (empty($pass)){
        header("Location: loginpage.php?error=Password is required");
        exit();
    } else {
        // fetch user data from the database
        $sql = "SELECT * FROM accounts WHERE username='$username' AND password='$pass'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            // check if user has admin and developer permissions
            if ($row['is_admin'] == 1 && $row['is_developer'] == 1) {
                header("Location: adminhome.php");
                exit();
            }

            // set session variables
}           $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];

            if ($remember) {
                setcookie('username', $username, time() + (86400 * 30)); // 30 days
                setcookie('password', $pass, time() + (86400 * 30));
            }

            header("Location: ../customer/home.php");
            exit();
        } else {
            header("Location: login.php?error=Incorrect User name or password");
            exit();
        }
    }
} elseif (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    $username = $_COOKIE['username'];
    $pass = $_COOKIE['password'];

    $sql = "SELECT * FROM accounts WHERE username='$username' AND password='$pass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // check if user has admin and developer permissions
        

        // set session variables
        $_SESSION['username'] = $row['username'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['id'];

        header("Location: ../customer/home.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}

ob_end();
