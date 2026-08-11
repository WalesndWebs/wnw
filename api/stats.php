<?php
require_once '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    jsonResponse(false, 'Invalid request method');
}

$stats = [];

// Total contacts
$result = $conn->query("SELECT COUNT(*) as total FROM contacts");
$stats['total_contacts'] = $result->fetch_assoc()['total'];

// New contacts this week
$result = $conn->query("SELECT COUNT(*) as total FROM contacts WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)");
$stats['new_contacts_week'] = $result->fetch_assoc()['total'];

// Total subscribers
$result = $conn->query("SELECT COUNT(*) as total FROM subscribers WHERE status = 'active'");
$stats['total_subscribers'] = $result->fetch_assoc()['total'];

// Total case studies
$result = $conn->query("SELECT COUNT(*) as total FROM case_studies WHERE status = 'published'");
$stats['total_case_studies'] = $result->fetch_assoc()['total'];

// Total posts
$result = $conn->query("SELECT COUNT(*) as total FROM posts WHERE status = 'published'");
$stats['total_posts'] = $result->fetch_assoc()['total'];

// Recent contacts
$result = $conn->query("SELECT name, email, status, created_at FROM contacts ORDER BY created_at DESC LIMIT 5");
$stats['recent_contacts'] = $result->fetch_all(MYSQLI_ASSOC);

// Recent subscribers
$result = $conn->query("SELECT email, name, subscribed_at FROM subscribers ORDER BY subscribed_at DESC LIMIT 5");
$stats['recent_subscribers'] = $result->fetch_all(MYSQLI_ASSOC);

jsonResponse(true, 'Stats fetched successfully', $stats);

$conn->close();
