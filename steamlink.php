<?php
session_start();
require("verify.php");

// Assuming the callback URL is something like: https://yourwebsite.com/auth/steam/callback
$steamResponse = $_GET;

// Extract the Steam 64ID
$steam64ID = str_replace("https://steamcommunity.com/openid/id/", "", $steamResponse['openid_claimed_id']);
$steam64ID = trim($steam64ID);

// Check if the Steam 64ID is set
if (isset($steam64ID)) {
    // Check if the Steam 64ID already exists in the database
    $conn = mysqli_connect(DatabaseAddress, DatabaseUsername, DatabasePassword, DatabaseName);
    if (!$conn) {
        die("Connect failed: " . mysqli_connect_error());
    }

    $userid = $_SESSION['user_id'];
    $defaultBank = 500;
    $PAN = 1;
    $easySend = 1;

    // Check if the Steam 64ID already exists in the database
    $checkQuery = "SELECT * FROM users WHERE id64 = '$steam64ID'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (!$checkResult) {
        echo "Failed Signing In, please retry. Var dump:<br><br>";
        var_dump($_GET);
        echo "<br> MySQLI <br><br>";
        echo mysqli_error($conn);
        $conn->close();
    } elseif (mysqli_num_rows($checkResult) > 0) {
        // Steam 64ID already registered
        echo "Account already exists";
        $conn->close();
        header("Location: login.php");
        exit;
    } else {
        // Insert the Steam 64ID into the 'users' table
        $updateQuery = "UPDATE users SET id64 = '$steam64ID' WHERE id = '$userid'";
        $updateResult = mysqli_query($conn, $updateQuery);

        if (!$updateResult) {
            echo "Failed Signing In, please retry. Var dump:<br><br>";
            var_dump($_GET);
            echo "<br> MySQLI <br><br>";
            echo mysqli_error($conn);
            $conn->close();
        } else {
            // Insert the Steam 64ID into the 'CB' table
            $insertQuery = "INSERT INTO CB (owner, personalAccountNumber, balance, easySend) VALUES ('$steam64ID', '$PAN', $defaultBank, $easySend)";
            $insertResult = mysqli_query($conn, $insertQuery);

            if (!$insertResult) {
                echo "Failed inserting bank data. Error: " . mysqli_error($conn);
            } else {
                header("Location: login.php?message=%20Success%21%20Steam%20is%20successfully%20linked%2E%20Your%20Steam64ID%20is%3A%20$steam64ID");
            }

            $conn->close();
            echo "<br>";
            echo "$userid";
            echo "<br>";
            echo "$steam64ID";
            echo "<br>";
            var_dump($_GET);
            exit;
        }
    }
} else {
    echo "Steam 64ID not present...";
}
?>
