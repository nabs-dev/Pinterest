<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  echo "<script>window.location.href='login.php';</script>";
  exit();
}
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "dboqamh7kg0gi1");
$user_id = $_SESSION['user_id'];

// Get user info
$user = $conn->query("SELECT * FROM users WHERE id=$user_id")->fetch_assoc();

// Get uploaded images
$images = $conn->query("SELECT * FROM images WHERE user_id=$user_id ORDER BY id DESC");

// Get boards
$boards = $conn->query("SELECT * FROM boards WHERE user_id=$user_id ORDER BY id DESC");

// Get following list
$following = $conn->query("
  SELECT users.username FROM followers 
  JOIN users ON followers.following_id = users.id 
  WHERE followers.follower_id = $user_id
");
?>
<!DOCTYPE html>
<html>
<head>
  <title><?= htmlspecialchars($user['username']) ?>'s Profile</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
    h2 { color: #E60023; }
    .section { margin-bottom: 30px; }
    .grid { display: flex; flex-wrap: wrap; }
    .card {
      background: white;
      margin: 10px;
      padding: 10px;
      border-radius: 10px;
      box-shadow: 0 0 8px #ccc;
      width: 200px;
    }
    .card img { width: 100%; border-radius: 10px; }
    .board, .follower {
      background: #fff;
      margin: 5px 0;
      padding: 10px;
      border-radius: 6px;
      box-shadow: 0 0 4px #ccc;
    }
    .btn { background: #E60023; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; }
  </style>
</head>
<body>
  <h2>Welcome, <?= htmlspecialchars($user['username']) ?>!</h2>

  <div class="section">
    <h3>Your Uploaded Images</h3>
    <div class="grid">
      <?php while ($img = $images->fetch_assoc()): ?>
        <div class="card">
          <img src="<?= $img['image_path'] ?>" alt="<?= htmlspecialchars($img['title']) ?>">
          <h4><?= htmlspecialchars($img['title']) ?></h4>
          <small>Tags: <?= htmlspecialchars($img['tags']) ?></small>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

  <div class="section">
    <h3>Your Boards</h3>
    <?php while ($board = $boards->fetch_assoc()): ?>
      <div class="board">
        <strong><?= htmlspecialchars($board['name']) ?></strong><br>
        <small><?= htmlspecialchars($board['description']) ?></small>
      </div>
    <?php endwhile; ?>
  </div>

  <div class="section">
    <h3>People You Follow</h3>
    <?php while ($follow = $following->fetch_assoc()): ?>
      <div class="follower">@<?= htmlspecialchars($follow['username']) ?></div>
    <?php endwhile; ?>
  </div>

  <button class="btn" onclick="window.location.href='dashboard.php'">Back to Dashboard</button>
</body>
</html>
