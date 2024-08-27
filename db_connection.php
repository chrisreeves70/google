<?php
$servername = "35.225.245.211"; // Your Google Cloud MySQL public IP address
$username = "root"; // Your MySQL username
$password = "Scout1st"; // Your MySQL password
$dbname = "alpha_db"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    die("Connection failed: Please check your database credentials.");
}

// Connection successful
error_log("Connected successfully to database: " . $dbname);
?>
