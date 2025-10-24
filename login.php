<?php
include('db_connect.php');
session_start();

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, full_name, password, user_type FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $full_name, $hashed, $user_type);
        $stmt->fetch();
        if (password_verify($password, $hashed)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $full_name;
            $_SESSION['user_type'] = $user_type;
            header("Location: user_dashboard.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User not found!";
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Login</title>
<style>
body {
  margin: 0; padding: 0; font-family: 'Poppins', sans-serif;
  background: url('login-bg.jpg') no-repeat center center/cover;
  height: 100vh;
  display: flex; justify-content: center; align-items: center;
  color: #fff;
}
.overlay {
  position: absolute; width: 100%; height: 100%;
  background: rgba(0,0,0,0.6); top: 0; left: 0;
  z-index: 0;
}
.card {
  position: relative; z-index: 1;
  background: rgba(255,255,255,0.1);
  backdrop-filter: blur(8px);
  padding: 40px 50px; border-radius: 20px;
  text-align: center; width: 400px;
  box-shadow: 0 8px 32px rgba(0,0,0,0.5);
}
h2 { color: #00ffe7; margin-bottom: 10px; }
input {
  width: 100%; padding: 12px; margin: 10px 0;
  border-radius: 10px; border: none; outline: none;
  font-size: 1rem;
}
button {
  width: 100%; padding: 12px;
  background: linear-gradient(135deg,#00ffe7,#0077ff);
  color: #fff; border: none; border-radius: 25px;
  font-size: 1.1rem; cursor: pointer; transition: 0.3s;
}
button:hover {
  transform: scale(1.05);
  background: linear-gradient(135deg,#00ccff,#0055cc);
}
.error { color: #ff6b6b; margin-bottom: 10px; }
p a { color: #00ffe7; text-decoration: none; }
p a:hover { text-decoration: underline; }
</style>
</head>
<body>
<div class="overlay"></div>
<div class="card">
  <h2>User Login</h2>
  <?php if($error) echo "<p class='error'>$error</p>"; ?>
  <form method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
  </form>
  <p>Don’t have an account? <a href="register.php">Register Here</a></p>
</div>
</body>
</html>

