<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
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
            height: 250px;
        }

        .banner-text {
            max-width: 400px;
            text-align: center;
            font-size: 40px;
            font-weight: bold;
            white-space: nowrap;
            overflow: hidden;
            /* text-overflow: ellipsis; */
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
        $(document).ready(function() {
        // Function to handle search based on inputs and filters
        function search() {
            var inputVal = $('.search-box input[type="text"]').val();  // Get search term
            var brewerFilter = $('#brewer-select').val();  // Get selected brewer filter
            var countryFilter = $('#country-select').val();  // Get selected country filter
            var styleFilter = $('#style-select').val();  // Get selected style filter
            var srmFilter = $('#srm-select').val();  // Get selected SRM filter
            var abvFilter = $('#abv-select').val();  // Get selected ABV filter
            var ibuFilter = $('#ibu-select').val();  // Get selected IBU filter
            var resultDropdown = $('.search-box .result');  // Dropdown for results

            if (srmFilter === "light amber") {
                srmFilter = "10,20";  
            } else if (srmFilter === "dark brown") {
                srmFilter = "40,60";
            } else if (srmFilter === "golden") {
                srmFilter = "20,40";
            } else if (srmFilter === "all") {
                srmFilter = "0,60";
            }
            
            // If there is any input text or filter changes, send AJAX request
            $.get("AJAX_backend_search.php", {
                term: inputVal,
                brewer: brewerFilter,
                country: countryFilter,
                style: styleFilter,
                srm: srmFilter,
                abv: abvFilter,
                ibu: ibuFilter
            }).done(function(data) {
                resultDropdown.html(data);  // Display results
            });
        }
        // This code below additionally handles when we are re-directed from a beer that is out of stock
        $(document).ready(function() {
        // Get URL parameters
        const urlParams = new URLSearchParams(window.location.search);

        // Pre-fill filters based on URL parameters
        if (urlParams.has('country')) {
            $('#country-select').val(urlParams.get('country'));
        }
        if (urlParams.has('beer_style')) {
            $('#style-select').val(urlParams.get('beer_style'));
        }

        // Trigger the search to display results with pre-filled filters
        search();
    });

        // Trigger search when typing in the search input
        $('.search-box input[type="text"]').on("keyup input", function() {
            search();  // Call search function on input change
        });

        // Trigger search when changing a filter dropdown
        $('#brewer-select, #country-select, #style-select, #srm-select, #abv-select, #ibu-select').on("change", function() {
            search();  // Call search function on filter change
        });

        search();  

        // Set input value on click of result item
        $(document).on("click", ".result p", function() {
            var clickedBeer = $(this).text();  // Get the text of the clicked result
            $('.search-box input[type="text"]').val(clickedBeer);  // Set the input value to the selected result
            $(this).parent(".result").empty();  // Clear the result dropdown
            
            // Redirect to the beer details page
            window.location.href = "AJAX_display.php?brand_name=" + encodeURIComponent(clickedBeer);
        });
    });
    </script>
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

    <!-- Search box with dropdown filter -->
    <div class="search-box">
        <input type="text" autocomplete="off" placeholder="Search beers..." />
        
        <div class="filter-dropdown">
            <select id="brewer-select" class="form-control">
                <option value="all">All Brewers</option>
                <option value="coors">Coors</option>
                <option value="founders brewing">Founders Brewing</option>
                <option value="sierra nevada">Sierra Nevada</option>
            </select>

            <select id="country-select" class="form-control">
                <option value="all">Country</option>
                <option value="United States">United States</option>
                <option value="Germany">Germany</option>
                <option value="Belgium">Belgium</option>
            </select>

            <select id="style-select" class="form-control">
                <option value="all">Style</option>
                <option value="india pale ale">India Pale Ale</option>
                <option value="stout">Stout</option>
                <option value="lager">Lager</option>
            </select>

            <input type="number" id="abv-select" class="form-control" placeholder="ABV" min="1" max="100">

            <input type="number" id="ibu-select" class="form-control" placeholder="IBU" min="1" max="100">
            

            <select id="srm-select" class="form-control">
                <option value="all">SRM</option>
                <option value="light amber">Light Amber</option>
                <option value="dark brown">Dark Brown</option>
                <option value="golden">Golden</option>
            </select>
        </div>

        <div class="result"></div>

    </div>

</body>
</html>
