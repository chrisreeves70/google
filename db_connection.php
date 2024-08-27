<?php
$servername = "35.225.245.211";
$username = "root";
$password = "Scout1st";
$database = "alpha_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

