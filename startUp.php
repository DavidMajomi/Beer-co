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
            price FLOAT,
            description TEXT,
            food_pairings TEXT,
            ounces FLOAT,
            milliliters INT,
            abv FLOAT,
            ibu INT,
            srm INT,
            calories INT,
            image VARCHAR(255),
            stock INT
        );";

if(mysqli_query($link, $sql)){
    echo "Table 'beers' created successfully.";
} else{
    echo "ERROR: Not able to execute $sql. " . mysqli_error($link);
}


/*
                 BEER TABLE CREATED
*/


// Close connection
mysqli_close($link);


// Reset admin and prompt creation

// Connect to the MySQL server
$link = mysqli_connect("localhost", "root", "");

// Check if the connection was successful
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL to drop the database if it exists
$drop_sql = "DROP DATABASE IF EXISTS admin_db";

// Execute the drop query
if (mysqli_query($link, $drop_sql)) {
    echo "Database 'admin_db' dropped successfully (if it existed).<br>";
} else {
    echo "ERROR: Could not drop database 'admin_db'. " . mysqli_error($link) . "<br>";
}

// SQL to create the database
$sql = "CREATE DATABASE admin_db";

// Attempt create database query execution
if (mysqli_query($link, $sql)) {
    echo "Database 'admin_db' created successfully.<br>";
} else {
    echo "ERROR: Could not execute $sql. " . mysqli_error($link) . "<br>";
}

// Close the database connection
mysqli_close($link);


// Redirect to create_admin.php
header("Location: create_admin.php");
exit(); // It's a good practice to call exit() after the header redirect to stop further script execution


?>