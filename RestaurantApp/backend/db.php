<?php
$host = "localhost";
$user = "root"; // Change if needed
$password = "msmm@2F0a1m9"; // Change if needed
$database = "restaurant_db";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["message" => "Database connection failed: " . $conn->connect_error]));
}
?>
