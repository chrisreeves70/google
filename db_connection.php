<?php
// Database connection settings
$servername = "104.154.99.108"; // Your Google Cloud MySQL public IP address
$username = "root"; // Your MySQL username
$password = "Scout1st"; // Your MySQL password
$dbname = "applicationdb"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Log the error message and display a generic error message to the user
    error_log("Connection failed: " . $conn->connect_error);
    die("Connection failed: Please check your database credentials.");
}

// Connection successful
error_log("Connected successfully to database: " . $dbname);
?>
