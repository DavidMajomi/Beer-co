
<?php

// This file is responsible for RESETTING THE DATABASE TO A DEFAULT STATE. It will overwrite/create the database from the start.

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "");

/*
                 RESETTING DATABASE
*/
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// SQL to drop the database if it exists
$drop_sql = "DROP DATABASE IF EXISTS beerco";

// Execute the drop query
if (mysqli_query($link, $drop_sql)) {
    echo "Database 'beerco' dropped successfully (if it existed).<br>";
} else {
    echo "ERROR: Could not drop database 'beerco'. " . mysqli_error($link) . "<br>";
}

// SQL to create the database
$sql = "CREATE DATABASE beerco";

// Attempt create database query execution
if (mysqli_query($link, $sql)) {
    echo "Database 'beerco' created successfully.<br>";
} else {
    echo "ERROR: Could not execute $sql. " . mysqli_error($link) . "<br>";
}

mysqli_close($link);
/*
                 DATABASE RESET
*/

/*
                 CREATING BEER TABLE
*/

// BEER TABLE
$link = mysqli_connect("localhost", "root", "", "beerco");

// SQL to drop the table if it exists
$drop_sql = "DROP TABLE IF EXISTS beers";
if(mysqli_query($link, $drop_sql)){
    echo "Table 'beers' dropped successfully.<br>";
} else {
    echo "ERROR: Not able to execute $drop_sql. " . mysqli_error($link) . "<br>";
}

// Attempt create table query execution
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
        );";

if(mysqli_query($link, $sql)){
    echo "Table 'beers' created successfully.";
} else{
    echo "ERROR: Not able to execute $sql. " . mysqli_error($link);
}


/*
                 BEER TABLE CREATED
*/
$sql_insert = "
    INSERT INTO beers (
        brand_name,
        brewer,
        origin,
        beer_style,
        spec_beer_style,
        description,
        food_pairings,
        ounces,
        milliliters,
        abv,
        ibu,
        srm,
        calories
    ) VALUES (
        'Beer Brand', 
        'Beer Brewer', 
        'Beer Origin', 
        'Beer Style', 
        'Beer Spec Style', 
        'Beer description goes here.', 
        'Beer food pairings go here.', 
        12.0, 
        355, 
        5.5, 
        15, 
        10,
        200 
    );
";


if (mysqli_query($link, $sql_insert)) {
    echo "Data inserted into 'beers' table successfully.<br>";
} else {
    echo "ERROR: Could not execute $sql_insert. " . mysqli_error($link) . "<br>";
}


$sql_insert = "
    INSERT INTO beers (
        brand_name,
        brewer,
        origin,
        beer_style,
        spec_beer_style,
        description,
        food_pairings,
        ounces,
        milliliters,
        abv,
        ibu,
        srm,
        calories
    ) VALUES (
        'Bew Brand', 
        'Beer Brewer', 
        'Beer Origin', 
        'Beer Style', 
        'Beer Spec Style', 
        'Beer description goes here.', 
        'Beer food pairings go here.', 
        12.0, 
        355, 
        5.5, 
        15, 
        10,
        200 
    );
";


if (mysqli_query($link, $sql_insert)) {
    echo "Data inserted into 'beers' table successfully.<br>";
} else {
    echo "ERROR: Could not execute $sql_insert. " . mysqli_error($link) . "<br>";
}

// Close connection
mysqli_close($link);


?>
