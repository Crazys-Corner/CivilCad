<!DOCTYPE html>
<html>
<head>
    <title>Setup Failed</title>
</head>
<body>
    <h1>Setup Failed</h1>
    <?php
    if (isset($_GET['error'])) {
        $errorMessage = $_GET['error'];
        // If you want to display the raw error message without any HTML formatting
        echo "<p>Error Message: " . htmlspecialchars($errorMessage) . "</p>";
        
        // If you want to display the error message in a styled box
        echo '<div style="background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb;">';
        echo "Error Message: " . htmlspecialchars($errorMessage);
        echo '</div>';
    } else {
        echo "<p>No error message provided.</p>";
    }
    ?>
</body>
</html>
