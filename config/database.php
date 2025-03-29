<?php
$host = "localhost";
$username = "root";
$pass = "";
$dbname = "role_based_app";

$conn = new mysqli($host, $username, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
