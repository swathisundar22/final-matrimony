<?php
include "db.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["error" => "Invalid input"]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO users (name, email, profession, education, phone, hobbies, gender, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param(
    "ssssssss",
    $data['name'],
    $data['email'],
    $data['profession'],
    $data['education'],
    $data['phone'],
    $data['other'],
    $data['gender'],
    $data['photo']
);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => "Failed to register"]);
}
?>
