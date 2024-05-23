<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "luct_navigation_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
$username = $_POST['username'];
$password = $_POST['password'];

// Check if user exists
$sql = "SELECT id, password FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $hashed_password);

if ($stmt->num_rows > 0) {
    $stmt->fetch();
    if (password_verify($password, $hashed_password)) {
        echo "success";
    } else {
        echo "invalid_password";
    }
} else {
    echo "user_not_found";
}

$stmt->close();
$conn->close();
?>
