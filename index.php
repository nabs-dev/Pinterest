<?php
session_start();
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "dboqamh7kg0gi1");

$images = $conn->query("SELECT images.*, users.username FROM images 
JOIN users ON images.user_id = users.id 
ORDER BY images.id DESC");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Pinterest Clone</title>
  <style>
    body { margin: 0; font-family: Arial; background: #f5f5f5; }
    header { background: #E60023; color: white; padding: 20px; text-align: center; }
    .search-bar { margin-top: 10px; }
    .search-bar input { padding: 10px; width: 60%; border-radius: 5px; border: none; }
    .grid { display: flex; flex-wrap: wrap; justify-content: center; padding: 20px; }
    .card { background: white; margin: 10px; padding: 10px; border-radius: 10px; box-shadow: 0 0 10px #ccc; width: 200px; }
    .card img { width: 100%; border-radius: 10px; }
    .card h4 { margin: 5px 0; font-size: 16px; }
    .follow-btn { background: #E60023; color: white; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer; }
    .auth-btn { background: white; color: #E60023; border: 1px solid white; margin-left: 10px; padding: 10px; border-radius: 5px; }
  </style>
</head>
<body>
<header>
  <h1>Pinterest Clone</h1>
  <div class="search-bar">
    <form action="search.php" method="GET">
      <input name="q" type="text" placeholder="Search by tag or title">
    </form>
    <div>
      <?php if (!isset($_SESSION['user_id'])): ?>
        <button class="auth-btn" onclick="window.location.href='login.php'">Login</button>
        <button class="auth-btn" onclick="window.location.href='signup.php'">Signup</button>
      <?php else: ?>
        <button class="auth-btn" onclick="window.location.href='dashboard.php'">Dashboard</button>
        <button class="auth-btn" onclick="window.location.href='logout.php'">Logout</button>
      <?php endif; ?>
    </div>
  </div>
</header>
<div class="grid">
  <?php while($img = $images->fetch_assoc()): ?>
    <div class="card">
      <img src="<?= $img['image_path'] ?>">
      <h4><?= htmlspecialchars($img['title']) ?></h4>
      <small>by <?= htmlspecialchars($img['username']) ?></small><br>
      <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != $img['user_id']): ?>
        <form action="follow.php" method="POST">
          <input type="hidden" name="follow_id" value="<?= $img['user_id'] ?>">
          <button class="follow-btn">Follow</button>
        </form>
      <?php endif; ?>
    </div>
  <?php endwhile; ?>
</div>
</body>
</html>
