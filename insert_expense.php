<?php
include 'connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit;
}

$user_id = $_SESSION['user_id'];
$type = $_POST['type'];
$source = $_POST['source'];
$amount = $_POST['amount'];
$date = $_POST['date'];

$query = $connection->prepare("INSERT INTO expenses (type, source, amount, date, user_id) VALUES (?, ?, ?, ?, ?)");
$query->bind_param("ssdsi", $type, $source, $amount, $date, $user_id);

if ($query->execute()) {
    echo json_encode(["
    status" => "success", 
    "message" => "Transaction added successfully"
]);
} else {
    echo json_encode([
        "status" => "error", 
        "message" => "Transaction insertion failed"
    ]);
}

$query->close();
$connection->close();
?>
