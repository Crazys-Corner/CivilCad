<?php
require ("verify.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $DatabaseName = $_POST['database-name'];
    $DatabaseUsername = $_POST['database-username'];
    $DatabasePassword = $_POST['database-password'];
    $DatabaseAddress = $_POST['database-address'];
    $ServerName = $_POST['server-name'];
    $DefaultUsername = $_POST['user-username'];
    $DefaultPassword = $_POST['user-password'];
    $ProductKey = $_POST['product-key'];
    $ServerIpAddress = $_POST['server-ip-address'];
    $ServerGame = $_POST['server-game'];
    $DiscordLink = $_POST['discord-link']; 
    $easySend = $_POST['easySend'];
    // Generate the PHP code
    $phpCode = <<<EOT
<?php
const DatabaseName = '$DatabaseName';
const DatabaseUsername = '$DatabaseUsername';
const DatabasePassword = '$DatabasePassword';
const DatabaseAddress = '$DatabaseAddress';
const ServerName = '$ServerName';
const DefaultUsername = '$DefaultUsername';
const DefaultPassword = '$DefaultPassword';
const ProductKey = '$ProductKey';
const ServerIpAddress = '$ServerIpAddress';
const ServerGame = '$ServerGame';
const DiscordLink = '$DiscordLink';
const easySendLength = '$easySend';
EOT;

    // Save the generated code to a file
    $filename = 'config.php'; // Adjust the filename as needed
    file_put_contents($filename, $phpCode);

    echo "Setup script completed. File created: $filename";
}
// Setup Databases if they don't already exist
include("config.php");
$mysqli = new mysqli(DatabaseAddress, DatabaseUsername, DatabasePassword);

// Check if the connection was successful
if ($mysqli->connect_errno) {
    $errorMessage = "Failed to connect to MySQL: " . $mysqli->connect_error;
    header("Location: setupfail.php?error=" . urlencode($errorMessage));
    exit;
}

// Check if the specified database exists
$dbExists = $mysqli->select_db(DatabaseName);

if (!$dbExists) {
    $errorMessage = "Error: The specified database does not exist.";
    header("Location: setupfail.php?error=" . urlencode($errorMessage));
    exit;
}

// If the database exists, continue with table creation
// Create your tables here using SQL queries
// For example, create a users table
$createTableSQL = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    id64 VARCHAR(255)
);";
// Execute the table creation query
if ($mysqli->query($createTableSQL) === TRUE) {
    echo "Table 'users' created successfully.";
} else {
    $errorMessage = "Error creating table: " . $mysqli->error;
    header("Location: setupfail.php?error=" . urlencode($errorMessage));
    exit;
}

$createTableSQL = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    64id VARCHAR(255)
);";
// Execute the table creation query
if ($mysqli->query($createTableSQL) === TRUE) {
    echo "Table 'users' created successfully.";
} else {
    $errorMessage = "Error creating table: " . $mysqli->error;
    header("Location: setupfail.php?error=" . urlencode($errorMessage));
    exit;
}
$createTableSQL = "
CREATE TABLE IF NOT EXISTS CB (
    id INT AUTO_INCREMENT PRIMARY KEY,
    owner VARCHAR(255) UNIQUE NOT NULL,
    personalAccountNumber VARCHAR(255) NOT NULL,
    balance VARCHAR(255) NOT NULL,
    easySend VARCHAR($easySend) NOT NULL,
    lastLogin DATETIME DEFAULT CURRENT_TIMESTAMP
);";
// Execute the table creation query
if ($mysqli->query($createTableSQL) === TRUE) {
    echo "Table 'users' created successfully.";
} else {
    $errorMessage = "Error creating table: " . $mysqli->error;
    header("Location: setupfail.php?error=" . urlencode($errorMessage));
    exit;
}
$createTableSQL = "
CREATE TABLE IF NOT EXISTS threads (
    thread_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author VARCHAR(50) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);";
// Execute the table creation query
if ($mysqli->query($createTableSQL) === TRUE) {
    echo "Table 'users' created successfully.";
} else {
    $errorMessage = "Error creating table: " . $mysqli->error;
    header("Location: setupfail.php?error=" . urlencode($errorMessage));
    exit;
}

$createTableSQL = "
CREATE TABLE IF NOT EXISTS transactions (
    user_id VARCHAR(255),
    description VARCHAR(255)
);";
// Execute the table creation query
if ($mysqli->query($createTableSQL) === TRUE) {
    echo "Table 'users' created successfully.";
} else {
    $errorMessage = "Error creating table: " . $mysqli->error;
    header("Location: setupfail.php?error=" . urlencode($errorMessage));
    exit;
}
$createTableSQL = "
CREATE TABLE IF NOT EXISTS comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    thread_id INT NOT NULL,
    content TEXT NOT NULL,
    author VARCHAR(50) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (thread_id) REFERENCES threads (thread_id) ON DELETE CASCADE
);" ;

// Execute the table creation query
if ($mysqli->query($createTableSQL) === TRUE) {
    echo "Table 'users' created successfully.";
} else {
    $errorMessage = "Error creating table: " . $mysqli->error;
    header("Location: setupfail.php?error=" . urlencode($errorMessage));
    exit;
}


// Close the MySQL connection
$mysqli->close();

header("Location: setupsuccess.php");
exit;


    // Delete the setup.php file 
   // unlink('setup.php'); (commented out due to testing)
    
?>