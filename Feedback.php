<?php
class Feedback
{
    private $conn;
    private $table = "feedbacks";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($name, $email, $phone, $content)
    {
        $sql = "INSERT INTO $this->table (student_name, student_email, student_phone, content) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) return false;
        $stmt->bind_param("ssss", $name, $email, $phone, $content);
        return $stmt->execute();
    }
}
?>
