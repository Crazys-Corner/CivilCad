<?php
require("verify.php");
require("banking-backend.php");
transferMoney($user_id, $_POST['toUserId'], $_POST['amount'], $conn);
header("location: bank.php");
?>