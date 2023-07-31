<?php
// db.php
$servername = "localhost";
$username = "shjeon";
$password = "Shjeon1374!";
$dbname = "member_information";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function mc($query) {
    global $conn;
    $result = $conn->query($query);
    return $result;
}
