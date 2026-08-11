<?php
session_start();
require_once '../includes/config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($conn, $_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT id, username, password_hash, full_name, role FROM admin_users WHERE username = ? AND is_active = 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password_hash'])) {
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            $_SESSION['admin_name'] = $user['full_name'];
            $_SESSION['admin_role'] = $user['role'];

            // Update last login
            $update = $conn->prepare("UPDATE admin_users SET last_login = NOW() WHERE id = ?");
            $update->bind_param("i", $user['id']);
            $update->execute();
            $update->close();

            header('Location: dashboard.php');
            exit;
        }
    }

    $error = 'Invalid username or password';
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - Wales & Webs</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Inter', sans-serif;
      background: #050508;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
    }
    .login-container {
      width: 100%;
      max-width: 420px;
      padding: 40px;
    }
    .login-box {
      background: #111118;
      border: 1px solid rgba(255,255,255,0.06);
      border-radius: 16px;
      padding: 40px;
    }
    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
      justify-content: center;
      margin-bottom: 32px;
    }
    .logo-icon {
      width: 40px; height: 40px;
      background: linear-gradient(135deg, #10b981, #059669);
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      font-weight: 800; font-size: 1.2rem;
    }
    .logo span { font-weight: 700; font-size: 1.25rem; }
    h1 { font-size: 1.5rem; text-align: center; margin-bottom: 8px; }
    .subtitle { text-align: center; color: #71717a; font-size: 0.9rem; margin-bottom: 32px; }
    .form-group { margin-bottom: 20px; }
    label { display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #a1a1aa; }
    input {
      width: 100%; padding: 12px 16px;
      background: rgba(255,255,255,0.03);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 10px;
      color: #fff; font-size: 0.95rem;
      outline: none; transition: all 0.3s;
    }
    input:focus { border-color: #10b981; background: rgba(255,255,255,0.05); }
    .error {
      background: rgba(239, 68, 68, 0.1);
      border: 1px solid rgba(239, 68, 68, 0.2);
      color: #ef4444;
      padding: 12px;
      border-radius: 10px;
      font-size: 0.875rem;
      margin-bottom: 20px;
      text-align: center;
    }
    button {
      width: 100%; padding: 14px;
      background: linear-gradient(135deg, #10b981, #059669);
      border: none; border-radius: 10px;
      color: #fff; font-weight: 600; font-size: 1rem;
      cursor: pointer; transition: all 0.3s;
    }
    button:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(16,185,129,0.3); }
    .hint { text-align: center; margin-top: 24px; font-size: 0.8rem; color: #52525b; }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-box">
      <div class="logo">
        <div class="logo-icon">W</div>
        <span>Wales & Webs</span>
      </div>
      <h1>Welcome Back</h1>
      <p class="subtitle">Sign in to your admin dashboard</p>

      <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
      <?php endif; ?>

      <form method="POST" action="">
        <div class="form-group">
          <label>Username</label>
          <input type="text" name="username" placeholder="Enter username" required autofocus>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter password" required>
        </div>
        <button type="submit">Sign In</button>
      </form>

      <p class="hint">Default: admin / admin123</p>
    </div>
  </div>
</body>
</html>
