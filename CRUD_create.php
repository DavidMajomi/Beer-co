<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$brand_name = $brewer = $origin = $beer_style = $spec_beer_style = $price = $description = $food_pairings = $abv = $ibu = $srm = $calories = $ounces = $milliliters = $image = $stock = "";
$brand_name_err = $brewer_err = $origin_err = $beer_style_err = $spec_beer_style_err = $price_err = $description_err = $food_pairings_err = $abv_err = $ibu_err = $srm_err = $calories_err = $ounces_err = $milliliters_err = $price_err = $image_err = "";
 
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate brand name 
    $input_brand_name = trim($_POST["brand_name"]);
    if (empty($input_brand_name)) {
        $brand_name_err = "Please enter a brand name.";
    } else {
        $brand_name = $input_brand_name;
    }

    // Validate brewer
    $input_brewer = trim($_POST["brewer"]);
    if (empty($input_brewer)) {
        $brewer_err = "Please enter a brewer.";
    } else {
        $brewer = $input_brewer;
    }

    // Validate origin
    $input_origin = trim($_POST["origin"]);
    if (empty($input_origin)) {
        $origin_err = "Please enter an origin.";
    } else {
        $origin = $input_origin;
    }

    // Validate beer style
    $input_beer_style = trim($_POST["beer_style"]);
    if (empty($input_beer_style)) {
        $beer_style_err = "Please enter a beer style.";
    } else {
        $beer_style = $input_beer_style;
    }

    // OPTIONAL
    // Validate spec beer style
    $input_spec_beer_style = trim($_POST["spec_beer_style"]);
    if (empty($input_spec_beer_style)){
        $spec_beer_style = null;
    }
    else {
        $spec_beer_style = $input_spec_beer_style;
    }

    // Validate Price
    $input_price = trim($_POST["price"]);
    // Check if the value is empty or explicitly 0
    if (empty($input_price) || $input_price == '0') {
        // Convert 0 or empty input to NULL
        $price_err = "Please enter a price.";
    } elseif (!is_numeric($input_price)) {
        // Validate if the input is a valid number
        $price_err = "Please enter a valid number for the price.";
    } else {
        // Assign the value to the variable if it's a valid number
        $price = $input_price;
    }

    // Validate description
    $input_description = trim($_POST["description"]);
    if (empty($input_description)) {
        $description_err = "Please enter a description.";
    } else {
        $description = $input_description;
    }

    // Validate food pairings
    $input_food_pairings = trim($_POST["food_pairings"]);
    if (empty($input_food_pairings)) {
        $food_pairings = "";
    } else {
        $food_pairings = $input_food_pairings;
    }

    $input_ounces = trim($_POST["ounces"]);
    if (empty($input_ounces)) {
        $ounces_err = "Please enter the ounces.";
    } elseif (!is_numeric($input_ounces)) {
        $ounces_err = "Please enter a valid number for ounces.";
    } else {
        $ounces = $input_ounces;
    }

    // Validate milliliters
    $input_milliliters = trim($_POST["milliliters"]);

    // Check if the value is empty or explicitly 0
    if (empty($input_milliliters) || $input_milliliters == '0') {
        // Convert 0 or empty input to NULL
        $milliliters = null;
    } elseif (!is_numeric($input_milliliters)) {
        // Validate if the input is a valid number
        $milliliters_err = "Please enter a valid number for milliliters.";
    } else {
        // Assign the value to the variable if it's a valid number
        $milliliters = $input_milliliters;
    }

    // Validate ABV
    $input_abv = trim($_POST["abv"]);
    if (empty($input_abv)) {
        $abv_err = "Please enter the ABV.";
    } elseif (!is_numeric($input_abv)) {
        $abv_err = "Please enter a valid ABV value.";
    } else {
        $abv = $input_abv;
    }

    // Validate IBU
    $input_ibu = trim($_POST["ibu"]);
    // Check if the value is empty or explicitly 0
    if (empty($input_ibu) || $input_ibu == '0') {
        // Convert 0 or empty input to NULL
        $ibu = null;
    } elseif (!is_numeric($input_ibu)) {
        // Validate if the input is a valid number
        $ibu_err = "Please enter a valid number for IBU.";
    } else {
        // Assign the value to the variable if it's a valid number
        $ibu = $input_ibu;
    }

    // Validate SRM
    $input_srm = trim($_POST["srm"]);
    // Check if the value is empty
    if (empty($input_srm)) {
        // Convert 0 or empty input to NULL
        $srm = null;
    } elseif (!is_numeric($input_srm)) {
        // Validate if the input is a valid number
        $srm_err = "Please enter a valid number for SRM.";
    } else {
        // Assign the value to the variable if it's a valid number
        $srm = $input_srm;
    }

    // Validate calories
    $input_calories = trim($_POST["calories"]);
    if(empty($input_calories)){
        $calories_err = "Please enter the calories.";
    } elseif(is_numeric($input_calories)){
        $calories = $input_calories;
    } else{
        $calories_err = "Please enter a valid number for calories.";
    }

    // OPTIONAL
    // Validate spec beer style

    // If blank
    $input_image = isset($_POST["image"]) ? trim($_POST["image"]) : '';

    if (empty($input_image)) {
        $image = 'placeholder.png';
    } else {
        $image = $input_image;
    }

    // Validate stock
    if (isset($_POST["stock"])) {
        $stock = 1;  // If checkbox is checked, set stock to 1
    } else {
        $stock = 0;  // If checkbox is not checked, set stock to 0
    }

    
    // Check input errors before inserting in database
    if (empty($brand_name_err) && empty($price_err) && empty($brewer_err) && empty($origin_err) && empty($beer_style_err) && empty($spec_beer_style_err) && empty($description_err) && empty($food_pairings_err) && empty($abv_err) && empty($ibu_err) && empty($srm_err) && empty($calories_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO beers (brand_name, brewer, origin, beer_style, spec_beer_style, price, description, food_pairings, abv, ibu, srm, calories, ounces, milliliters, image, stock) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssdsssiiiiisi", $param_brand_name, $param_brewer, $param_origin, $param_beer_style, $param_spec_beer_style, $param_price, $param_description, $param_food_pairings, $param_abv, $param_ibu, $param_srm, $param_calories, $param_ounces, $param_milliliters, $param_image, $param_stock);
            
            // Set parameters
            $param_ounces = $ounces;
            $param_milliliters = $milliliters;
            $param_brand_name = $brand_name;
            $param_brewer = $brewer;
            $param_origin = $origin;
            $param_beer_style = $beer_style;
            $param_spec_beer_style = $spec_beer_style;
            $param_price = $price;
            $param_description = $description;
            $param_food_pairings = $food_pairings;
            $param_abv = $abv;
            $param_ibu = $ibu;
            $param_srm = $srm;
            $param_calories = $calories;
            $param_image = $image;
            $param_stock = $stock;
            
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Record created successfully. Redirect to landing page
                // Set a success message
                $_SESSION['success_message'] = "Creation successful!";
                header("location: admin_index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Beer Record</title>
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
                    <h2 class="mt-5">Create Beer Record</h2>
                    <p>Please fill this form and submit to add beer record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Brand Name</label>
                            <input type="text" name="brand_name" class="form-control <?php echo (!empty($brand_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $brand_name; ?>">
                            <span class="invalid-feedback"><?php echo $brand_name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Brewer</label>
                            <input type="text" name="brewer" class="form-control <?php echo (!empty($brewer_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $brewer; ?>">
                            <span class="invalid-feedback"><?php echo $brewer_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Origin</label>
                            <input type="text" name="origin" class="form-control <?php echo (!empty($origin_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $origin; ?>">
                            <span class="invalid-feedback"><?php echo $origin_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Beer Style</label>
                            <input type="text" name="beer_style" class="form-control <?php echo (!empty($beer_style_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $beer_style; ?>">
                            <span class="invalid-feedback"><?php echo $beer_style_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Spec Beer Style (Optional)</label>
                            <input type="text" name="spec_beer_style" class="form-control <?php echo (!empty($spec_beer_style_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $spec_beer_style; ?>">
                            <span class="invalid-feedback"><?php echo $spec_beer_style_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $price; ?>">
                            <span class="invalid-feedback"><?php echo $price_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>
                            <span class="invalid-feedback"><?php echo $description_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Food Pairings (Optional)</label>
                            <textarea name="food_pairings" class="form-control <?php echo (!empty($food_pairings_err)) ? 'is-invalid' : ''; ?>"><?php echo $food_pairings; ?></textarea>
                            <span class="invalid-feedback"><?php echo $food_pairings_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Ounces</label>
                            <input type="text" name="ounces" class="form-control <?php echo (!empty($ounces_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ounces; ?>">
                            <span class="invalid-feedback"><?php echo $ounces_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Milliliters (optional)</label>
                            <input type="text" name="milliliters" class="form-control <?php echo (!empty($milliliters_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $milliliters; ?>">
                            <span class="invalid-feedback"><?php echo $milliliters_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>ABV</label>
                            <input type="text" name="abv" class="form-control <?php echo (!empty($abv_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $abv; ?>">
                            <span class="invalid-feedback"><?php echo $abv_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>IBU (optional)</label>
                            <input type="text" name="ibu" class="form-control <?php echo (!empty($ibu_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ibu; ?>">
                            <span class="invalid-feedback"><?php echo $ibu_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>SRM (optional)</label>
                            <input type="text" name="srm" class="form-control <?php echo (!empty($srm_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $srm; ?>">
                            <span class="invalid-feedback"><?php echo $srm_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Calories</label>
                            <input type="text" name="calories" class="form-control <?php echo (!empty($calories_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $calories; ?>">
                            <span class="invalid-feedback"><?php echo $calories_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Image Name (include extension) (optional)</label>
                            <input type="text" name="image" class="form-control <?php echo (!empty($image_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $image; ?>">
                            <span class="invalid-feedback"><?php echo $image_err;?></span>
                        </div>
                        <div class="form-group" style="margin-bottom: 40px;">
                            <label class="form-check-label" for="stock">In Stock</label>
                            <div class="form-check">
                                <input type="checkbox" id="stock" name="stock" value="1" class="form-check-input <?php echo (!empty($stock_err)) ? 'is-invalid' : ''; ?>" <?php echo ($stock == 1) ? 'checked' : ''; ?>>
                                <span class="invalid-feedback"><?php echo $stock_err;?></span>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="admin_index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>