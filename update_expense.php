<?php
header('Content-Type: application/json');
include 'connection.php';

$id = $_POST['id'];
$type = $_POST['type'];
$source = $_POST['source'];
$amount = $_POST['amount'];
$date = $_POST['date'];

$query = $connection->prepare("UPDATE expenses SET type = ?, source = ?, amount = ?, date = ? WHERE id = ?");
$query->bind_param("ssdsi", $type, $source, $amount, $date, $id);

if ($query->execute()) {
    echo json_encode([
        "status" => "success", 
        "message" => "Expense updated successfully"
    ]);
} else {
    echo json_encode(["status" => "error", 
    "message" => "Failed to update expense"
]);
}

$query->close();
$connection->close();
?>
