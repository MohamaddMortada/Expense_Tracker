<?php
include 'connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        "status" => "error", 
        "message" => "User not logged in"
    ]);
    exit;
}

$user_id = $_SESSION['user_id'];

$query = $connection->prepare("SELECT * FROM expenses WHERE user_id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();

$transactions = [];

while ($row = $result->fetch_assoc()) {
   
    $transactions[] = $row;
}

echo json_encode($transactions);

$query->close();
$connection->close();
?>
