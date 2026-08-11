<?php
require_once '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, 'Invalid request method');
}

$email = sanitize($conn, $_POST['email'] ?? '');
$name = sanitize($conn, $_POST['name'] ?? '');

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    jsonResponse(false, 'Please enter a valid email address');
}

// Check if already subscribed
$check = $conn->prepare("SELECT id FROM subscribers WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    $check->close();
    jsonResponse(false, 'You are already subscribed!');
}
$check->close();

// Insert subscriber
$stmt = $conn->prepare("INSERT INTO subscribers (email, name) VALUES (?, ?)");
$stmt->bind_param("ss", $email, $name);

if ($stmt->execute()) {
    jsonResponse(true, 'Successfully subscribed! Welcome to the Wales & Webs community.');
} else {
    jsonResponse(false, 'Something went wrong. Please try again.');
}

$stmt->close();
$conn->close();
