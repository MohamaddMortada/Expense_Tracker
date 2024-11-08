<?php
$host = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "transactiondb";

$connection = new mysqli($host, $dbuser, $dbpass, $dbname);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
