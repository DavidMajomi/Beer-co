<?php
// Database connection
$host = 'localhost';
$username = 'root'; 
$password = '';      
$dbname = 'beer_co'; 

// Create connection
$link = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if(!$link) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Drop the 'beers' table if it exists
$drop_sql = "DROP TABLE IF EXISTS beers";
if(mysqli_query($link, $drop_sql)){
    echo "Table 'beers' dropped successfully.<br>";
} else {
    echo "ERROR: Could not execute $drop_sql. " . mysqli_error($link) . "<br>";
}

// SQL to create the 'beers' table
$sql = "
    CREATE TABLE IF NOT EXISTS beers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        brand_name VARCHAR(255),
        brewer VARCHAR(255),
        origin VARCHAR(255),
        beer_style VARCHAR(255),
        spec_beer_style VARCHAR(255),
        description TEXT,
        food_pairings TEXT,
        ounces FLOAT,
        milliliters INT,
        abv FLOAT,
        ibu INT,
        srm INT,
        calories INT
    );
";

// Execute the CREATE TABLE query
if(mysqli_query($link, $sql)){
    echo "Table 'beers' created successfully.<br>";
} else {
    echo "ERROR: Could not execute $sql. " . mysqli_error($link) . "<br>";
}

// Close the connection
mysqli_close($link);
?>
