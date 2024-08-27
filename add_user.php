<?php
include 'db_connection.php';

// Log script start
error_log("add_user.php script started.");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs to prevent SQL injection
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    // Prepare and bind
    if ($stmt = $conn->prepare("INSERT INTO Users (name, email) VALUES (?, ?)")) {
        $stmt->bind_param("ss", $name, $email);

        // Execute the statement
        if ($stmt->execute()) {
            // Log success
            error_log("User added successfully: Name=$name, Email=$email");
            echo "User added successfully";
        } else {
            // Log error executing statement
            error_log("Error executing statement: " . $stmt->error);
            echo "Error executing statement: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Log error preparing statement
        error_log("Error preparing statement: " . $conn->error);
        echo "Error preparing statement: " . $conn->error;
    }
}

$conn->close();
?>
<!-- HTML form -->
<form method="post" action="">
    Name: <input type="text" name="name" required>
    Email: <input type="email" name="email" required>
    <input type="submit" value="Add User">
</form>
