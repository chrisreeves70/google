<?php
include 'db_connection.php';

// Log script start
error_log("delete_user.php script started.");

// Check if the database connection is successful
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    die("Database connection failed.");
}

// Check if 'id' parameter is set
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure $id is an integer

    // Prepare and bind
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    if ($stmt === false) {
        error_log("Error preparing statement: " . $conn->error);
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        // Log success
        error_log("User deleted successfully: ID=$id");
        echo "<p>User deleted successfully.</p>";
    } else {
        // Log error deleting record
        error_log("Error deleting record: " . $stmt->error);
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "<p>No user ID provided for deletion.</p>";
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Delete User</h1>
        <a href="view_users.php" class="btn btn-secondary mt-3">Back to User List</a>
    </div>
</body>
</html>
