<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$brand_name = $brewer = $origin = $beer_style = $spec_beer_style = $price = $description = $food_pairings = $ounces = $milliliters = $abv = $ibu = $srm = $calories = $image = $stock = "";
$brand_name_err = $brewer_err = $origin_err = $beer_style_err = $spec_beer_style_err = $price_err = $description_err = $food_pairings_err = $ounces_err = $milliliters_err = $abv_err = $ibu_err = $srm_err = $calories_err = $image_err = $stock_err = "";

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate brand_name
    $input_brand_name = trim($_POST["brand_name"]);
    if(empty($input_brand_name)){
        $brand_name_err = "Please enter a brand name.";
    } else{
        $brand_name = $input_brand_name;
    }

    // Validate brewer
    $input_brewer = trim($_POST["brewer"]);
    if(empty($input_brewer)){
        $brewer_err = "Please enter the brewer.";
    } else{
        $brewer = $input_brewer;
    }

    // Validate origin
    $input_origin = trim($_POST["origin"]);
    if(empty($input_origin)){
        $origin_err = "Please enter the origin.";
    } else{
        $origin = $input_origin;
    }

    // Validate beer_style
    $input_beer_style = trim($_POST["beer_style"]);
    if(empty($input_beer_style)){
        $beer_style_err = "Please enter the beer style.";
    } else{
        $beer_style = $input_beer_style;
    }

    // Validate spec_beer_style
    $input_spec_beer_style = trim($_POST["spec_beer_style"]);
    if(!empty($input_spec_beer_style)){
        $spec_beer_style = $input_spec_beer_style;
    }

    // Validate price
    $input_price = trim($_POST["price"]);
    if(empty($input_price)){
        $price_err = "Please enter the price.";
    } elseif(!is_numeric($input_price)){
        $price_err = "Please enter a valid price.";
    } else{
        $price = $input_price;
    }

    // Validate description
    $input_description = trim($_POST["description"]);
    if(empty($input_description)){
        $description_err = "Please enter a description.";
    } else{
        $description = $input_description;
    }

    // Validate food_pairings
    $input_food_pairings = trim($_POST["food_pairings"]);
    if(!empty($input_food_pairings)){
        $food_pairings = $input_food_pairings;
    }

    // Validate ounces
    $input_ounces = trim($_POST["ounces"]);
    if(empty($input_ounces)){
        $ounces_err = "Please enter the ounces.";
    } elseif(!is_numeric($input_ounces)){
        $ounces_err = "Please enter a valid number for ounces.";
    } else{
        $ounces = $input_ounces;
    }

    // Validate milliliters
    $input_milliliters = trim($_POST["milliliters"]);
    if(empty($input_milliliters)){
        $milliliters = null;
    } else{
        $milliliters = $input_milliliters;
    }

    // Validate abv
    $input_abv = trim($_POST["abv"]);
    if(empty($input_abv)){
        $abv_err = "Please enter the ABV.";
    } elseif(!is_numeric($input_abv)){
        $abv_err = "Please enter a valid number for ABV.";
    } else{
        $abv = $input_abv;
    }

    // Validate ibu
    $input_ibu = trim($_POST["ibu"]);
    if(empty($input_ibu)){
        $ibu = null;
    } elseif(!is_numeric($input_ibu)){
        $ibu_err = "Please enter a valid number for IBU.";
    } else{
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
    } elseif(!is_numeric($input_calories)){
        $calories_err = "Please enter a valid number for calories.";
    } else{
        $calories = $input_calories;
    }

    // Validate image
    $input_image = trim($_POST["image"]);
    if(empty($input_image)){
        $image = 'placeholder.png';
    } else{
        $image = $input_image;
    }

    // Validate stock
    if (isset($_POST["stock"])) {
        $stock = 1;  // If checkbox is checked, set stock to 1
    } else {
        $stock = 0;  // If checkbox is not checked, set stock to 0
    }

    // Check input errors before updating in database
    if(empty($brand_name_err) && empty($brewer_err) && empty($origin_err) && empty($beer_style_err) && empty($spec_beer_style_err) && empty($price_err) && empty($description_err) && empty($food_pairings_err) && empty($ounces_err) && empty($milliliters_err) && empty($abv_err) && empty($ibu_err) && empty($srm_err) && empty($calories_err) && empty($image_err)){
        // Prepare an update statement
        $sql = "UPDATE beers SET brand_name=?, brewer=?, origin=?, beer_style=?, spec_beer_style=?, price=?, description=?, food_pairings=?, ounces=?, milliliters=?, abv=?, ibu=?, srm=?, calories=?, image=?, stock=? WHERE id=?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssiiisssii", $param_brand_name, $param_brewer, $param_origin, $param_beer_style, $param_spec_beer_style, $param_price, $param_description, $param_food_pairings, $param_ounces, $param_milliliters, $param_abv, $param_ibu, $param_srm, $param_calories, $param_image, $param_stock, $param_id);
            
            // Set parameters
            $param_brand_name = $brand_name;
            $param_brewer = $brewer;
            $param_origin = $origin;
            $param_beer_style = $beer_style;
            $param_spec_beer_style = $spec_beer_style;
            $param_price = $price;
            $param_description = $description;
            $param_food_pairings = $food_pairings;
            $param_ounces = $ounces;
            $param_milliliters = $milliliters;
            $param_abv = $abv;
            $param_ibu = $ibu;
            $param_srm = $srm;
            $param_calories = $calories;
            $param_image = $image;
            $param_id = $id;
            $param_stock = $stock;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to main page
                $_SESSION['success_message'] = "Update successful!";
                header("location: admin_index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM beers WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $brand_name = $row["brand_name"];
                    $brewer = $row["brewer"];
                    $origin = $row["origin"];
                    $beer_style = $row["beer_style"];
                    $spec_beer_style = $row["spec_beer_style"];
                    $price = $row["price"];
                    $description = $row["description"];
                    $food_pairings = $row["food_pairings"];
                    $ounces = $row["ounces"];
                    $milliliters = $row["milliliters"];
                    $abv = $row["abv"];
                    $ibu = $row["ibu"];
                    $srm = $row["srm"];
                    $calories = $row["calories"];
                    $image = $row["image"];
                    $stock = $row["stock"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
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
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Beer Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 800px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Beer Record</h2>
                    <p>Please edit the input values and submit to update the beer record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
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
                            <label>Specific Beer Style</label>
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
                            <label>Food Pairings</label>
                            <input type="text" name="food_pairings" class="form-control <?php echo (!empty($food_pairings_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $food_pairings; ?>">
                            <span class="invalid-feedback"><?php echo $food_pairings_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Ounces</label>
                            <input type="text" name="ounces" class="form-control <?php echo (!empty($ounces_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ounces; ?>">
                            <span class="invalid-feedback"><?php echo $ounces_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Milliliters</label>
                            <input type="text" name="milliliters" class="form-control <?php echo (!empty($milliliters_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $milliliters; ?>">
                            <span class="invalid-feedback"><?php echo $milliliters_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>ABV</label>
                            <input type="text" name="abv" class="form-control <?php echo (!empty($abv_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $abv; ?>">
                            <span class="invalid-feedback"><?php echo $abv_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>IBU</label>
                            <input type="text" name="ibu" class="form-control <?php echo (!empty($ibu_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ibu; ?>">
                            <span class="invalid-feedback"><?php echo $ibu_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>SRM</label>
                            <input type="text" name="srm" class="form-control <?php echo (!empty($srm_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $srm; ?>">
                            <span class="invalid-feedback"><?php echo $srm_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Calories</label>
                            <input type="text" name="calories" class="form-control <?php echo (!empty($calories_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $calories; ?>">
                            <span class="invalid-feedback"><?php echo $calories_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Image Name</label>
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
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="admin_index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
