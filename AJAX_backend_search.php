<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "beerco");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Prepare the SQL query with dynamic filtering
$sql = "SELECT * FROM beers WHERE 1";

// Array to hold filter conditions
$filters = [];

// Check if a search term is provided (for brand_name)
if(isset($_REQUEST["term"]) && !empty($_REQUEST["term"])) {
    $filters[] = "brand_name LIKE ?";
}

// Check if a brewer is selected
if(isset($_REQUEST["brewer"]) && $_REQUEST["brewer"] != 'all') {
    $filters[] = "brewer = ?";
}

// Check if a country is selected
if(isset($_REQUEST["country"]) && $_REQUEST["country"] != 'all') {
    $filters[] = "origin = ?";
}

// Check if a style is selected
if(isset($_REQUEST["style"]) && $_REQUEST["style"] != 'all') {
    $filters[] = "beer_style = ?";
}

// Check if SRM is selected
if(isset($_REQUEST["srm"]) && $_REQUEST["srm"] != 'all') {
    $filters[] = "srm = ?";
}

// Check if ABV is selected
if (isset($_REQUEST["abv"]) && $_REQUEST["abv"] != 'all') {
    $filters[] = "abv = ?";
}

// Check if IBU is selected
if (isset($_REQUEST["ibu"]) && $_REQUEST["ibu"] != 'all') {
    $filters[] = "ibu = ?";
}

// If there are filters, append them to the SQL query
if(count($filters) > 0) {
    $sql .= " AND " . implode(" AND ", $filters);
}

// Prepare the statement
if($stmt = mysqli_prepare($link, $sql)) {
    
    // Array to hold the parameters to bind
    $params = [];
    $param_types = '';
    
    // Add parameters for search term (if provided)
    if(isset($_REQUEST["term"]) && !empty($_REQUEST["term"])) {
        $params[] = $_REQUEST["term"] . '%';
        $param_types .= 's'; // string
    }
    
    // Add parameters for brewer (if selected)
    if(isset($_REQUEST["brewer"]) && $_REQUEST["brewer"] != 'all') {
        $params[] = $_REQUEST["brewer"];
        $param_types .= 's'; // string
    }
    
    // Add parameters for country (if selected)
    if(isset($_REQUEST["country"]) && $_REQUEST["country"] != 'all') {
        $params[] = $_REQUEST["country"];
        $param_types .= 's'; // string
    }
    
    // Add parameters for style (if selected)
    if(isset($_REQUEST["style"]) && $_REQUEST["style"] != 'all') {
        $params[] = $_REQUEST["style"];
        $param_types .= 's'; // string
    }
    
    // Add parameters for SRM (if selected)
    if(isset($_REQUEST["srm"]) && $_REQUEST["srm"] != 'all') {
        $params[] = $_REQUEST["srm"];
        $param_types .= 's'; // string
    }

    // Add parameters for ABV (if selected)
    if (isset($_REQUEST["abv"]) && $_REQUEST["abv"] != 'all') {
        $params[] = (float)$_REQUEST["abv"]; // Ensure it's treated as a float
        $param_types .= 'd'; // double (float)
    }

    // Add parameters for IBU (if selected)
    if (isset($_REQUEST["ibu"]) && $_REQUEST["ibu"] != 'all') {
        $params[] = (float)$_REQUEST["ibu"]; // Ensure it's treated as a float
        $param_types .= 'd'; // double (float)
    }

    // Bind the parameters dynamically
    if(count($params) > 0) {
        mysqli_stmt_bind_param($stmt, $param_types, ...$params);
    }

    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        
        // Check number of rows in the result set
        if(mysqli_num_rows($result) > 0) {
            // Fetch result rows as an associative array
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                // Display the results
                echo "<p>" . $row["brand_name"] . "</p>";
            }
        } else {
            echo "<p>No matches found</p>";
        }
    } else {
        echo "ERROR: Could not execute $sql. " . mysqli_error($link);
    }
    
    // Close the prepared statement
    mysqli_stmt_close($stmt);
} else {
    echo "ERROR: Could not prepare query $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>
