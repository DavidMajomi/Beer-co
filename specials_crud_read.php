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
                $image = $row["image"];
                $promotion_price = $row["promotion_price"];
                $promotion_start_date = $row["promotion_start_date"];
                $promotion_end_date = $row["promotion_end_date"];
                $stock = $row["special"];
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
                    <h1 class="mt-5 mb-3">Promotion Details</h1>
                    <div class="form-group">
                        <label>Brand Name</label>
                        <p><b><?php echo $brand_name; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Brewer</label>
                        <p><b><?php echo $brewer; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Promotion price</label>
                        <p><b><?php echo $promotion_price; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Promotion Start Date</label>
                        <p><b><?php echo $promotion_start_date; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Promotion End Date</label>
                        <p><b><?php echo $promotion_end_date; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Is on Promotion</label>
                        <p><b><?php echo "<td><img src='" . ($row['special'] == 1 ? 'images/yes.png' : 'images/no.png') . "' alt='" . ($row['special'] == 1 ? 'Yes' : 'No') . "' style='width: 20px; height: 20px;'></td>"; ?></b></p>
                    </div>
                    <p><a href="edit_specials.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>


