<?php
// This file is for first-run only. It will reset all the data in the project, refreshing to a default state.
// This file will create/overwrite all the tables in the system.

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'demo');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// CUSTOMER ANALYTICS TABLE

// SQL to drop the table if it exists
$drop_sql = "DROP TABLE IF EXISTS customerAnalytics";
if(mysqli_query($link, $drop_sql)){
    echo "Table customerAnalytics dropped successfully.<br>";
} else {
    echo "ERROR: Could not execute $drop_sql. " . mysqli_error($link) . "<br>";
}

// Attempt create table query execution
$sql = "
        CREATE TABLE customerAnalytics (
            id INT AUTO_INCREMENT PRIMARY KEY,
            month VARCHAR(7),             -- Format: 'YYYY-MM'
            beerclicks JSON,                      -- Array of key-value pairs, stored as JSON
            search_queries JSON,                  -- Array of strings, stored as JSON
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

if(mysqli_query($link, $sql)){
    echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}



// CUSTOMER ANALYTICS TABLE

// SQL to drop the table if it exists
$drop_sql = "DROP TABLE IF EXISTS beers";
if(mysqli_query($link, $drop_sql)){
    echo "Table beers dropped successfully.<br>";
} else {
    echo "ERROR: Could not execute $drop_sql. " . mysqli_error($link) . "<br>";
}

// Attempt create table query execution
$sql = "
        CREATE TABLE beers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            beerName VARCHAR(7),             -- Format: 'YYYY-MM'
            beerOrigin VARCHAR(15),                      -- 15-length string, prioritizing origin as Brewer, then Country if brewer doesnt exist.
            clicks INT,                  -- Number of clicks
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

if(mysqli_query($link, $sql)){
    echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}













 
// Close connection
mysqli_close($link);

