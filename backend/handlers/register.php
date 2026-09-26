<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../helpers.php';

setCorsHeaders();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('/pages/signup.html');
}

if (!validateCsrfToken($_POST['csrf_token'] ?? '')) {
    redirectWithFlash('/pages/signup.html', 'error', 'Invalid form submission. Please try again.');
}

$fullname = trim($_POST['fullname'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($fullname === '' || $email === '' || $password === '') {
    redirectWithFlash('/pages/signup.html', 'error', 'All fields are required.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirectWithFlash('/pages/signup.html', 'error', 'Please enter a valid email address.');
}

if (strlen($password) < 8) {
    redirectWithFlash('/pages/signup.html', 'error', 'Password must be at least 8 characters.');
}

if (userExists($connection, $email)) {
    redirectWithFlash('/pages/signup.html', 'error', 'An account with this email already exists.');
}

$passwordHash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

try {
    $stmt = $connection->prepare('INSERT INTO users (fullname, email, password_hash) VALUES (?, ?, ?)');
    if ($stmt->execute([$fullname, $email, $passwordHash])) {
        redirectWithFlash('/index.html', 'success', 'Registration successful!');
    }
} catch (Throwable $e) {
    error_log('register failed: ' . $e->getMessage());
}

redirectWithFlash('/pages/signup.html', 'error', 'Registration failed. Please try again.');
