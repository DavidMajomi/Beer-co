<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM beers WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
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
            } else{
                // URL doesn't contain a valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Beer Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Beer Record</h1>
                    <div class="form-group">
                        <label>Brand Name</label>
                        <p><b><?php echo $brand_name; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Brewer</label>
                        <p><b><?php echo $brewer; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Origin</label>
                        <p><b><?php echo $origin; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Beer Style</label>
                        <p><b><?php echo $beer_style; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Specific Beer Style</label>
                        <p><b><?php echo $spec_beer_style; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <p><b><?php echo $description; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Food Pairings</label>
                        <p><b><?php echo $food_pairings; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>ABV</label>
                        <p><b><?php echo $abv; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>IBU</label>
                        <p><b><?php echo $ibu; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>SRM</label>
                        <p><b><?php echo $srm; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Ounces</label>
                        <p><b><?php echo $ounces; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Milliliters</label>
                        <p><b><?php echo $milliliters; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Calories</label>
                        <p><b><?php echo $calories; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Image Name</label>
                        <p><b><?php echo $image; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Stock Status</label>
                        <p><b><?php echo "<td><img src='" . ($row['stock'] == 1 ? 'images/yes.png' : 'images/no.png') . "' alt='" . ($row['stock'] == 1 ? 'Yes' : 'No') . "' style='width: 20px; height: 20px;'></td>"; ?></b></p>
                    </div>
                    <p><a href="admin_index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>


