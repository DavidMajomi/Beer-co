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
        }
        .container {
            width: 80%;
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
            border-radius: 5px;
            font-size: 18px;
            text-decoration: none;
            transition: background-color 0.3s;
            padding: 10px 20px;
            width: 100%;
            margin-bottom: 15px; /* Space between buttons */
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
    </style>
</head>
<body>

<div class="container">
    <h2>Settings</h2>
    <p class="lead">Management Options</p>

    <div class="mt-4">
        <!-- Edit Database Button -->
        <a href="index.php" class="btn btn-primary btn-lg">
            <i class="fas fa-database"></i> Edit Database
        </a>

        <!-- Edit Specials Button -->
        <a href="edit_specials.php" class="btn btn-warning btn-lg">
            <i class="fas fa-tag"></i> Edit Specials
        </a>

        <!-- Cancel Button -->
        <a href="AJAX_search.php" class="btn btn-secondary btn-lg">
            <i class="fas fa-times-circle"></i> Cancel
        </a>
    </div>
</div>