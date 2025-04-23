<?php
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "dboqamh7kg0gi1");
$q = $_GET['q'];
$results = $conn->query("SELECT * FROM images WHERE title LIKE '%$q%' OR tags LIKE '%$q%'");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Search Results</title>
  <style>
    body { font-family: Arial; background: #f5f5f5; padding: 20px; }
    .grid { display: flex; flex-wrap: wrap; }
    .card { background: white; margin: 10px; padding: 10px; width: 200px; border-radius: 10px; box-shadow: 0 0 5px #ccc; }
    .card img { width: 100%; border-radius: 10px; }
  </style>
</head>
<body>
  <h2>Search Results for "<?= htmlspecialchars($q) ?>"</h2>
  <div class="grid">
    <?php while($img = $results->fetch_assoc()): ?>
      <div class="card">
        <img src="<?= $img['image_path'] ?>">
        <h4><?= htmlspecialchars($img['title']) ?></h4>
      </div>
    <?php endwhile; ?>
  </div>
  <button onclick="window.location.href='index.php'">Back to Home</button>
</body>
</html>
