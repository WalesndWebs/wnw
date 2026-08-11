<?php
// ========================================
// WALES & WEBS - DATABASE CONFIGURATION
// ========================================

// Local Development
// define('DB_HOST', 'localhost');
// define('DB_USER', 'root');
// define('DB_PASS', '');
// define('DB_NAME', 'wales_webs');

// Hostinger Production (Update these with your Hostinger credentials)
define('DB_HOST', 'localhost');
define('DB_USER', 'u123456789_wales');  // CHANGE THIS
define('DB_PASS', 'your_password_here'); // CHANGE THIS
define('DB_NAME', 'u123456789_waleswebs'); // CHANGE THIS

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset
$conn->set_charset("utf8mb4");

// Helper function to sanitize input
function sanitize($conn, $data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $conn->real_escape_string($data);
}

// Helper function to send JSON response
function jsonResponse($success, $message, $data = null) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit;
}

// CORS headers for API
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}
