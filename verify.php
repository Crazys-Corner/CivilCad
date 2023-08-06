<?php 
// On Page load code.

// Check if Setup.php was ran. 
if (!file_exists("Config.php")) {
    header("Location: setup.php");
    exit();
}
// Require Config for dependencies, and other things. 
Require("config.php");

// Check if valid license key.
 Require("verification.php");

?>