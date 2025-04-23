<?php
session_start();
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "dboqamh7kg0gi1");
if (!isset($_SESSION['user_id'])) echo "<script>window.location.href='login.php';</script>";
$user_id = $_SESSION['user_id'];
$boards = $conn->query("SELECT * FROM boards WHERE user_id=$user_id");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <style>
    body { font-family: Arial; margin: 0; background: #fafafa; }
    header { background: #E60023; color: white; padding: 15px; text-align: center; }
    .container { padding: 20px; }
    form, .grid { margin: 20px 0; }
    input, select, button { padding: 10px; margin: 5px 0; width: 100%; }
    .grid img { width: 200px; height: 200px; object-fit: cover; margin: 10px; border-radius: 10px; box-shadow: 0 0 5px #aaa; }
  </style>
</head>
<body>
<header>
  <h2>Welcome to Your Pinterest</h2>
  <button onclick="window.location.href='logout.php'">Logout</button>
</header>
<div class="container">
  <form method="POST" action="upload.php" enctype="multipart/form-data">
    <input name="title" placeholder="Image Title" required>
    <input name="tags" placeholder="Tags (comma separated)">
    <select name="board_id">
      <?php while($b = $boards->fetch_assoc()) echo "<option value='{$b['id']}'>{$b['name']}</option>"; ?>
    </select>
    <input type="file" name="image" required>
    <button>Upload</button>
  </form>

  <form method="POST" action="boards.php">
    <input name="name" placeholder="New Board Name" required>
    <button>Create Board</button>
  </form>
</div>
</body>
</html>
