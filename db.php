<?php
$host = "localhost";
$user = "root";
$pass = ""; // your password
$db = "matrimony_new";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
