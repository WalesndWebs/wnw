<?php
require_once '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(false, 'Invalid request method');
}

// Get and sanitize input
$name = sanitize($conn, $_POST['name'] ?? '');
$email = sanitize($conn, $_POST['email'] ?? '');
$phone = sanitize($conn, $_POST['phone'] ?? '');
$company = sanitize($conn, $_POST['company'] ?? '');
$service_type = sanitize($conn, $_POST['service_type'] ?? '');
$budget = sanitize($conn, $_POST['budget'] ?? '');
$message = sanitize($conn, $_POST['message'] ?? '');

// Validation
$errors = [];
if (empty($name)) $errors[] = 'Name is required';
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required';
if (empty($message)) $errors[] = 'Message is required';

if (!empty($errors)) {
    jsonResponse(false, 'Validation failed', ['errors' => $errors]);
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, company, service_type, budget, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $name, $email, $phone, $company, $service_type, $budget, $message);

if ($stmt->execute()) {
    $contact_id = $stmt->insert_id;

    // Send notification email (optional - configure SMTP on Hostinger)
    $to = "hello@walesandwebs.com";
    $subject = "New Contact Form Submission - Wales & Webs";
    $emailBody = "Name: $name
Email: $email
Phone: $phone
Company: $company
Service: $service_type
Budget: $budget

Message:
$message";
    $headers = "From: noreply@walesandwebs.com
";
    @mail($to, $subject, $emailBody, $headers);

    jsonResponse(true, 'Thank you! We will get back to you within 24 hours.', ['id' => $contact_id]);
} else {
    jsonResponse(false, 'Something went wrong. Please try again.');
}

$stmt->close();
$conn->close();
