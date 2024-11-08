<?php
header('Content-Type: application/json');
include 'connection.php';

$type = $_POST['type'];
$source = $_POST['source'];
$amount = $_POST['amount'];
$date = $_POST['date'];

$query = $connection->prepare("INSERT INTO expenses (type, source, amount, date) VALUES (?, ?, ?, ?)");
$query->bind_param("ssds", $type, $source, $amount, $date);

if ($query->execute()) {
    $newExpenseId = $connection->insert_id;
    echo json_encode([
        "status" => "success", 
        "id" => $newExpenseId,
        "type" => $type, 
        "source" => $source, 
        "amount" => $amount, 
        "date" => $date
    ]);
} else {
    echo json_encode([
        "status" => "error", 
        "message" => "Failed to add transaction"
    ]);
}

$query->close();
$connection->close();
?>
