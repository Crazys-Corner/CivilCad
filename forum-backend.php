<?php 

require("verify.php"); 

// this is a test commit
// Function to establish a database connection
function getDBConnection() {
    $conn = new mysqli(DatabaseAddress, DatabaseUsername, DatabasePassword, DatabaseName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// Function to create a new thread
function createThread($title, $content, $author) {
    $conn = getDBConnection();
    $sql = "INSERT INTO threads (title, content, author) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $title, $content, $author);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

// Function to get all threads from the database
function getAllThreads() {
    $conn = getDBConnection();
    $sql = "SELECT * FROM threads ORDER BY created_at DESC";
    $result = $conn->query($sql);
    $threads = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $threads[] = $row;
        }
    }
    $conn->close();
    return $threads;
}

// Function to create a new comment for a thread
function createComment($thread_id, $content, $author) {
    $conn = getDBConnection();
    $sql = "INSERT INTO comments (thread_id, content, author) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $thread_id, $content, $author);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>