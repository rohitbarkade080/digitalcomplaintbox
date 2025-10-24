<?php
session_start();
include('db_connect.php');

$popup = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reply_submit'])) {
    $complaint_id = $_POST['complaint_id'];
    $reply = $_POST['reply'];

    $stmt = $conn->prepare("UPDATE complaints SET reply=?, status='Seen' WHERE id=?");
    $stmt->bind_param("si", $reply, $complaint_id);
    if($stmt->execute()){
        $popup = "Reply sent successfully!";
    }
    $stmt->close();
}

$result = $conn->query("SELECT c.*, u.full_name FROM complaints c JOIN users u ON c.user_id = u.id ORDER BY c.created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin - Manage Complaints</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

    body { font-family: Poppins, sans-serif; background: #f4f6fb; margin: 0; }
    h1 { background: #2f3fe3; color: white; padding: 15px; text-align: center; display: flex; justify-content: space-between; align-items: center; }
    h1 form button { background: white; color: #2f3fe3; border: none; padding: 8px 15px; border-radius: 8px; cursor: pointer; font-weight: 600; }
    h1 form button:hover { background: #00adb5; color: white; }

    .container { display: flex; flex-wrap: wrap; gap: 20px; padding: 25px; justify-content: center; }

    .card {
      background: linear-gradient(135deg, #ffffff, #f0f4ff);
      padding: 25px; border-radius: 15px; width: 320px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.12);
      position: relative; transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover { transform: translateY(-8px); box-shadow: 0 12px 28px rgba(0,0,0,0.18); }

    .card h3 { margin-top: 0; color: #2f3fe3; font-size: 1.3rem; }
    .card p { margin: 6px 0; color: #333; }

    .badge {
      position: absolute; top: 15px; right: 15px; background: #00adb5; color: white;
      padding: 6px 12px; border-radius: 25px; font-size: 0.85rem;
      animation: fadeIn 0.6s ease forwards;
    }

    .reply-form textarea {
      width: 100%; padding: 10px; border-radius: 8px;
      border: none; background: rgba(255,255,255,0.2);
      backdrop-filter: blur(6px); resize: none; font-size: 0.95rem;
    }
    .reply-form button {
      margin-top: 10px; width: 100%; background: #2f3fe3;
      color: white; border: none; padding: 10px; border-radius: 8px; cursor: pointer;
      font-weight: 600; transition: 0.3s;
    }
    .reply-form button:hover { background: #00adb5; }

    /* Popup message */
    #popup {
      position: fixed; bottom: 30px; right: 30px; background: #00adb5; color: white;
      padding: 14px 22px; border-radius: 12px; box-shadow: 0 6px 18px rgba(0,0,0,0.2);
      opacity: 0; transform: translateY(30px); transition: 0.5s ease;
      font-weight: 600;
    }
    #popup.show { opacity: 1; transform: translateY(0); }

    @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

    @media(max-width: 768px){ .card { width: 90%; } h1 { flex-direction: column; gap: 10px; } }
  </style>
</head>
<body>
  <h1>
    🧑‍💼 Admin Complaint Dashboard
    <form method="POST" action="logout.php">
      <button type="submit">Logout</button>
    </form>
  </h1>

  <div class="container">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="card">
        <h3><?php echo $row['title']; ?></h3>
        <p><strong>From:</strong> <?php echo $row['full_name']; ?></p>
        <p><?php echo $row['description']; ?></p>
        <?php if($row['status']=='Seen') echo '<span class="badge">Seen</span>'; ?>
        <?php if ($row['reply']): ?>
          <p><strong>Reply:</strong> <?php echo $row['reply']; ?></p>
        <?php else: ?>
          <form class="reply-form" method="POST">
            <textarea name="reply" placeholder="Write your reply..." required></textarea>
            <input type="hidden" name="complaint_id" value="<?php echo $row['id']; ?>">
            <button type="submit" name="reply_submit">Send Reply</button>
          </form>
        <?php endif; ?>
      </div>
    <?php endwhile; ?>
  </div>

  <div id="popup"><?php echo $popup; ?></div>
  <script>
    <?php if($popup): ?>
      const popup = document.getElementById('popup');
      popup.classList.add('show');
      setTimeout(()=>{ popup.classList.remove('show'); }, 3000);
    <?php endif; ?>
  </script>
</body>
</html>



