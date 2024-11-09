<?php
include 'connection.php';

$username = $_POST['username'];

$query = $connection->prepare("INSERT INTO users (username) VALUES (?)");
$query->bind_param("s", $username);

if ($query->execute()) {
    echo json_encode([
        "status" => "success", 
        "message" => "User registered successfully"
    ]);
} else {
    echo json_encode([
        "status" => "error", 
        "message" => "Registration failed"
    ]);
}

$query->close();
$connection->close();
?>
