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

        /* Search input and result container */
        .search-box {
            display: block;
            justify-content: center;
            margin-top: 20px;
            font-size: 14px;
            padding-left: 175px;
            padding-right: 175px;
        }

        .search-box input[type="text"] {
            height: 80px;
            width: 100%;
            box-sizing: border-box;
            padding-left: 10px;
        }

        /* Dropdown filter container */
        .filter-dropdown {
            display: flex;
            margin-top: 10px;
            width: auto;
            margin-left: 10px;
            padding: 5px;
        }

        .filter-dropdown select {
            font-size: 14px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Dropdown result container */
        .result {
            display: block;
            position: relative;
            top: 15%;
            left: 0;
            width: 100%;
            max-height: 300px;
            overflow-y: auto;
            background-color: #fff;
            border: 1px solid #ccc;
            z-index: 9999;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

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
    <script>
        $(document).ready(function(){
            // Handle keyup event to trigger search
            $('.search-box input[type="text"]').on("keyup input", function(){
                var inputVal = $(this).val();
                var selectedFilter = $('#filter-select').val();  // Get selected filter
                var resultDropdown = $(this).siblings(".result");
                
                if(inputVal.length){
                    $.get("backend-search.php", {term: inputVal, filter: selectedFilter}).done(function(data){
                        // Display the returned data in the result dropdown
                        resultDropdown.html(data);
                    });
                } else{
                    resultDropdown.empty();
                }
            });

            // Set input value on click of result item
            $(document).on("click", ".result p", function(){
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
        });
    </script>
</head>
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
                Our Specials Page
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

    <!-- Search box with dropdown filter -->
    <div class="search-box">
        <input type="text" autocomplete="off" placeholder="Search beers..." />
        <div class="result"></div>
        
        <!-- Dropdown Filter is now always visible -->
        <div class="filter-dropdown">
            <select id="brewer-select" class="form-control">
                <option value="all">All Brewers</option>
                <option value="coors">Coors</option>
                <option value="founders">Founders Brewing</option>
                <option value="sierra-nevada">Sierra Nevada</option>
            </select>

            <select id="country-select" class="form-control">
                <option value="all">Country</option>
                <option value="United States">United States</option>
                <option value="Germany">Germany</option>
                <option value="Belgium">Belgium</option>
            </select>

            <select id="style-select" class="form-control">
                <option value="all">Style</option>
                <option value="india-pale-ale">India Pale Ale</option>
                <option value="tout">Stout</option>
                <option value="lager">Lager</option>
            </select>

            <label for="filter-number"></label>
            <input type="number" id="filter-number" class="form-control" placeholder="Enter Number" min="1" max="100">


            <label for="filter-number"></label>
            <input type="number" id="filter-number" class="form-control" placeholder="Enter Number" min="1" max="100">
            

            <select id="srm-select" class="form-control">
                <option value="all">SRM</option>
                <option value="light-amber">Light Amber</option>
                <option value="dark-brown">Dark Brown</option>
                <option value="golden">Golden</option>
            </select>
        </div>

    </div>

</body>
</html>
