<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../helpers.php';

$error = '';

try {
    $row = $connection->query('SELECT COUNT(*) AS cnt FROM admins')->fetch();
    if ((int)($row['cnt'] ?? 0) === 0) {
        $seedUser = getenv('ADMIN_USER') ?: 'admin';
        $seedPass = getenv('ADMIN_PASS') ?: 'admin123';
        $hash = password_hash($seedPass, PASSWORD_BCRYPT, ['cost' => 12]);
        $seed = $connection->prepare("INSERT INTO admins (username, password_hash) VALUES (?, ?)");
        $seed->execute([$seedUser, $hash]);
    }
} catch (Throwable $e) {
    error_log('admin seed failed: ' . $e->getMessage());
    $error = 'Database unavailable. Check DATABASE_URL on the server.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $error === '') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Please enter both fields.';
    } else {
        try {
            $stmt = $connection->prepare('SELECT id, password_hash FROM admins WHERE username = ? LIMIT 1');
            $stmt->execute([$username]);
            $admin = $stmt->fetch();

            if ($admin && password_verify($password, $admin['password_hash'])) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $username;
                header('Location: dashboard.php');
                exit;
            }

            $error = 'Invalid username or password.';
        } catch (Throwable $e) {
            error_log('admin login failed: ' . $e->getMessage());
            $error = 'Database unavailable. Please try again later.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .card { background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.1); border-radius: 24px; padding: 48px 40px; width: 100%; max-width: 420px; }
        .card h1 { color: #fff; font-weight: 700; font-size: 28px; text-align: center; margin-bottom: 8px; }
        .card h1 span { color: #ffa500; }
        .card .sub { color: rgba(255,255,255,0.5); text-align: center; margin-bottom: 32px; font-size: 14px; }
        .card input { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 14px 16px; color: #fff; font-size: 15px; margin-bottom: 16px; width: 100%; }
        .card input::placeholder { color: rgba(255,255,255,0.3); }
        .card button { width: 100%; padding: 14px; border-radius: 12px; border: none; background: linear-gradient(135deg, #ffa500, #ff7b00); color: #fff; font-weight: 600; font-size: 16px; cursor: pointer; }
        .card button:hover { opacity: 0.9; }
        .alert { background: rgba(255,0,0,0.1); border: 1px solid rgba(255,0,0,0.2); color: #ff6b6b; padding: 12px; border-radius: 12px; margin-bottom: 20px; text-align: center; }
        .back { text-align: center; margin-top: 24px; }
        .back a { color: rgba(255,255,255,0.4); text-decoration: none; font-size: 13px; }
        .back a:hover { color: #ffa500; }
        .icon { text-align: center; font-size: 48px; color: #ffa500; margin-bottom: 16px; }
    </style>
</head>
<body>
<div class="card">
    <div class="icon"><i class="fa-solid fa-lock"></i></div>
    <h1><span>Admin</span> Login</h1>
    <p class="sub">Manage bookings &amp; users</p>
    <?php if ($error): ?><div class="alert"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Sign In</button>
    </form>
    <div class="back"><a href="<?= frontendUrl('index.html') ?>">Back to website</a></div>
</div>
</body>
</html>
