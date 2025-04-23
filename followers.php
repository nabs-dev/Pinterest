<?php
session_start();
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "dboqamh7kg0gi1");
$user_id = $_SESSION['user_id'];
$followers = $conn->query("SELECT users.username FROM followers 
JOIN users ON followers.follower_id = users.id 
WHERE followers.following_id = $user_id LIMIT 10");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Your Followers</title>
  <style>
    body { font-family: Arial; background: #fff; padding: 20px; }
    h2 { color: #E60023; }
    ul { list-style: none; padding: 0; }
    li { background: #f0f0f0; margin: 10px 0; padding: 10px; border-radius: 5px; }
  </style>
</head>
<body>
  <h2>Your Top 10 Followers</h2>
  <ul>
    <?php while($f = $followers->fetch_assoc()): ?>
      <li><?= htmlspecialchars($f['username']) ?></li>
    <?php endwhile; ?>
  </ul>
  <button onclick="window.location.href='dashboard.php'">Back to Dashboard</button>
</body>
</html>
