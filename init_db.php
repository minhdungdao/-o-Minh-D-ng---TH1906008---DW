<?php
include 'db.php';

$sql = "CREATE TABLE IF NOT EXISTS feedbacks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(100) NOT NULL,
    student_email VARCHAR(100) NOT NULL,
    student_phone VARCHAR(20),
    content TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Unread','Read') DEFAULT 'Unread'
)";

if ($conn->query($sql) === TRUE) {
    echo "Table created!";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>
