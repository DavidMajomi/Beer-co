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
    ) VALUES
    ('Hoppy Hills', 'Hoppy Brewing Co.', 'United States', 'IPA', 'Double IPA', 'A bold and bitter IPA with tropical fruit flavors.', 'Pairs well with grilled meats and spicy foods.', 12.0, 355, 7.5, 70, 12, 200),
    ('Golden River', 'Golden Brew Inc.', 'United States', 'Pale Ale', 'American Pale Ale', 'Crisp and refreshing with a light citrus finish.', 'Perfect with burgers, fries, or seafood.', 12.0, 355, 5.2, 40, 7, 180),
    ('Amber Waves', 'Amber Brewing', 'Germany', 'Amber Ale', 'English Amber', 'A malty, smooth ale with a hint of caramel.', 'Great with roasted chicken or stew.', 12.0, 355, 5.6, 20, 15, 210),
    ('Dark Forest', 'Woods Brewery', 'Germany', 'Stout', 'Imperial Stout', 'Rich and robust with dark chocolate and coffee notes.', 'Pairs wonderfully with dark chocolate or steak.', 12.0, 355, 8.0, 50, 30, 300),
    ('Mountain Breeze', 'Alpine Brewers', 'Germany', 'Pilsner', 'German Pilsner', 'Light, crisp, and refreshing with a mild hop flavor.', 'Perfect for light salads or seafood dishes.', 12.0, 355, 4.9, 25, 5, 150),
    ('Sunset Red', 'Sunset Brewing', 'Belgium', 'Red Ale', 'Belgian Red Ale', 'Malty with a balanced sweetness and a touch of caramel.', 'Pairs well with grilled saUnited Statesges or pizza.', 12.0, 355, 5.3, 22, 18, 190),
    ('Citrus Wave', 'Tropical Brewing', 'Belgium', 'IPA', 'New England IPA', 'Juicy and hazy with a burst of citrus flavors.', 'Goes well with spicy Asian food or fish tacos.', 12.0, 355, 6.8, 55, 10, 220),
    ('Bitter End', 'End of the Line Brewing', 'Belgium', 'Porter', 'Belgian Porter', 'Smooth and dark with hints of chocolate and roasted coffee.', 'Pairs excellently with burgers or barbecue.', 12.0, 355, 6.2, 35, 25, 250),
    ('Crisp Wave', 'Clear Waters Brewing', 'United States', 'Lager', 'Vienna Lager', 'Smooth and malty with a toasty flavor and clean finish.', 'Great with light salads or grilled chicken.', 12.0, 355, 4.7, 15, 12, 170),
    ('Peach Breeze', 'Peach Valley Brewery', 'United States', 'Wheat Beer', 'Fruit Wheat Beer', 'A refreshing wheat beer with a touch of peach flavor.', 'Perfect for light seafood or summer salads.', 12.0, 355, 4.5, 18, 6, 160),
    ('Hazy Ridge', 'Hoppy Brewing Co.', 'United States', 'IPA', 'West Coast IPA', 'A crisp and piney IPA with hints of grapefruit.', 'Pairs well with grilled meats or sharp cheeses.', 12.0, 355, 6.5, 60, 10, 190),
    ('Harbor Breeze', 'Hoppy Brewing Co.', 'United States', 'Pilsner', 'American Pilsner', 'Light, crisp, and slightly bitter with a grassy finish.', 'Perfect with oysters or a fresh salad.', 12.0, 355, 5.1, 30, 8, 160),
    
    ('Golden Peak', 'Golden Brew Inc.', 'United States', 'Amber Ale', 'American Amber Ale', 'Malty with caramel sweetness and a slight hop bitterness.', 'Great with grilled burgers or roast pork.', 12.0, 355, 5.8, 35, 9, 180),
    ('Golden Sun', 'Golden Brew Inc.', 'United States', 'Wheat Beer', 'American Wheat Beer', 'Light and refreshing with citrus and wheat notes.', 'Pairs well with salads, light seafood, or fresh fruit.', 12.0, 355, 5.0, 15, 6, 150),
    
    ('Amber Horizon', 'Amber Brewing', 'Germany', 'Pilsner', 'German Pilsner', 'Crisp, clean, and mildly bitter with floral hop flavors.', 'Perfect for seafood or soft cheeses.', 12.0, 355, 4.8, 30, 7, 170),
    ('Amber Forbes', 'Amber Brewing', 'United States', 'Pilsner', 'German Pilsner', 'Crisp, clean, and mildly bitter with floral hop flavors.', 'Perfect for seafood or soft cheeses.', 12.0, 355, 4.8, 30, 7, 170),
    ('Amber River', 'Amber Brewing', 'Germany', 'IPA', 'German IPA', 'Bold and hoppy with tropical fruit and pine flavors.', 'Pairs well with spicy saUnited Statesges or grilled meats.', 12.0, 355, 7.0, 60, 12, 210),
    
    ('Dark Pine', 'Woods Brewery', 'Germany', 'Lager', 'Dark Lager', 'Rich and malty with a smooth roasted flavor and hints of chocolate.', 'Pairs well with hearty stews or grilled saUnited Statesges.', 12.0, 355, 5.4, 25, 18, 180),
    ('Deep Forest', 'Woods Brewery', 'Germany', 'Bock', 'Doppelbock', 'Malty with rich caramel and dark fruit flavors.', 'Great with roasted meats or sharp cheeses.', 12.0, 355, 7.6, 40, 22, 230),
    
    ('Mountain Stream', 'Alpine Brewers', 'Germany', 'Pale Ale', 'German Pale Ale', 'Light and floral with a balanced bitterness and bready malt backbone.', 'Pairs well with pretzels or roasted chicken.', 12.0, 355, 5.4, 25, 8, 170),
    ('Mountain Cliff', 'Alpine Brewers', 'Germany', 'Weissbier', 'Hefeweizen', 'Smooth and cloudy with banana and clove flavors.', 'Perfect with bratwurst or grilled chicken.', 12.0, 355, 5.2, 18, 15, 160),
    
    ('Sunset Glow', 'Sunset Brewing', 'Belgium', 'Tripel', 'Belgian Tripel', 'Strong and complex with fruity esters and a subtle spice.', 'Pairs well with rich seafood or creamy cheeses.', 12.0, 355, 9.0, 30, 20, 260),
    ('Sundown Gold', 'Sunset Brewing', 'Belgium', 'Blonde Ale', 'Belgian Blonde Ale', 'Crisp and malty with light floral hops and a clean finish.', 'Pairs wonderfully with grilled chicken or goat cheese.', 12.0, 355, 6.3, 22, 10, 200),
    
    ('Citrus Mist', 'Tropical Brewing', 'Belgium', 'Saison', 'Belgian Saison', 'Spicy and fruity with peppery notes and a dry finish.', 'Great with mussels or grilled vegetables.', 12.0, 355, 6.4, 35, 12, 210),
    ('Citrus Light', 'Tropical Brewing', 'Belgium', 'Lager', 'Belgian Lager', 'Smooth and balanced with a hint of citrus zest.', 'Perfect with salads or light pasta dishes.', 12.0, 355, 5.0, 20, 8, 170),
    
    ('Bitter Soul', 'End of the Line Brewing', 'Belgium', 'Stout', 'Belgian Stout', 'Rich and velvety with roasted coffee and dark chocolate notes.', 'Pairs well with rich desserts or grilled steaks.', 12.0, 355, 7.5, 50, 28, 290),
    ('Bitter Horizon', 'End of the Line Brewing', 'Belgium', 'Porter', 'Belgian Porter', 'Smooth with deep roasted flavors and hints of toffee.', 'Perfect with barbecue or aged cheddar.', 12.0, 355, 6.3, 40, 24, 240),
    
    ('Crisp Creek', 'Clear Waters Brewing', 'United States', 'Lager', 'American Lager', 'Light and crisp with a balanced malt flavor.', 'Perfect for a hot day with burgers or chips.', 12.0, 355, 4.3, 10, 5, 140),
    ('Crisp Bay', 'Clear Waters Brewing', 'United States', 'Pale Ale', 'American Pale Ale', 'Crisp with citrus notes and a moderate bitterness.', 'Pairs well with fried chicken or grilled shrimp.', 12.0, 355, 5.6, 30, 10, 180),
    
    ('Peach Sunset', 'Peach Valley Brewery', 'United States', 'Fruit Beer', 'Peach Fruit Ale', 'A sweet and refreshing beer with a burst of peach flavor.', 'Perfect for a summer picnic with light salads or seafood.', 12.0, 355, 4.7, 12, 4, 150),
    ('Peach Grove', 'Peach Valley Brewery', 'United States', 'Wheat Beer', 'Peach Wheat Beer', 'A light and fruity wheat beer with a juicy peach finish.', 'Pairs wonderfully with soft cheeses or grilled vegetables.', 12.0, 355, 5.0, 18, 6, 160);
";

if (mysqli_query($link, $sql_insert)) {
    echo "Data inserted into 'beers' table successfully.<br>";
} else {
    echo "ERROR: Could not execute $sql_insert. " . mysqli_error($link) . "<br>";
}

// Close connection
mysqli_close($link);

?>