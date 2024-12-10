<?php
// Check existence of brand_name parameter before processing further
if (isset($_GET["brand_name"]) && !empty(trim($_GET["brand_name"]))) {
    // Include config file
    require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM beers WHERE brand_name = ?"; // Change condition to use brand_name instead of id

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_brand_name); // Use "s" for string binding

        // Set parameters
        $param_brand_name = trim($_GET["brand_name"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                // Fetch result row as an associative array. Since the result set
                // contains only one row, we don't need to use a while loop.
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Retrieve individual field values
                $brand_name = $row["brand_name"];
                $brewer = $row["brewer"];
                $origin = $row["origin"];
                $beer_style = $row["beer_style"];
                $spec_beer_style = $row["spec_beer_style"];
                $description = $row["description"];
                $food_pairings = $row["food_pairings"];
                $abv = $row["abv"];
                $ibu = $row["ibu"];
                $srm = $row["srm"];
                $calories = $row["calories"];
                $ounces = $row["ounces"];
                $milliliters = $row["milliliters"];
                $image = $row["image"];
                $stock = $row["stock"];
            } else {
                // URL doesn't contain a valid brand_name parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
} else {
    // URL doesn't contain brand_name parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Beer Record</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container-fluid {
            margin-top: 50px;
        }
        .header-title {
            font-size: 2.5rem;
            color: #28a745;
            margin-bottom: 40px;
            text-align: center;
            font-weight: 700;
        }
        .beer-details {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-group label {
            font-weight: bold;
            font-size: 1.1rem;
            color: #333;
        }
        .form-group p {
            font-size: 1.2rem;
            color: #555;
            margin-top: 5px;
        }
        .image-container {
            padding-top: 20px;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
            width: 100%;
            max-width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        /* Image styling */
        .image-container img {
            max-width: 100%;
            height: auto;
            border: 3px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .back-btn {
            background-color: #28a745;
            color: white;
            padding: 12px 25px;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            font-size: 1.1rem;
            transition: background-color 0.3s;
            margin-top: 20px;
            display: block;
            width: 150px;
            margin-left: auto;
            margin-right: auto;
        }
        .back-btn:hover {
            background-color: #218838;
        }
        .row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .col-md-4, .col-md-8 {
            padding: 0 15px;
        }
        .col-md-4 {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .details-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-top: 20px;
        }
        .details-box {
            flex: 1;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 10px;
        }
        .details-box label {
            font-weight: bold;
            font-size: 1.1rem;
            color: #333;
        }
        .details-box p {
            font-size: 1.2rem;
            color: #555;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <h1 class="header-title"><p><b><?php echo isset($brand_name) ? $brand_name : 'N/A'; ?></b></p></h1>
        <div class="row">
            <div class="col-md-4">
                <div class="image-container">
                    <?php if (isset($image) && !empty($image)) : ?>
                        <img src="images/<?php echo $image; ?>" alt="Beer Image">
                    <?php else: ?>
                        <p><b>No Image Available</b></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-8 details-container">
                <div class="details-box">
                    <div class="form-group">
                        <label>Brewer</label>
                        <p><b><?php echo isset($brewer) ? $brewer : 'N/A'; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Origin</label>
                        <p><b><?php echo isset($origin) ? $origin : 'N/A'; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Beer Style</label>
                        <p><b><?php echo isset($beer_style) ? $beer_style : 'N/A'; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Specific Beer Style</label>
                        <p><b><?php echo isset($spec_beer_style) ? $spec_beer_style : 'N/A'; ?></b></p>
                    </div>
                </div>
                <div class="details-box">
                    <div class="form-group">
                        <label>Description</label>
                        <p><b><?php echo isset($description) ? $description : 'N/A'; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Food Pairings</label>
                        <p><b><?php echo isset($food_pairings) ? $food_pairings : 'N/A'; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>ABV</label>
                        <p><b><?php echo isset($abv) ? $abv : 'N/A'; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>IBU</label>
                        <p><b><?php echo isset($ibu) ? $ibu : 'N/A'; ?></b></p>
                    </div>
                </div>
                <div class="details-box">
                    <div class="form-group">
                        <label>SRM</label>
                        <p><b><?php echo isset($srm) ? $srm : 'N/A'; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Ounces</label>
                        <p><b><?php echo isset($ounces) ? $ounces : 'N/A'; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Milliliters</label>
                        <p><b><?php echo isset($milliliters) ? $milliliters : 'N/A'; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Calories</label>
                        <p><b><?php echo isset($calories) ? $calories : 'N/A'; ?></b></p>
                    </div>
                </div>
            </div>
        </div>
        <a href="javascript:void(0);" class="back-btn" onclick="window.history.back();">Back</a>
    </div>
</body>
</html>