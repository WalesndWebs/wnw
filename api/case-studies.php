<?php
require_once '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    jsonResponse(false, 'Invalid request method');
}

$slug = $_GET['slug'] ?? '';
$category = $_GET['category'] ?? '';
$featured = isset($_GET['featured']) ? true : false;

if (!empty($slug)) {
    // Get single case study
    $stmt = $conn->prepare("SELECT * FROM case_studies WHERE slug = ? AND status = 'published'");
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        jsonResponse(false, 'Case study not found');
    }

    jsonResponse(true, 'Case study fetched', $result->fetch_assoc());
    $stmt->close();
} else {
    // Get all case studies
    $sql = "SELECT * FROM case_studies WHERE status = 'published'";
    $params = [];
    $types = "";

    if (!empty($category)) {
        $sql .= " AND category = ?";
        $params[] = $category;
        $types .= "s";
    }

    if ($featured) {
        $sql .= " AND featured = 1";
    }

    $sql .= " ORDER BY created_at DESC";

    $stmt = $conn->prepare($sql);

    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $case_studies = $result->fetch_all(MYSQLI_ASSOC);

    jsonResponse(true, 'Case studies fetched', $case_studies);
    $stmt->close();
}

$conn->close();
