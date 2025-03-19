<?php
header("Access-Control-Allow-Origin: *");  
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include 'db.php';

// Reading input in JSON format
$data = json_decode(file_get_contents("php://input"), true);

// Checking if the data is empty
if (!isset($data['name']) || !isset($data['email']) || !isset($data['password'])) {
    echo json_encode(["message" => "Invalid input! All fields are required."]);
    exit;
}

$name = trim($data['name']);
$email = trim($data['email']);
$password = trim($data['password']);

// Validating input
if (empty($name) || empty($email) || empty($password)) {
    echo json_encode(["message" => "Please fill all fields."]);
    exit;
}

// Ebcrypting the password while storing in database (hash)
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Chceking if the entered email already exists,
//If yes, application will give them link to login to remind them.
$check = $conn->prepare("SELECT id FROM users WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo json_encode(["message" => "Email already exists!"]);
    exit;
}

// Inserting user details into the database
$query = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$query->bind_param("sss", $name, $email, $hashed_password);

if ($query->execute()) {
    echo json_encode(["message" => "Registration successful"]);
} else {
    echo json_encode(["message" => "Error: " . $query->error]);
}
?>
