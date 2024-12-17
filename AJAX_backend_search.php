<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "beerco");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Prepare the SQL query with dynamic filtering
$sql = "SELECT * FROM beers WHERE 1";  // Base query, always true

// Array to hold filter conditions
$filters = [];

// Initialize $param_types
$param_types = '';  // Initialize to avoid the undefined variable warning

// Array to hold the parameters
$params = [];

// Check for a search term (brand_name)
if(isset($_REQUEST["term"]) && !empty($_REQUEST["term"])) {
    $filters[] = "brand_name LIKE ?";  // Add condition for brand_name
    $params[] = $_REQUEST["term"] . '%';  // Wildcard search for LIKE
    $param_types .= 's';  // 's' stands for string
}

// Check if a brewer is selected
if(isset($_REQUEST["brewer"]) && $_REQUEST["brewer"] != 'all') {
    $filters[] = "brewer = ?";  // Add condition for brewer
    $params[] = $_REQUEST["brewer"];
    $param_types .= 's';  // 's' for string
}

// Check if a country is selected
if(isset($_REQUEST["country"]) && $_REQUEST["country"] != 'all') {
    $filters[] = "origin = ?";  // Add condition for country
    $params[] = $_REQUEST["country"];
    $param_types .= 's';  // 's' for string
}

// Check if a style is selected
if(isset($_REQUEST["style"]) && $_REQUEST["style"] != 'all') {
    $filters[] = "beer_style = ?";  // Add condition for style
    $params[] = $_REQUEST["style"];
    $param_types .= 's';  // 's' for string
}

// Check if SRM is selected and is a valid range
if (isset($_REQUEST["srm"]) && $_REQUEST["srm"] != 'all') {
    // Split the SRM range into start and end values
    $srm_range = explode(",", $_REQUEST["srm"]);  // Expecting "start,end" format, e.g., "40,60"
    
    // Ensure there are exactly two values and both are numeric
    if (count($srm_range) == 2 && is_numeric($srm_range[0]) && is_numeric($srm_range[1])) {
        $srm_start = (float)$srm_range[0];  // Convert to float
        $srm_end = (float)$srm_range[1];    // Convert to float
        
        // Add the corresponding SRM range filter to the filters array
        $filters[] = "srm BETWEEN ? AND ?";
        
        // Add the SRM range parameters to the parameters array
        $params[] = $srm_start;
        $params[] = $srm_end;
        
        // Append 'dd' to the parameter types to indicate two float values
        $param_types .= 'dd';
    } else {
        // If the SRM range is invalid, display an error message (or skip the filter)
        echo "Invalid SRM range provided.";
        exit;  // Optionally exit if the input is invalid
    }
}

// Check if ABV is selected
if (isset($_REQUEST["abv"]) && $_REQUEST["abv"] != '') {
    $filters[] = "abv = ?";  // Add condition for ABV
    $params[] = (float)$_REQUEST["abv"];  // Ensure it's treated as a float
    $param_types .= 'd';  // 'd' for double (float)
}

// Check if IBU is selected
if (isset($_REQUEST["ibu"]) && $_REQUEST["ibu"] != '') {
    $filters[] = "ibu = ?";  // Add condition for IBU
    $params[] = (float)$_REQUEST["ibu"];  // Ensure it's treated as a float
    $param_types .= 'd';  // 'd' for double (float)
}

// If there are filters, append them to the SQL query
if(count($filters) > 0) {
    $sql .= " AND " . implode(" AND ", $filters);
}

// Prepare the statement
if($stmt = mysqli_prepare($link, $sql)) {
    // Bind the parameters dynamically if any
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
                echo '<p>' . $row['brand_name'] . '</p>';
            }
        } else {
            echo '<p>No results found.</p>';
        }
    } else {
        echo "ERROR: Could not execute query. " . mysqli_error($link);
    }
} else {
    echo "ERROR: Could not prepare query. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>
