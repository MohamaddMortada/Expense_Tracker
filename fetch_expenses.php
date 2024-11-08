<?php
header('Content-Type: application/json');
include 'connection.php';

$result = $connection->query("SELECT id, type, source, amount, date FROM expenses");

$transactions = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $transactions[] = $row;
    }
}
echo json_encode($transactions);

$connection->close();
?>
