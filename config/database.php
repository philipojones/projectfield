<?php
// config/database.php

$servername = "localhost";
$username = "root";
$password = ""; // Update this with your MySQL password
$dbname = "safari_chap";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
