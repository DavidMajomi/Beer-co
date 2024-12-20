<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Specials</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        /* Flex container for horizontal elements */
        .flex-container {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            width: 100%;
            padding: 10px;
        }

        .logo-container {
            margin-left: 20px;
        }

        .logo {
            width: 50px;
            height: auto;
        }

        .banner-container {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #4CAF50;
            color: white;
            padding: 20px 20px;
            cursor: pointer;
            flex-grow: 1;
        }

        H1{
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 20px;
            flex-grow: 1;
        }

        .banner-text {
            max-width: 400px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .settings-container, .help-container, .close-container {
            margin-right: 20px;
        }

        .settings-link, .help-link, .close-link {
            color: black;
            text-decoration: none;
            font-size: 30px;
            padding: 20px;
        }

        .settings-link:hover, .help-link:hover, .close-link:hover {
            color: #4CAF50;
            text-decoration: underline;
        }


        /* Container for all the beer items */
        .beer-items-container {
            display: flex;
            flex-wrap: wrap;  /* Ensure items wrap if necessary */
            gap: 20px;  /* Space between items */
            justify-content: center; /* Align items to the left */
            
        }

        /* Each individual beer item */
        .beer-item {
            width: 300px;  /* Width of each item */
            padding: 15px;  /* Add some padding */
            border: 1px solid #ccc;  /* Add a border around each item */
            border-radius: 8px;  /* Optional: rounded corners */
            text-align: center;  /* Center the text */
            box-sizing: border-box;  /* Include padding and border in the width */
            background-color: #f9f9f9;  /* Background color */
        }

        .beer-item:hover {
            transform: translateY(-5px);  /* Slightly lift the item up */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #e9e9e9;  
            cursor: pointer;
        }

        .beer-item img {
            width: 100%;  /* Make the image fill the container's width */
            height: auto;  /* Maintain aspect ratio */
            border-radius: 8px;  /* Optional: rounded corners for the image */
        }

        /* Optional: Style for the heading and paragraph inside the beer-item */
        .beer-item h3 {
            font-size: 1.2em;
            color: #333;
        }

        .beer-item p {
            font-size: 1em;
            color: #555;
        }

        .back-arrow {
            position: fixed;
            margin: 50px;
            font-size: 80px;
            height: auto;
            bottom: 5px;  
            left: 20px;
            z-index: 1000;
        }

        .back-arrow:hover
        {
            color: #4CAF50;
            text-decoration: underline;
        }
        
    </style>
</head>
<body>
    <div class="flex-container">
        <div class="logo-container">
            <img src="path_to_logo.png" alt="Logo" class="logo">
        </div>

        <div class="admin_settings-container">
            <a href='admin_login.php' class="settings-link">
                <i class="fas fa-cogs"></i> 
            </a>
        </div>

        <div class="banner-container" onclick="window.location.href='specials.php';">
            <div class="banner-text">
                Our Specials Page
            </div>
        </div>

        <div class="help-container">
            <a href="info.php" class="help-link">
                <i class="fa-solid fa-question"></i>
            </a>
        </div>

        <div class="close-container">
            <a href="idle.php" class="close-link">
                <i class="fa-solid fa-x"></i>
            </a>
        </div>
    </div>

    <H1>Current Beers on Specials</H1>


    <?php
        // Database connection settings
        // require_once "startUp.php";
        // require_once "config.php";

        // MySQL connection using MySQLi
        $host = 'localhost';
        $dbname = 'beerco';
        $username = 'root';
        $password = '';
        
        // Create a MySQLi connection (procedural style)
        $link = mysqli_connect($host, $username, $password, $dbname);
        
        // Check the connection
        if (!$link) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        // SQL to fetch all beers (assuming you're getting data from a 'beers' table)
        $sql = "SELECT brand_name, beer_style, promotion_price, promotion_end_date, image FROM beers WHERE special = 1";
        
        // Execute the query
        $result = mysqli_query($link, $sql);
        
        // Check if any results were returned
        echo "<div class='beer-items-container'>";
        if (mysqli_num_rows($result) > 0) {
            // Loop through the rows and display them
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='beer-item' onclick=\"window.location.href='AJAX_display.php?brand_name=" . urlencode($row['brand_name']) . "';\">";
                echo "<h3>" . $row['brand_name'] . " - " . $row['beer_style'] . "</h3>";
                echo "<p>Price: $" . $row['promotion_price'] . "</p>";
                echo "<p>Promo end date: " . (isset($row['promotion_end_date']) ? date("F j, Y", strtotime($row['promotion_end_date'])) : 'N/A') . "</p>";
                echo "<img src='images/" . $row['image'] . "' alt='" . $row['brand_name'] . "' class='beer-image' />";
                echo "</div>";
            }
        echo "</div>";
        } else {
            echo "<h2>No promotions available at this time.</h2>";
        }   
        
        // Close the connection
        mysqli_close($link);
    ?>
    <div class="back-arrow" onclick="window.location.href='AJAX_search.php';">
        <i class="fa-solid fa-arrow-left"></i>
    </div>
</body>
</html>
