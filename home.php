<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST, GET");

// ✅ DB connection (update these values if needed)
$servername = "localhost";
$username = "root";
$password = ""; // Default XAMPP password is empty
$dbname = "matrimony_new"; // Make sure this DB exists

$conn = new mysqli($servername, $username, $password, $dbname);

// ❌ Check DB connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["success" => false, "error" => "Database connection failed"]);
    exit;
}

// ✅ POST: Handle profile registration
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data || !isset($data["name"], $data["email"], $data["profession"], $data["education"], $data["phone"], $data["gender"], $data["photo"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "error" => "Missing required fields"]);
        exit;
    }

    $name = $conn->real_escape_string($data["name"]);
    $email = $conn->real_escape_string($data["email"]);
    $profession = $conn->real_escape_string($data["profession"]);
    $education = $conn->real_escape_string($data["education"]);
    $phone = $conn->real_escape_string($data["phone"]);
    $other = isset($data["other"]) ? $conn->real_escape_string($data["other"]) : "";
    $gender = $conn->real_escape_string($data["gender"]);
    $photo = $conn->real_escape_string($data["photo"]);

    $sql = "INSERT INTO profiles (name, email, profession, education, phone, other, gender, photo)
            VALUES ('$name', '$email', '$profession', '$education', '$phone', '$other', '$gender', '$photo')";

    if ($conn->query($sql)) {
        echo json_encode(["success" => true]);
    } else {
        http_response_code(500);
        echo json_encode(["success" => false, "error" => $conn->error]);
    }
    exit;
}

// ✅ GET: Fetch profiles by gender
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $gender = isset($_GET["gender"]) ? $conn->real_escape_string($_GET["gender"]) : "";

    $sql = $gender
        ? "SELECT * FROM profiles WHERE gender = '$gender'"
        : "SELECT * FROM profiles";

    $result = $conn->query($sql);
    $profiles = [];

    while ($row = $result->fetch_assoc()) {
        $profiles[] = $row;
    }

    echo json_encode($profiles);
    exit;
}

http_response_code(405); // Method not allowed
echo json_encode(["success" => false, "error" => "Method not allowed"]);
?>
