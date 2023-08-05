<?php
// Include Config File for redundancy; we should be able 
// to fetch the ProductKey via the Constant ProductKey.
include("config.php");
// 
// Assign var key to Constant ProductKey
$key = constant('ProductKey');

// Make sure it isn't pirated 
// Connect to Licensing Database 
$mysqli = new mysqli("107.178.115.103:3306", "civilhos_whmc849", "Ge.[!17Sp3.gF27@!z0i4X@Ta", "civilhos_whmc849");

if ($mysqli->connect_errno) {
    $errorMessage = "Failed to connect to Key Server.";
    header("Location: setupfail.php?error=Licensing+Server+Down");
    exit;
}

$dbExists = $mysqli->select_db("s50_cd");

// Check if DB Exists.
if (!$dbExists) {
    $errorMessage = "Error: The specified database does not exist.";
    header("Location: setupfail.php?error=Licensing+Database+Does+Not+Exist");
    exit;
}

// Use prepared statement to avoid SQL injection.
$stmt = $mysqli->prepare("SELECT service_id, license_key, is_expired FROM licenses WHERE license_key = ?");
$stmt->bind_param("s", $key);
$stmt->execute();
$result = $stmt->get_result();

// Check if product key exists.
if ($result->num_rows > 0) {
    // Key Exists in DB. Print data related to user.

    while ($row = $result->fetch_assoc()) {
        $keyid = $row['license_key'];
        $user = $row['service_id'];
        $expires = $row['is_expired'];

        echo "License Key: $keyid<br>";
        echo "Service ID: $user<br>";
        echo "Is Expired: $expires<br>";
    }
} else {
    // Key does not exist in the database
    // Handle the case where the key is not found
    echo "<p>Key Not found.</p>";
    header("location: setupfail.php?error=Key+Not+Found");
    exit;
}

$stmt->close();
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Checking License Key...</p><br><br>
</body>
</html>