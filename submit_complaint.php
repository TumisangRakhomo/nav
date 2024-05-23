<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "your_username"; // Replace with your database username
    $password = "your_password"; // Replace with your database password
    $dbname = "your_database"; // Replace with your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $userName = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $userMessage = $_POST['userMessage'];

    // Insert data into database
    $sql = "INSERT INTO complaints (name, email, message) VALUES ('$userName', '$userEmail', '$userMessage')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $conn->close();
}
?>
