<?php
// db.php
session_start();
include 'config.php';


$servername = "localhost";
$username = "sunkist";
$password = "tapesunk!";
$dbname = "sunkist";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function mc($query) {
    global $conn;
    $result = $conn->query($query);
    return $result;
}
