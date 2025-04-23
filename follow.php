<?php
session_start();
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "dboqamh7kg0gi1");
$follower_id = $_SESSION['user_id'];
$following_id = $_POST['follow_id'];
$check = $conn->query("SELECT * FROM followers WHERE follower_id=$follower_id AND following_id=$following_id");
if ($check->num_rows == 0 && $follower_id != $following_id) {
  $conn->query("INSERT INTO followers (follower_id, following_id) VALUES ($follower_id, $following_id)");
}
echo "<script>window.location.href='index.php';</script>";
?>
