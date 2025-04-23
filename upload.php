<?php
session_start();
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "dboqamh7kg0gi1");
$user_id = $_SESSION['user_id'];
$title = $_POST['title'];
$tags = $_POST['tags'];
$board_id = $_POST['board_id'];

$img = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];
$path = "uploads/" . time() . "_" . basename($img);
move_uploaded_file($tmp, $path);

$conn->query("INSERT INTO images (user_id, board_id, title, tags, image_path) VALUES ($user_id, $board_id, '$title', '$tags', '$path')");
echo "<script>window.location.href='dashboard.php';</script>";
?>
