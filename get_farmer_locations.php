<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faccount";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// SQL query to select data from your table
$sql = "SELECT ID, farmer_n, sex, age, farm_n, area, fcontact, crop_name, crop_status, barangay, latitude, longitude FROM farmer_acc";
$result = $conn->query($sql);
$data = [];

// Fetch data from database
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode(['status' => 'success', 'farmers' => $data]);
} else {
    echo json_encode(['status' => 'success', 'farmers' => []]);
}

// Close connection
$conn->close();
?>
