<?php
include "db.php";

$name = $_POST['name'];
$gender = $_POST['gender'];
$profession = $_POST['profession'];
$education = $_POST['education'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$hobbies = $_POST['hobbies'];
$password = $_POST['password'];

$sql = "INSERT INTO users (name, gender, profession, education, email, phone, hobbies, password)
VALUES ('$name', '$gender', '$profession', '$education', '$email', '$phone', '$hobbies', '$password')";

if ($conn->query($sql) === TRUE) {
    header("Location: home.php?gender=$gender");
} else {
    echo "Error: " . $conn->error;
}
?>
