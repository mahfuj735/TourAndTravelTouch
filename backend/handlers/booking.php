<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../helpers.php';

setCorsHeaders();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('/index.html');
}

requireLogin();

if (!validateCsrfToken($_POST['csrf_token'] ?? '')) {
    redirectWithFlash('/index.html', 'error', 'Invalid form submission. Please try again.');
}

$whereto = trim($_POST['whereto'] ?? '');
$howmany = trim($_POST['howmany'] ?? '');
$arrival = trim($_POST['arrival'] ?? '');
$leaving = trim($_POST['leaving'] ?? '');
$notes = trim($_POST['notes'] ?? '');

if ($whereto === '' || $howmany === '' || $arrival === '' || $leaving === '') {
    redirectWithFlash('/index.html', 'error', 'All fields are required.');
}

if (!validatePositiveInt($howmany)) {
    redirectWithFlash('/index.html', 'error', 'Number of travelers must be a positive number.');
}

if (!validateDate($arrival)) {
    redirectWithFlash('/index.html', 'error', 'Please enter a valid arrival date.');
}

if (!validateDate($leaving)) {
    redirectWithFlash('/index.html', 'error', 'Please enter a valid departure date.');
}

if ($arrival >= $leaving) {
    redirectWithFlash('/index.html', 'error', 'Departure date must be after arrival date.');
}

$user = getLoggedInUser();

ensureBookingUserColumn($connection);

try {
    $stmt = $connection->prepare('INSERT INTO information (whereto, howmany, arrival, leaving, textdata, user_id, user_name, user_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    if ($stmt->execute([$whereto, $howmany, $arrival, $leaving, $notes, $user['id'], $user['name'], $user['email']])) {
        redirectWithFlash('/index.html', 'success', 'Booking submitted successfully! We will contact you soon.');
    }
} catch (Throwable $e) {
    error_log('booking failed: ' . $e->getMessage());
}

redirectWithFlash('/index.html', 'error', 'Booking failed. Please try again.');
