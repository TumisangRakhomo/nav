<?php
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$dbname = "your_dbname";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
$data = json_decode(file_get_contents('php://input'), true);

// Extract admin details
$adminName = $data['adminDetails']['name'];
$adminEmail = $data['adminDetails']['email'];
$adminPassword = $data['adminDetails']['password'];

// Extract event details
$eventName = $data['eventDetails']['name'];
$eventLocation = $data['eventDetails']['location'];
$eventTime = $data['eventDetails']['time'];

// Extract emergency alert
$emergencyMessage = $data['emergencyAlert']['message'];

// Insert admin details into the database
$sql = "INSERT INTO admin (name, email, password) VALUES ('$adminName', '$adminEmail', '$adminPassword')";
if ($conn->query($sql) === TRUE) {
    echo "New admin record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Insert event details into the database
$sql = "INSERT INTO events (name, location, time) VALUES ('$eventName', '$eventLocation', '$eventTime')";
if ($conn->query($sql) === TRUE) {
    echo "New event record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Insert emergency alert into the database
$sql = "INSERT INTO emergency_alerts (message) VALUES ('$emergencyMessage')";
if ($conn->query($sql) === TRUE) {
    echo "New emergency alert record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
