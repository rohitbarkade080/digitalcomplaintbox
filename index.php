<?php include('db_connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Digital Complaint Box</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

* {
  margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif;
}
body, html {
  height: 100%;
  overflow-x: hidden;
}

body {
  background: url('bg_main.jpg') no-repeat center center/cover;
  position: relative;
}

body::before {
  content: '';
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(0,0,0,0.55); /* dark overlay */
  z-index: 0;
}

header {
  position: relative; z-index: 2;
  display: flex; justify-content: space-between; align-items: center;
  padding: 25px 50px;
}

.logo {
  font-size: 2rem; font-weight: 700; color: #fff; display: flex; align-items: center; gap: 10px;
  text-shadow: 1px 1px 5px rgba(0,0,0,0.7);
}

.admin-btn {
  background: rgba(255,255,255,0.2);
  backdrop-filter: blur(10px);
  color: #fff; border: 2px solid rgba(255,255,255,0.3);
  padding: 12px 25px; border-radius: 25px; font-weight: 600; cursor: pointer;
  transition: 0.3s ease;
}
.admin-btn:hover {
  background: #fff; color: #2f3fe3; border: 2px solid #fff;
  transform: translateY(-3px);
}

.hero {
  position: relative; z-index: 2;
  top: 15%;
  text-align: center;
  padding: 0 20px;
}

.hero h1 {
  font-size: 3.5rem; color: #fff; margin-bottom: 20px;
  text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
  animation: fadeIn 1.5s ease forwards;
}

.hero p {
  font-size: 1.3rem; color: #ddd; margin-bottom: 40px;
  text-shadow: 1px 1px 6px rgba(0,0,0,0.6);
  animation: fadeIn 2s ease forwards;
}

.buttons {
  display: flex; justify-content: center; gap: 25px;
  flex-wrap: wrap;
}

.btn {
  background: rgba(255,255,255,0.2);
  backdrop-filter: blur(10px);
  color: #fff; padding: 15px 35px; border-radius: 30px; font-size: 1.2rem;
  border: 2px solid rgba(255,255,255,0.3); cursor: pointer; transition: 0.4s ease;
}
.btn:hover {
  background: #fff; color: #2f3fe3; transform: translateY(-5px) scale(1.05);
}

footer {
  position: relative; z-index: 2; text-align: center; padding: 20px;
  color: #ccc; font-size: 0.9rem;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 768px) {
  .hero h1 { font-size: 2.5rem; }
  .hero p { font-size: 1.1rem; }
  .buttons { flex-direction: column; gap: 15px; }
}
</style>
</head>
<body>
<header>
  <div class="logo">💬 Digital Complaint Box</div>
  <button class="admin-btn" onclick="window.location.href='admin_login.php'">Admin Login</button>
</header>

<div class="hero">
  <h1>Welcome to Digital Complaint Box</h1>
  <p>Register and submit your complaints easily and track them online!</p>
  <div class="buttons">
    <button class="btn" onclick="window.location.href='register.php'">User Registration</button>
    <button class="btn" onclick="window.location.href='login.php'">User Login</button>
  </div>
</div>

<footer>
  © 2025 Digital Complaint Box | Designed by Rohit Barkade & Mayur Jadhav
</footer>
</body>
</html>



