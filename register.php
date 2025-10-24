<?php
include('db_connect.php');
session_start();

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $user_type = 'student'; // fixed for now

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // check existing email
    $stmt_check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        $error = "This email is already registered. Please login.";
    } else {
        $stmt_insert = $conn->prepare("INSERT INTO users (full_name, email, password, user_type) VALUES (?, ?, ?, ?)");
        $stmt_insert->bind_param("ssss", $full_name, $email, $hashed_password, $user_type);

        if ($stmt_insert->execute()) {
            $success = "Registration successful! Redirecting to login...";
            echo "<script>setTimeout(()=>{window.location.href='login.php';},2000);</script>";
        } else {
            $error = "Registration failed. Try again.";
        }
        $stmt_insert->close();
    }
    $stmt_check->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Registration - Digital Complaint Box</title>
<style>
body {
  margin: 0;
  padding: 0;
  font-family: 'Poppins', sans-serif;
  background: url('register-bg.jpg') no-repeat center center/cover;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  color: #fff;
}
.overlay {
  position: absolute;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.6);
  top: 0; left: 0;
  z-index: 0;
}
.card {
  position: relative;
  z-index: 1;
  width: 380px;
  background: rgba(255,255,255,0.1);
  backdrop-filter: blur(8px);
  padding: 40px 35px;
  border-radius: 20px;
  text-align: center;
  box-shadow: 0 0 20px rgba(0,0,0,0.5);
}
.card h2 {
  margin-bottom: 15px;
  color: #00ffe7;
}
.card input {
  width: 100%;
  padding: 12px;
  margin: 10px 0;
  border: none;
  border-radius: 10px;
  font-size: 1rem;
  outline: none;
}
.card button {
  width: 100%;
  padding: 12px;
  background: linear-gradient(135deg,#00ffe7,#0077ff);
  color: #fff;
  border: none;
  border-radius: 25px;
  font-size: 1.1rem;
  cursor: pointer;
  transition: 0.3s;
}
.card button:hover {
  transform: scale(1.05);
  background: linear-gradient(135deg,#00ccff,#0055cc);
}
.message {
  margin-bottom: 10px;
  font-weight: 600;
}
.success { color: #00ff9d; }
.error { color: #ff6b6b; }
.card p { margin-top: 10px; font-size: 0.9rem; }
.card a { color: #00ffe7; text-decoration: none; }
.card a:hover { text-decoration: underline; }
</style>
</head>
<body>
<div class="overlay"></div>
<div class="card">
  <h2>Student Registration</h2>
  <?php if($error): ?><p class="message error"><?= $error ?></p><?php endif; ?>
  <?php if($success): ?><p class="message success"><?= $success ?></p><?php endif; ?>
  <form method="post">
    <input type="text" name="full_name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Register Now</button>
  </form>
  <p>Already have an account? <a href="login.php">Go to Login</a></p>
</div>
</body>
</html>
