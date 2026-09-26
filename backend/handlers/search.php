<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../helpers.php';

setCorsHeaders();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['search'])) {
    redirect('/index.html');
}

$searchTerm = trim($_POST['search']);
$results = [];

$stmt = mysqli_prepare(
    $connection,
    'SELECT * FROM information WHERE whereto LIKE ? OR howmany LIKE ? OR textdata LIKE ? OR user_name LIKE ? OR user_email LIKE ? ORDER BY created_at DESC LIMIT 100'
);
if ($stmt) {
    $likeParam = '%' . $searchTerm . '%';
    mysqli_stmt_bind_param($stmt, 'sssss', $likeParam, $likeParam, $likeParam, $likeParam, $likeParam);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $results[] = $row;
    }

    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Tour And Travel Touch</title>
    <link rel="stylesheet" href="<?= frontendUrl('assets/css/theme-orange.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <style>
        .search-page { padding: 120px 20px 60px; background: linear-gradient(135deg, #f8f9fa, #fff); min-height: 100vh; }
        .search-container { max-width: 1000px; margin: 0 auto; }
        .search-header { text-align: center; margin-bottom: 40px; }
        .search-header h1 { font-family: 'Poppins', sans-serif; font-weight: 700; color: #1a1a2e; }
        .search-header h1 span { color: #ffa500; }
        .search-nav { text-align: center; margin-bottom: 30px; display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
        .search-nav a { padding: 10px 24px; border-radius: 50px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; }
        .search-nav .btn-home { background: #ffa500; color: white; }
        .search-nav .btn-home:hover { background: #e69500; transform: translateY(-2px); box-shadow: 0 4px 15px rgba(255,165,0,0.3); }
        .search-nav .btn-back { background: #1a1a2e; color: white; }
        .search-nav .btn-back:hover { background: #2d2d44; transform: translateY(-2px); }
        .search-table-wrap { background: white; border-radius: 16px; box-shadow: 0 4px 30px rgba(0,0,0,0.06); overflow: hidden; border: 1px solid rgba(0,0,0,0.04); }
        .search-table-wrap table { margin-bottom: 0; }
        .search-table-wrap th { background: linear-gradient(135deg, #ffa500, #ff7b00); color: white; font-weight: 600; border: none; padding: 14px 16px; }
        .search-table-wrap td { padding: 14px 16px; border-bottom: 1px solid #f0f0f0; vertical-align: middle; }
        .search-table-wrap tr:hover { background: #fff8f0; }
        .no-data { text-align: center; padding: 60px 20px; color: #666; }
        .no-data i { font-size: 48px; color: #ddd; margin-bottom: 16px; }
        .no-data h3 { font-size: 20px; color: #333; margin-bottom: 8px; }
    </style>
</head>
<body>
    <div class="search-page">
        <div class="search-container">
            <div class="search-header">
                <h1><span>Search</span> Results</h1>
            </div>
            <div class="search-nav">
                <a href="<?= frontendUrl('index.html') ?>" class="btn-home"><i class="fa-solid fa-house"></i> Home</a>
                <a href="javascript:history.back()" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Back</a>
            </div>

            <div class="search-table-wrap">
                <?php if (count($results) > 0): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Where To</th>
                                <th>How Many</th>
                                <th>Arrival</th>
                                <th>Leaving</th>
                                <th>Name & Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sn = 1; ?>
                            <?php foreach ($results as $data): ?>
                                <?php
                                    $who = trim((string)($data['user_name'] ?? ''));
                                    $mail = trim((string)($data['user_email'] ?? ''));
                                    $notes = trim((string)($data['textdata'] ?? ''));
                                    $whoLine = $who;
                                    if ($mail !== '') {
                                        $whoLine .= ($whoLine !== '' ? ' (' . $mail . ')' : $mail);
                                    }
                                    if ($notes !== '') {
                                        $whoLine .= ($whoLine !== '' ? ' — ' . $notes : $notes);
                                    }
                                    if ($whoLine === '') {
                                        $whoLine = '-';
                                    }
                                ?>
                                <tr>
                                    <td><?= $sn++ ?></td>
                                    <td><?= htmlspecialchars($data['whereto'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($data['howmany'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($data['arrival'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($data['leaving'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($whoLine, ENT_QUOTES, 'UTF-8') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="no-data">
                        <i class="fa-solid fa-search"></i>
                        <h3>No bookings found</h3>
                        <p>No results found for "<?= htmlspecialchars($searchTerm, ENT_QUOTES, 'UTF-8') ?>"</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
