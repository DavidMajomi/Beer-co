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
            special VARCHAR(255),
            promotion_price FLOAT,
            promotion_start_date VARCHAR(255),
            promotion_end_date VARCHAR(255),
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
$sql_insert = "
    INSERT INTO beers (
        brand_name,
        brewer,
        origin,
        beer_style,
        spec_beer_style,
        price,
        description,
        food_pairings,
        ounces,
        milliliters,
        abv,
        ibu,
        srm,
        calories,
        image,
        special,
        promotion_price,
        promotion_start_date,
        promotion_end_date,
        stock
    ) VALUES
    ('Hoppy Hills', 'Coors', 'United States', 'IPA', 'Double IPA', 20, 'A bold and bitter IPA with tropical fruit flavors.', 'Pairs well with grilled meats and spicy foods.', 12.0, 355, 7.5, 70, 12, 200, 'placeholder.png', 1, 15, '2024-12-05', '2024-12-10', 1),
    ('Raging Grove', 'Coors', 'United States', 'IPA', 'Double IPA', 20, 'A bold and bitter IPA with tropical fruit flavors.', 'Pairs well with grilled meats and spicy foods.', 12.0, 355, 7.5, 70, 25, 200, 'placeholder.png', 1, 15, '2024-12-05', '2024-12-10', 1),
    ('Long Leg', 'Coors', 'United States', 'IPA', 'Double IPA', 20, 'A bold and bitter IPA with tropical fruit flavors.', 'Pairs well with grilled meats and spicy foods.', 12.0, 355, 7.5, 70, 52, 200, 'placeholder.png', 1, 15, '2024-12-05', '2024-12-10', 1),
    ('Snap Maw', 'Coors', 'United States', 'IPA', 'Double IPA', 20, 'A bold and bitter IPA with tropical fruit flavors.', 'Pairs well with grilled meats and spicy foods.', 12.0, 355, 7.5, 70, 12, 200, 'placeholder.png', 1, 15, '2024-12-05', '2024-12-10', 1),
    ('Thunder Jaw', 'Coors', 'United States', 'IPA', 'Double IPA', 20, 'A bold and bitter IPA with tropical fruit flavors.', 'Pairs well with grilled meats and spicy foods.', 12.0, 355, 7.5, 70, 12, 200, 'placeholder.png', 1, 15, '2024-12-05', '2024-12-10', 1),
    ('Solemn Hills', 'Founders Brewing', 'United States', 'IPA', 'Double IPA', 20, 'A bold and bitter IPA with tropical fruit flavors.', 'Pairs well with grilled meats and spicy foods.', 12.0, 355, 7.5, 70, 12, 200, 'placeholder.png', 1, 15, '2024-12-05', '2024-12-10', 1),
    ('Bowling Hills', 'Coors', 'United States', 'IPA', 'Double IPA', 20, 'A bold and bitter IPA with tropical fruit flavors.', 'Pairs well with grilled meats and spicy foods.', 12.0, 355, 7.5, 70, 12, 200, 'placeholder.png', 0, 15, '2024-12-05', '2024-12-10', 1),
    ('Finnish Dream', 'Coors', 'Germany', 'IPA', 'Double IPA', 20, 'A bold and bitter IPA with tropical fruit flavors.', 'Pairs well with grilled meats and spicy foods.', 12.0, 355, 7.5, 70, 12, 200, 'placeholder.png', 0, 15, '2024-12-05', '2024-12-10', 1),
    ('Crimson Tide', 'Founders Brewing', 'Belgium', 'Pale Ale', 'Session Pale Ale', 20, 'A smooth and refreshing pale ale with citrus notes.', 'Pairs well with seafood and salads.', 4.2, 330, 5.0, 35, 8, 150, 'placeholder.png', 1, 15, '2024-12-06', '2024-12-10', 1),
    ('Golden Peaks', 'Sierra Nevada', 'Germany', 'Lager', 'Helles Lager', 15, 'A crisp and malty lager with a light golden color.', 'Pairs well with light appetizers and pretzels.', 5.0, 500, 5.3, 18, 4, 120, 'placeholder.png', 1, 15, '2024-12-07', '2024-12-10', 1),
    ('Bitter End', 'Coors', 'Belgium', 'India Pale Ale', 'ESB', 20, 'A traditional English ale with a balanced bitter taste.', 'Pairs well with grilled meats and hearty stews.', 5.8, 375, 6.0, 40, 10, 140, 'placeholder.png', 1, 15, '2024-12-06', '2024-12-10', 1),
    ('Stormbringer', 'Firestone Brewing', 'Canada', 'Pale Ale', 'West Coast IPA', 25, 'A bold IPA with pine and citrus aromas.', 'Pairs well with spicy foods and barbecue.', 6.5, 400, 7.2, 65, 12, 180, 'placeholder.png', 1, 15, '2024-12-07', '2024-12-10', 1),
    ('Mountain Roar', 'Everest Brewing', 'India', 'IPA', 'Double IPA', 30, 'A massive double IPA with tropical fruit and pine flavors.', 'Pairs well with spicy Indian curries and rich meats.', 8.0, 355, 9.0, 80, 14, 190, 'placeholder.png', 1, 15, '2024-12-06', '2024-12-10', 1),
    ('Velvet Storm', 'Stormbreaker Brewing', 'Australia', 'Stout', 'Imperial Stout', 25, 'A rich and velvety stout with dark chocolate and coffee notes.', 'Pairs well with desserts like brownies and dark chocolate.', 10.5, 330, 8.5, 50, 18, 160, 'placeholder.png', 1, 15, '2024-12-07', '2024-12-10', 1),
    ('Whispering Pines', 'Forest Grove Brewery', 'Finland', 'Pale Ale', 'American Pale Ale', 18, 'A balanced pale ale with floral hops and a malty backbone.', 'Pairs well with grilled fish and vegetables.', 5.2, 400, 5.5, 40, 8, 130, 'placeholder.png', 1, 15, '2024-12-05', '2024-12-10', 1),
    ('Twilight Brew', 'Shadow Mountain Brewing', 'Belgium', 'Belgian Ale', 'Tripel', 25, 'A smooth and fruity Belgian Tripel with hints of spice.', 'Pairs well with rich cheeses and charcuterie.', 9.0, 330, 9.5, 35, 14, 170, 'placeholder.png', 1, 15, '2024-12-06', '2024-12-10', 1),
    ('Red Fury', 'Wildfire Brewing', 'USA', 'Red Ale', 'American Red Ale', 15, 'A malt-forward red ale with caramel and toffee flavors.', 'Pairs well with burgers and roasted meats.', 6.2, 500, 6.0, 40, 10, 140, 'placeholder.png', 1, 15, '2024-12-07', '2024-12-10', 1),
    ('Tropical Blaze', 'Sunshine Brewing', 'Mexico', 'Pale Ale', 'New England IPA', 30, 'A juicy IPA with tropical fruit notes and a hazy appearance.', 'Pairs well with seafood tacos and spicy salsas.', 7.2, 355, 8.0, 45, 12, 175, 'placeholder.png', 1, 15, '2024-12-05', '2024-12-10', 1);

