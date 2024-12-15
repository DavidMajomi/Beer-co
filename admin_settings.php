<?php
// Include any necessary files (e.g., header, navigation) or start the session
// session_start();
// include('header.php'); // For including a header if necessary
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative; /* Ensure the container is positioned relative */
        }
        .container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            text-align: center;
        }
        h2 {
            color: #4CAF50;
            font-size: 36px;
            margin-bottom: 20px;
        }
        p.lead {
            font-size: 18px;
            color: #333;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .btn {
            border-radius:10px;
            font-size: 18px;
            text-decoration: none;
            transition: background-color 0.3s;
            padding: 10px 20px;
            width: 100%;
            margin-bottom: 20px; /* Space between buttons */
            margin-right: 5px;
            margin-left: 5px;
        }
        .btn-primary {
            background-color: #4CAF50;
            color: white;
        }
        .btn-primary:hover {
            background-color: #45a049;
        }
        .btn-warning {
            background-color: #ff9800;
            color: white;
        }
        .btn-warning:hover {
            background-color: #fb8c00;
        }
        .btn-secondary {
            background-color: #888;
            color: white;
        }
        .btn-secondary:hover {
            background-color: #777;
        }
        /* Reset button styles */
        .btn-danger {
            background-color: #f44336;
            color: white;
            position: absolute;
            bottom: 20px;
            right: 20px;
            width: auto;
            padding: 10px 20px;
        }
        .btn-danger:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>


<style>
    .spaced-div {
        margin-bottom: 30px; /*Space adjustments */
    }
</style>

<div class="container">
    <h2>Settings</h2>
    <p class="lead">Management Options</p>

    <div class="mt-4 spaced-div"> <!-- Add custom class for spacing -->
        <!-- Edit Database Button -->
        <a href="admin_index.php" class="btn btn-primary btn-lg">
            <i class="fas fa-database"></i> Edit Database
        </a>

        <!-- Customer Data Button -->
        <a href="admin_data.php" class="btn btn-primary btn-lg">
            <i class="fas fa-tag"></i> View Analytics
        </a>
    </div>

    <div class="mt-4 spaced-div"> <!-- Add custom class for spacing -->
        <!-- Edit Specials Button -->
        <a href="edit_specials.php" class="btn btn-warning btn-lg">
            <i class="fas fa-tag"></i> Edit Specials
        </a>

        <!-- Cancel Button -->
        <a href="AJAX_search.php" class="btn btn-secondary btn-sm ml-20">
            <i class="fas fa-times-circle"></i> Cancel
        </a>
    </div>
</div>

<!-- Reset Database Form -->
<form action="confirmReset.php" method="POST" >
    <button type="submit" class="btn btn-danger btn-lg">
        <i class="fas fa-trash-alt"></i> Reset Database
    </button>
</form>

</body>
</html>
