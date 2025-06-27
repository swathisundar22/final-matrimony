<?php
include "db.php";

$gender = $_GET['gender'];

$sql = "SELECT * FROM users WHERE gender='$gender'";
$result = $conn->query($sql);

echo "<h2>List of " . ucfirst($gender) . "s</h2>";
while ($row = $result->fetch_assoc()) {
    echo "<hr>";
    echo "<strong>Name:</strong> " . $row['name'] . "<br>";
    echo "<strong>Profession:</strong> " . $row['profession'] . "<br>";
    echo "<strong>Education:</strong> " . $row['education'] . "<br>";
    echo "<strong>Email:</strong> " . $row['email'] . "<br>";
    echo "<strong>Phone:</strong> " . $row['phone'] . "<br>";
    echo "<strong>Hobbies:</strong> " . $row['hobbies'] . "<br>";
}
?>
