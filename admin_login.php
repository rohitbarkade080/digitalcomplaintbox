<?php
session_start();

// ✅ Define admin password
$admin_password = "rohit@92092"; // हे बदलायचं असल्यास इथे बदला

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];

    if ($password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_complaint.php");
        exit();
    } else {
        $error = "❌ Incorrect password! Try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - Digital Complaint Box</title>
  <style>
    body {
      margin: 0;
      font-family: "Poppins", sans-serif;
      height: 100vh;
      background: linear-gradient(135deg, #2f3fe3, #00adb5);
      display: flex;
      justify-content: center;
      align-items: center;
      color: #fff;
    }
    .login-box {
      background: rgba(255, 255, 255, 0.1);
      padding: 40px;
      border-radius: 20px;
      width: 400px;
      text-align: center;
      backdrop-filter: blur(10px);
      box-shadow: 0 8px 32px rgba(0,0,0,0.3);
    }
    h2 { margin-bottom: 20px; }
    input {
      width: 80%;
      padding: 12px;
      margin: 10px 0;
      border: none;
      border-radius: 10px;
      text-align: center;
    }
    button {
      padding: 10px 25px;
      background: #fff;
      border: none;
      border-radius: 25px;
      color: #2f3fe3;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover { transform: scale(1.05); background: #00adb5; color: #fff; }
    .error { color: #ff6961; font-size: 0.9rem; }
    .back {
      margin-top: 15px;
      display: inline-block;
      color: #fff;
      text-decoration: none;
      opacity: 0.8;
    }
    .back:hover { opacity: 1; }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>🔐 Admin Login</h2>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
      <input type="password" name="password" placeholder="Enter Admin Password" required><br>
      <button type="submit">Login</button>
    </form>
    <a href="index.php" class="back">← Back to Home</a>
  </div>
</body>
</html>
