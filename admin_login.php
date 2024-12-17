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

// Start the session
session_start();

// Initialize lockout variables if not set
if (!isset($_SESSION['failed_attempts'])) {
    $_SESSION['failed_attempts'] = 0;
}
if (!isset($_SESSION['lockout_time'])) {
    $_SESSION['lockout_time'] = 0;
}

// Check for lockout
if ($_SESSION['failed_attempts'] >= 3) {
    $lockout_duration = 60 * 5; // 5 minutes in seconds
    $remaining_lockout = $_SESSION['lockout_time'] - time();

    if ($remaining_lockout > 0) {
        $errorMessage = "Too many failed attempts. Try again in " . ceil($remaining_lockout / 60) . " minutes.";
    } else {
        // Reset lockout after duration has passed
        $_SESSION['failed_attempts'] = 0;
        $_SESSION['lockout_time'] = 0;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['failed_attempts'] < 3) {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database to find the user
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($link, $query);

    // Check if the user exists
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Verify the HASHED password
        if (password_verify($password, $user['password'])) {
            // Successful login, reset lockout variables
            $_SESSION['username'] = $username;
            $_SESSION['failed_attempts'] = 0;
            $_SESSION['lockout_time'] = 0;

            // Redirect to a protected page (e.g., dashboard)
            header("Location: admin_settings.php");
            exit;
        } else {
            $errorMessage = "Invalid password!";
            $_SESSION['failed_attempts']++;
        }
    } else {
        $errorMessage = "Invalid username!";
        $_SESSION['failed_attempts']++;
    }

    // If failed attempts reach 3, set lockout time
    if ($_SESSION['failed_attempts'] >= 3) {
        $_SESSION['lockout_time'] = time() + 300; // Lockout for 5 minutes
        $errorMessage = "Too many failed attempts. You are locked out for 5 minutes.";
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        h2 {
            color: #4CAF50;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label {
            font-size: 16px;
        }
        input[type="text"],
        input[type="password"] {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: #ff0000;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }

        .back-arrow {
            position: fixed;
            margin: 50px;
            font-size: 80px;
            height: auto;
            left: 20px;
            bottom: 20px;
        }

        .back-arrow:hover
        {
            color: #4CAF50;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <?php if (isset($errorMessage)): ?>
        <div class="error-message">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>

    <h2>Login</h2>

    <!-- Login form -->
    <?php if ($_SESSION['failed_attempts'] < 3 || time() > $_SESSION['lockout_time']): ?>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <input type="submit" value="Login">
    </form>
    <?php endif; ?>
</div>
<div class="back-arrow" onclick="window.history.back();">
    <i class="fa-solid fa-arrow-left"></i>
</div>
</body>
</html>
