<?php
include 'db_connection.php';

// Log script start
error_log("add_user.php script started.");

// Check if the database connection is successful
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    die("Database connection failed.");
}

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs to prevent SQL injection
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
    if ($stmt === false) {
        error_log("Error preparing statement: " . $conn->error);
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ss", $name, $email);

    // Execute the statement
    if ($stmt->execute()) {
        // Log success
        error_log("User added successfully: Name=$name, Email=$email");
        header("Location: view_users.php");
        exit();
    } else {
        // Log error executing statement
        error_log("Error executing statement: " . $stmt->error);
        echo "Error executing statement: " . $stmt->error;
    }

    $stmt->close();
}

// Close database connection
$conn->close();
?>

<!-- HTML form -->
<form method="post" action="">
    Name: <input type="text" name="name" required>
    Email: <input type="email" name="email" required>
    <input type="submit" value="Add User">
</form>
