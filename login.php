<?php
// Step 1: Connect to the MySQL server
$link = mysqli_connect("localhost", "root", "");

// Check if the connection was successful
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select the database
$db_name = "admin_db";
mysqli_select_db($link, $db_name);

// Step 2: Start the session
session_start();

// Step 3: Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Step 4: Query the database to find the user
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($link, $query);

    // Check if the user exists
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        
        // Step 5: Verify the password
        if (password_verify($password, $user['password'])) {
            // Successful login, store user data in session
            $_SESSION['username'] = $username;
            echo "Login successful. Welcome, " . $username . "!<br>";
            // Redirect to a protected page (e.g., dashboard)
            header("Location: index.php");
            exit;
        } else {
            echo "Invalid user!<br>";
        }
    } else {
        echo "Invalid user!<br>";
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
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<!-- Login form -->
<form method="POST" action="">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required><br><br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br><br>

    <input type="submit" value="Login">
</form>

</body>
</html>