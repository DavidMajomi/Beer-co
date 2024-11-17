<?php
// Step 1: Connect to the MySQL server
$link = mysqli_connect("localhost", "root", "");

// Check if the connection was successful
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
$db_name = "admin_db";
// Select the database
mysqli_select_db($link, $db_name);

// Step 3: Create the table if it doesn't exist
$tableQuery = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";
if (mysqli_query($link, $tableQuery)) {
    echo "Table 'users' is ready.<br>";
} else {
    die("Error creating table: " . mysqli_error($link));
}

// Step 4: Check if there's an existing admin user
$queryCheckAdmin = "SELECT COUNT(*) AS admin_count FROM users";
$result = mysqli_query($link, $queryCheckAdmin);
$row = mysqli_fetch_assoc($result);
$adminExists = $row['admin_count'] > 0;

// Step 5: Handle form submission for creating an admin user
if ($_SERVER["REQUEST_METHOD"] == "POST" && !$adminExists) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if both fields are filled
    if (empty($username) || empty($password)) {
        echo "Both fields are required.<br>";
    } else {
        // Step 6: Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Step 7: Insert the new user into the database
        $insertQuery = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
        if (mysqli_query($link, $insertQuery)) {
            echo "Admin user created successfully!<br>";
            $adminExists = true; // After successful creation, set adminExists to true
        } else {
            echo "Error creating user: " . mysqli_error($link) . "<br>";
        }
    }
}

// Close the database connection
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin</title>
</head>
<body>

<h2>Create Admin User</h2>

<?php if (!$adminExists): ?>
    <!-- Form to create the username and password if no admin exists -->
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="Create Admin">
    </form>
<?php else: ?>
    <p>Admin user already exists.</p>
<?php endif; ?>

<?php if ($adminExists): ?>
    <!-- Return to main page button if admin exists -->
    <form action="idle.php" method="get">
        <input type="submit" value="Return to Main Page">
    </form>
<?php endif; ?>

</body>
</html>