<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "safari_chap";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT bus_number, current_lat, current_lng FROM buses";
$result = $conn->query($sql);

$buses = array();
while($row = $result->fetch_assoc()) {
    $buses[] = $row;
}

header('Content-Type: application/json');
echo json_encode($buses);

$conn->close();
?>
