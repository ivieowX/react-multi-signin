<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");

include '../config/database.php';

$data = json_decode(file_get_contents("php://input"));
if (!$data) {
    echo json_encode(["error" => "No data received"]);
    exit;
}

$email = $data->email ?? "";
$password = $data->password ?? "";
if (!$email || !$password) {
    echo json_encode(["error" => "Missing email or password"]);
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
$role = "user"; // Default role

$stmt = $conn->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $hashedPassword, $role);

if ($stmt->execute()) {
    echo json_encode(["message" => "User registered successfully"]);
} else {
    echo json_encode(["error" => "Registration failed"]);
}
?>
