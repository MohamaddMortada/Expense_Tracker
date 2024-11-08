<?php
header('Content-Type: application/json');
include 'connection.php';

$id = $_POST['id'];

$query = $connection->prepare("DELETE FROM expenses WHERE id = ?");
$query->bind_param("i", $id);

if ($query->execute()) {
    echo json_encode([
    "status" => "success", 
    "message" => "Expense deleted successfully"
]);
} else {
    echo json_encode([
    "status" => "error", 
    "message" => "Failed to delete expense"
]);
}

$query->close();
$connection->close();
?>
