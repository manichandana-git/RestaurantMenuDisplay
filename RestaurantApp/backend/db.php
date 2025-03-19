<?php
$host = "localhost";
$user = "root"; // My MYSQL Database username
$password = "msmm@2F0a1m9"; // Have added my password here, but removed before uploading to GitHub
$database = "restaurant_db";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["message" => "Database connection failed: " . $conn->connect_error]));
}
?>