";

if (mysqli_query($link, $sql_insert)) {
    echo "Data inserted into 'beers' table successfully.<br>";
} else {
    echo "ERROR: Could not execute $sql_insert. " . mysqli_error($link) . "<br>";
}


// Close connection
mysqli_close($link);


// Search Analytics
$link = mysqli_connect("localhost", "root", "", "beerco");

// SQL to drop the table if it exists
$drop_sql = "DROP TABLE IF EXISTS search_data";
if(mysqli_query($link, $drop_sql)){
    echo "Table 'customer_data' dropped successfully.<br>";
} else {
    echo "ERROR: Not able to execute $drop_sql. " . mysqli_error($link) . "<br>";
}


// Attempt create table query execution
$sql = "
        CREATE TABLE IF NOT EXISTS search_data (
            id INT AUTO_INCREMENT PRIMARY KEY,
            search_term VARCHAR(255) NOT NULL,
            count INT NOT NULL
        );";

if(mysqli_query($link, $sql)){
    echo "Table 'search_data' created successfully.";
} else{
    echo "ERROR: Not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);


// Beer Analytics
$link = mysqli_connect("localhost", "root", "", "beerco");

// SQL to drop the table if it exists
$drop_sql = "DROP TABLE IF EXISTS popular_data";
if(mysqli_query($link, $drop_sql)){
    echo "Table 'popular_data' dropped successfully.<br>";
} else {
    echo "ERROR: Not able to execute $drop_sql. " . mysqli_error($link) . "<br>";
}


// Attempt create table query execution
$sql = "
        CREATE TABLE IF NOT EXISTS popular_data (
            id INT AUTO_INCREMENT PRIMARY KEY,
            brand_name VARCHAR(255) NOT NULL,
            clicks INT NOT NULL
        );";

if(mysqli_query($link, $sql)){
    echo "Table 'popular_data' created successfully.";
} else{
    echo "ERROR: Not able to execute $sql. " . mysqli_error($link);
}

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

mysqli_close($link);


// Redirect to create_admin.php
header("Location: create_admin.php");
exit(); // It's a good practice to call exit() after the header redirect to stop further script execution


?>