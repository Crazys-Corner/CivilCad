<!DOCTYPE html>
<html>
<head>
    <title>User Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        h2 {
            margin-bottom: 10px;
        }
        .user-info {
            margin-bottom: 20px;
        }
        .transaction {
            margin-bottom: 5px;
        }
        .no-data {
            font-style: italic;
            color: #999;
        }
        .container {
            margin-top: 10vh;
        }
    </style>
</head>
<body>

    <h1>User Information</h1>
    <div style="margin-top: 5vh;">
    <h3>Submitted Data: <?php     require("verify.php");
    $input = $_POST['id']; echo $input ?> </h3>
    </div>
 <div class="container">    
    <?php


    $connection = mysqli_connect(DatabaseAddress, DatabaseUsername, DatabasePassword, DatabaseName);

    if (!$connection) {
        die("Connection Failed: " . mysqli_connect_error());
    }

    // Perform the queries

    $query1 = "SELECT * FROM users WHERE id64 = '$input'";
    $query2 = "SELECT * FROM CB WHERE owner = '$input'";
    $query3 = "SELECT * FROM transactions WHERE user_id = '$input'";

    $result1 = mysqli_query($connection, $query1);
    $result2 = mysqli_query($connection, $query2);
    $result3 = mysqli_query($connection, $query3);

    if (!$result1 || !$result2 || !$result3) { // Fixed the condition here
        die("Query error: " . mysqli_error($connection));
    }
    ?>

    <div class="user-info">
        <h2>User Account:</h2>
        <?php
        if (mysqli_num_rows($result1) > 0) {
            while ($row = mysqli_fetch_assoc($result1)) {
                echo "ID: " . $row['id'] . "<br>";
                echo "Username: " . $row['username'] . "<br>";
                echo "Email: " . $row['email'] . "<br>";
            }
        } else {
            echo "<p class='no-data'>No User Account Found</p>";
        }
        ?>
    </div>
    
    <div class="user-info">
        <h2>Banking Details</h2>
        <?php
        if (mysqli_num_rows($result2) > 0) {
            while ($row = mysqli_fetch_assoc($result2)) {
                echo "Personal Account Number: " . $row['personalAccountNumber'] . " Balance: " . $row['balance'] . "<br>"; 
            }
        } else {
            echo "<p class='no-data'>No Banking Details Found</p>";
        }
        ?>
    </div>
    
    <div class="transactions">
        <h2>Banking Transactions</h2>
        <?php
        if (mysqli_num_rows($result3) > 0) {
            while ($row = mysqli_fetch_assoc($result3)) {
                echo "<p class='transaction'>Transaction: " . $row['description'] . "</p>";
            }
        } else {
            echo "<p class='no-data'>No Transactions Recorded</p>";
        }
        ?>
    </div>

    <?php
    mysqli_close($connection);
    ?>
    </div> 
</body>
</html>
