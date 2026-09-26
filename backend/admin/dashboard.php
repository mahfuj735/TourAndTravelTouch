<?php

require_once __DIR__ . '/../config/database.php';

if (empty($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

$bookings = [];
try {
    $bookings = $connection->query('SELECT * FROM information ORDER BY created_at DESC')->fetchAll();
} catch (Throwable $e) {
    error_log('dashboard bookings failed: ' . $e->getMessage());
}

$users = [];
try {
    $users = $connection->query('SELECT id, fullname, email, created_at FROM users ORDER BY created_at DESC')->fetchAll();
} catch (Throwable $e) {
    error_log('dashboard users failed: ' . $e->getMessage());
}

$tb = count($bookings);
$tu = count($users);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <style>
        body { background: #f4f6f9; font-family: Arial, sans-serif; padding: 20px; }
        .topbar { background: #1a1a2e; color: #fff; padding: 16px 24px; border-radius: 12px; margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; }
        .topbar h2 { margin: 0; font-size: 20px; }
        .topbar h2 span { color: #ffa500; }
        .topbar a { color: rgba(255,255,255,0.7); text-decoration: none; margin-left: 16px; font-size: 14px; }
        .topbar a:hover { color: #fff; }
        .topbar .logout { color: #ff6b6b; }
        h3 { margin: 24px 0 12px; font-size: 18px; display: flex; align-items: center; gap: 8px; }
        table { background: #fff; border-radius: 8px; overflow: hidden; width: 100%; border-collapse: collapse; box-shadow: 0 1px 6px rgba(0,0,0,0.06); }
        th { background: #f0f0f0; padding: 10px 12px; text-align: left; font-size: 13px; }
        td { padding: 10px 12px; border-top: 1px solid #eee; font-size: 14px; }
        empty-state { text-align: center; padding: 40px; color: #999; }
        .stats { display: flex; gap: 16px; flex-wrap: wrap; margin-bottom: 24px; }
        .stat-card { background: #fff; border-radius: 8px; padding: 20px; flex: 1; min-width: 140px; box-shadow: 0 1px 6px rgba(0,0,0,0.04); }
        .stat-card .num { font-size: 28px; font-weight: 700; color: #1a1a2e; }
        .stat-card .label { font-size: 13px; color: #888; margin-top: 4px; }
        .stat-card .num.orange { color: #ffa500; }
    </style>
</head>
<body>

<div class="topbar">
    <h2><span>Tour And Travel Touch</span> — Admin</h2>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>
</div>

<div class="stats">
    <div class="stat-card"><div class="num orange"><?= $tb ?></div><div class="label">Total Bookings</div></div>
    <div class="stat-card"><div class="num"><?= $tu ?></div><div class="label">Registered Users</div></div>
</div>

<h3>Bookings (<?= $tb ?>)</h3>
<?php if ($tb > 0): ?>
    <table>
        <tr>
            <th>#</th>
            <th>Name / Details</th>
            <th>Destination</th>
            <th>Travelers</th>
            <th>Arrival</th>
            <th>Departure</th>
            <th>Booked At</th>
        </tr>
        <?php $n = 1; foreach ($bookings as $b): ?>
            <tr>
                <td><?= $n++ ?></td>
                <td><?= htmlspecialchars($b['textdata'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($b['whereto'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($b['howmany'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($b['arrival'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($b['leaving'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($b['created_at'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p class="empty-state">No bookings yet.</p>
<?php endif; ?>

<h3>Users (<?= $tu ?>)</h3>
<?php if ($tu > 0): ?>
    <table>
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Registered At</th>
        </tr>
        <?php $n = 1; foreach ($users as $u): ?>
            <tr>
                <td><?= $n++ ?></td>
                <td><?= htmlspecialchars($u['fullname'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($u['email'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($u['created_at'] ?? '-', ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p class="empty-state">No users registered yet.</p>
<?php endif; ?>

</body>
</html>
