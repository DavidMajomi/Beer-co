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
            display: block;
            justify-content: center; /* Center search bar */
            margin-top: 20px;         /* Space below the banner */
            font-size: 14px;
            padding-left: 175px;
            padding-right: 175px;
        }

        /* Search input styling */
        .search-box input[type="text"] {
            height: 70px;
            /* padding: 5px 10px;
            border: 1px solid #CCCCCC;
            font-size: 14px; */
            width: 100%; 
            box-sizing: border-box;
        }

  
        .result {
            display: block;
            position: relative;        /* Position results relative to the .search-box */
            top: 15%;                  /* Place the results directly below the search box */
            left: 0;                    /* Align to the left of the search box */
            width: 100%;                /* Ensure results take full width */
            max-height: 300px;          /* Optional: limit the height of the result dropdown */
            overflow-y: auto;           /* Scroll if the results exceed the height */
            background-color: #fff;     /* Background for the result box */
            border: 1px solid #ccc;     /* Border around the results */
            z-index: 9999;              /* Make sure the results appear above other content */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);  /* Optional: add a slight shadow */
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
            <a href='Beeco Kiosk First Draft/specials.html' class="settings-link">
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
        <input type="text" autocomplete="off" placeholder="Search beers..." />
        <div class="result"></div>
    </div>
    <!-- <p> Fisjesfodndfion</p> -->
</body>

</html>