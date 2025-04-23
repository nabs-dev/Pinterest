<?php
session_start();
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "dboqamh7kg0gi1");
$user_id = $_SESSION['user_id'];
$name = $_POST['name'];
$conn->query("INSERT INTO boards (user_id, name) VALUES ($user_id, '$name')");
echo "<script>window.location.href='dashboard.php';</script>";
?>
