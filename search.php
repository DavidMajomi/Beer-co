<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        /* General Body Styling */
        body {
            margin: 0;
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
            margin-left: 20px; /* Space from the left edge of the page */
        }

        /* Logo styling */
        .logo {
            width: 50px; /* Adjust size */
            height: auto;
        }

        /* Styling for the Banner container */
        .banner-container {
            display: flex;
            align-items: center;         /* Vertically center the banner text */
            justify-content: center;     /* Horizontally center the banner text */
            background-color: #4CAF50;   /* Green background */
            color: white;
            padding: 20px 20px;
            cursor: pointer;
            flex-grow: 1;                /* Banner container takes up the remaining space */
        }

        /* Banner Text Styling */
        .banner-text {
            max-width: 400px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .settings-container {
            margin-right: 20px;  
        }

        /* Settings link styling */
        .settings-link {
            color: black;
            text-decoration: none;
            font-size: 30px;
            padding: 20px;
        }

        .help-container {
            margin-right: 20px;  /* Space from the right edge */
        }   

        /* Help link styling */
        .help-link {
            color: black;
            text-decoration: none;
            font-size: 30px;
            padding: 20px;
        }

        /* Styling for the Close icon container (X) */
        .close-container {
            margin-right: 20px;  /* Space from the right edge */
        }

        /* Close link styling */
        .close-link {
            color: black;
            text-decoration: none;
            font-size: 30px;
            padding: 20px;
        }

        /* Optional: Styling the icons when hovering */
        .help-link:hover, .close-link:hover {
            color: #4CAF50; /* Change color on hover */
            text-decoration: underline;
        }

        /* Hover effect for the banner */
        .banner-container:hover {
            background-color: #45a049;
        }

        /* Hover effect for the settings link */
        .settings-link:hover {
            text-decoration: underline;
        }

        /* Styling for the search box */
        .search-box {
            display: flex;
            justify-content: center; /* Center search bar */
            margin-top: 20px;         /* Space below the banner */
            font-size: 14px;
            margin-left: 175px;
            
        }

        /* Search input styling */
        .search-box input[type="text"] {
            height: 70px;
            padding: 5px 10px;
            border: 1px solid #CCCCCC;
            font-size: 14px;
            width: 100%; 
            box-sizing: border-box;
        }

        /* Search results styling */
        .result {
            position: absolute;
            z-index: 999;
            top: 100%;
            left: 0;
            width: 100%;
            box-sizing: border-box;
        }

        /* Styling for each result item */
        .result p {
            margin: 0;
            padding: 7px 10px;
            border: 1px solid #CCCCCC;
            border-top: none;
            cursor: pointer;
        }

        .result p:hover {
            background: #f2f2f2;
        }

    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    $(document).ready(function(){
        $('.search-box input[type="text"]').on("keyup input", function(){
            /* Get input value on change */
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if(inputVal.length){
                $.get("backend-search.php", {term: inputVal}).done(function(data){
                    // Display the returned data in browser
                    resultDropdown.html(data);
                });
            } else{
                resultDropdown.empty();
            }
        });
        
        // Set search input value on click of result item
        $(document).on("click", ".result p", function(){
            $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
            $(this).parent(".result").empty();
        });
    });
    </script>
<body>
    <div class="flex-container">
        <div class="logo-container">
            <img src="path_to_logo.png" alt="Logo" class="logo">
        </div>

        <div class="settings-container">
            <a href="settings.html" class="settings-link">
                <i class="fas fa-cogs"></i> 
            </a>
        </div>

        <div class="banner-container" onclick="window.location.href='Beeco Kiosk First Draft/specials.html';">
            <div class="banner-text">
                Click here to visit our Specials Page!
            </div>
        </div>

        <div class="help-container">
            <a href="help.html" class="help-link">
                <i class="fa-solid fa-question"></i>
            </a>
        </div>

        <div class="close-container">
                <a href="close.html" class="close-link">
                    <i class="fa-solid fa-x"></i>
                </a>
        </div>
    </div>

    <div class="search-box">
        <input type="text" autocomplete="on" placeholder="Search beers..." />
        <div class="result"></div>
    </div>
</body>

<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "beerco");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
if(isset($_REQUEST["term"])){
    // Prepare a select statement
    $sql = "SELECT * FROM beers WHERE name LIKE ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        
        // Set parameters
        $param_term = $_REQUEST["term"] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    echo "<p>" . $row["name"] . "</p>";
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}
 
// close connection
mysqli_close($link);
?>

</body>
</html>