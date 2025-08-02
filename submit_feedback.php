<?php
header('Content-Type: application/json');
require 'db.php';

$name    = trim($_POST['student_name'] ?? '');
$email   = trim($_POST['student_email'] ?? '');
$phone   = trim($_POST['student_phone'] ?? '');
$content = trim($_POST['content'] ?? '');

// Kiểm tra trường bắt buộc
if (!$name || !$email || !$content) {
    echo json_encode(['success' => false, 'message' => 'Please fill all required fields.']);
    exit;
}

// Validate email hợp lệ
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email format.']);
    exit;
}

$stmt = $conn->prepare("INSERT INTO feedbacks (student_name, student_email, student_phone, content) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Prepare statement failed: ' . $conn->error]);
    exit;
}

$stmt->bind_param("ssss", $name, $email, $phone, $content);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => '✅ Feedback submitted successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => '❌ Error: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
