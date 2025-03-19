<?php
header("Access-Control-Allow-Origin: *");  
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include 'db.php';

// Reading JSON
$data = json_decode(file_get_contents("php://input"), true);

// Check if data is received properly
if (!isset($data['email']) || !isset($data['password'])) {
    echo json_encode(["success" => false, "message" => "Invalid input! Email and Password are required."]);
    exit;
}

$email = trim($data['email']);
$password = trim($data['password']);

// Validating the input
if (empty($email) || empty($password)) {
    echo json_encode(["success" => false, "message" => "Please enter both email and password."]);
    exit;
}

// Check if the user exists by retrieving the details from the database
$query = $conn->prepare("SELECT password FROM users WHERE email = ?");
$query->bind_param("s", $email);
$query->execute();
$query->store_result();
$query->bind_result($hashed_password);
$query->fetch();

if ($query->num_rows > 0 && password_verify($password, $hashed_password)) {
    echo json_encode(["success" => true, "message" => "Login successful"]);
} else {
    echo json_encode(["success" => false, "message" => "Invalid credentials"]);
}
?>
