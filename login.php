<?php
include 'connection.php';
session_start();

$username = $_POST['username'];

$query = $connection->prepare("SELECT user_id FROM users WHERE username = ?");
$query->bind_param("s", $username);
$query->execute();
$query->store_result();
$query->bind_result($user_id);

if ($query->num_rows > 0) {
    $query->fetch();
    $_SESSION['user_id'] = $user_id;
    echo json_encode([
        "status" => "success", 
        "message" => "Login successful"
    ]);
} else {
    echo json_encode([
        "status" => "error", 
        "message" => "User not found"
    ]);
}

$query->close();
$connection->close();
?>
