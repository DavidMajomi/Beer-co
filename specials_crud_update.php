<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$price = $promotion_price = $promotion_start_date = $promotion_end_date = $special = "";
$price_err = $promotion_price_error = $promotion_start_date_error = $promotion_end_date_error = $special_err = "";

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];

    $input_promotion_price = trim($_POST["promotion_price"]);
    if(empty($input_promotion_price)){
        $promotion_price_error = "Please enter the promotion price.";
    } elseif(!is_numeric($input_promotion_price)){
        $price_err = "Please enter a valid promotion price.";
    } else{
        $promotion_price = $input_promotion_price;
    }

    $input_promotion_start_date = trim($_POST["promotion_start_date"]);
    if(empty($input_promotion_start_date)){
        $promotion_start_date_error = "Please enter a Promotion Start Date.";
    } else{
        $promotion_start_date = $input_promotion_start_date;
    }


    $input_promotion_end_date = trim($_POST["promotion_end_date"]);
    if(empty($input_promotion_end_date)){
        $promotion_end_date_error = "Please enter a Promotion end Date.";
    } else{
        $promotion_end_date = $input_promotion_end_date;
    }


    $start_date = new DateTime($promotion_start_date);
    $end_date = new DateTime($promotion_end_date);


    if ($start_date > $end_date)
    {
        $end_date_before_start_date_error = "Start Date must be before End Date";
    }
    
    // Validate special
    if (isset($_POST["special"])) {
        $special = 1;  // If checkbox is checked, set special to 1
    } else {
        $special = 0;  // If checkbox is not checked, set special to 0
    }

    // Check input errors before updating in database
    if(empty($promotion_price_error) && empty($promotion_start_date_error) && empty($promotion_end_date_error) && empty($end_date_before_start_date_error)){
        // Prepare an update statement
        $sql = "UPDATE beers SET promotion_price=?, promotion_start_date =?, promotion_end_date=?, special=? WHERE id=?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "dssii", $param_promotion_price, $param_promotion_start_date, $param_promotion_end_date, $param_special, $param_id);
            
            // Set parameters
            $param_promotion_price = $promotion_price;
            $param_promotion_start_date = $promotion_start_date;
            $param_promotion_end_date = $promotion_end_date;
            $param_id = $id;
            $param_special = $special;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to main page
                header("location: edit_specials.php");
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
                    $promotion_price = $row["promotion_price"];
                    $promotion_start_date = $row["promotion_start_date"];
                    $promotion_end_date = $row["promotion_end_date"];
                    $special = $row["special"];
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
                            <label>Promotion price</label>
                            <input type="text" name="promotion_price" class="form-control <?php echo (!empty($promotion_price_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $promotion_price; ?>">
                            <span class="invalid-feedback"><?php echo $promotion_price_error;?></span>
                        </div>
                        <div class="form-group">
                            <label>Promotion Start Date</label>
                            <input type="date" name="promotion_start_date" class="form-control <?php echo (!empty($promotion_start_date_error)) ? 'is-invalid' : ''; ?>" value="<?php echo date($promotion_start_date); ?>">
                            <span class="invalid-feedback"><?php echo $promotion_start_date_error;?></span>
                        </div>
                        <div class="form-group">
                            <label>Promotion End Date</label>
                            <input type="date" name="promotion_end_date" class="form-control <?php echo (!empty($promotion_end_date_error)) ? 'is-invalid' : ''; ?>" value="<?php echo ($promotion_end_date); ?>">
                            <span class="invalid-feedback"><?php echo $promotion_end_date_error;?></span>
                            <?php if (!empty($end_date_before_start_date_error)): ?>
                                <div class="invalid-feedback">
                                    <?php echo $end_date_before_start_date_error; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group" style="margin-bottom: 40px;">
                            <label class="form-check-label" for="special">Add to special</label>
                            <div class="form-check">
                                <input type="checkbox" id="special" name="special" value="1" class="form-check-input <?php echo (!empty($special_err)) ? 'is-invalid' : ''; ?>" <?php echo ($special == 1) ? 'checked' : ''; ?>>
                                <span class="invalid-feedback"><?php echo $special_err;?></span>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="edit_specials.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
