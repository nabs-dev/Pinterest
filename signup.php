<?php
$conn = new mysqli("localhost", "u8gr0sjr9p4p4", "9yxuqyo3mt85", "dboqamh7kg0gi1");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $conn->query("INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')");
  echo "<script>window.location.href='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Signup</title>
  <style>
    body { font-family: Arial; background: #ffe; display: flex; justify-content: center; align-items: center; height: 100vh; }
    form { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px gray; }
    input { display: block; margin: 10px 0; padding: 10px; width: 100%; }
    button { padding: 10px 20px; background: #E60023; color: white; border: none; cursor: pointer; }
  </style>
</head>
<body>
  <form method="POST">
    <h2>Create Account</h2>
    <input name="username" placeholder="Username" required>
    <input name="email" type="email" placeholder="Email" required>
    <input name="password" type="password" placeholder="Password" required>
    <button>Signup</button>
  </form>
</body>
</html>
