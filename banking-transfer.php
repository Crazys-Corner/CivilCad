<?php
require("verify.php");
require_once("banking-backend.php");
$toUserId = $_POST['toUserId'];
$amount = $_POST['amount'];
$fromUserId = $_SESSION['64id'];

transferMoney($fromUserId, $toUserId, $amount, $conn); 
header("location: bank.php");
 ?>