<?php
include 'db_connection.php';

// Log script start
error_log("edit_user.php script started.");

// Check if the database connection is successful
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    die("Database connection failed.");
}

// Update user details if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']); // Ensure $id is an integer
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE Users SET name = ?, email = ? WHERE id = ?");
    if ($stmt === false) {
        error_log("Error preparing statement: " . $conn->error);
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssi", $name, $email, $id);

    // Execute the statement
    if ($stmt->execute()) {
        error_log("User updated successfully: ID=$id, Name=$name, Email=$email");
        echo "<p>User updated successfully.</p>";
    } else {
        error_log("Error updating record: " . $stmt->error);
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch user details
$id = intval($_GET['id']); // Ensure $id is an integer
$stmt = $conn->prepare("SELECT * FROM Users WHERE id = ?");
if ($stmt === false) {
    error_log("Error preparing statement: " . $conn->error);
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("User not found.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Edit User</h1>
        <form method="post" action="edit_user.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
        <a href="view_users.php" class="btn btn-secondary mt-3">Back to User List</a>
    </div>
</body>
</html>
