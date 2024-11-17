<?php
// Include config file
require_once "config.php";

// Processing form data when the form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

    // Collect and validate input values
    $errors = [];
    $brand_name = trim($_POST["brand_name"]);
    $brewer = trim($_POST["brewer"]);
    $origin = trim($_POST["origin"]);
    $beer_style = trim($_POST["beer_style"]);
    $spec_beer_style = trim($_POST["spec_beer_style"]);
    $description = trim($_POST["description"]);
    $food_pairings = trim($_POST["food_pairings"]);
    $ounces = trim($_POST["ounces"]);
    $milliliters = trim($_POST["milliliters"]);
    $abv = trim($_POST["abv"]);
    $ibu = trim($_POST["ibu"]);
    $srm = trim($_POST["srm"]);
    $calories = trim($_POST["calories"]);

    // Add validation logic
    if (empty($brand_name)) $errors['brand_name'] = "Please enter the brand name.";
    if (empty($brewer)) $errors['brewer'] = "Please enter the brewer.";
    if (empty($origin)) $errors['origin'] = "Please enter the origin.";
    if (!is_numeric($ounces) || $ounces <= 0) $errors['ounces'] = "Please enter a valid number for ounces.";
    if (!is_numeric($milliliters) || $milliliters <= 0) $errors['milliliters'] = "Please enter a valid number for milliliters.";
    if (!is_numeric($abv) || $abv < 0) $errors['abv'] = "Please enter a valid ABV.";
    if (!is_numeric($ibu) || $ibu < 0) $errors['ibu'] = "Please enter a valid IBU.";
    if (!is_numeric($srm) || $srm < 0) $errors['srm'] = "Please enter a valid SRM.";
    if (!is_numeric($calories) || $calories < 0) $errors['calories'] = "Please enter a valid calorie count.";

    // Update the database if there are no errors
    if (empty($errors)) {
        $sql = "UPDATE beers SET 
                    brand_name=?, brewer=?, origin=?, beer_style=?, spec_beer_style=?, 
                    description=?, food_pairings=?, ounces=?, milliliters=?, abv=?, 
                    ibu=?, srm=?, calories=? 
                WHERE id=?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param(
                $stmt, 
                "sssssssdddiddi", 
                $brand_name, $brewer, $origin, $beer_style, $spec_beer_style, 
                $description, $food_pairings, $ounces, $milliliters, $abv, 
                $ibu, $srm, $calories, $id
            );

            if (mysqli_stmt_execute($stmt)) {
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
} else if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Retrieve existing data for the given ID
    $id = trim($_GET["id"]);
    $sql = "SELECT * FROM beers WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $brand_name = $row["brand_name"];
                $brewer = $row["brewer"];
                $origin = $row["origin"];
                $beer_style = $row["beer_style"];
                $spec_beer_style = $row["spec_beer_style"];
                $description = $row["description"];
                $food_pairings = $row["food_pairings"];
                $ounces = $row["ounces"];
                $milliliters = $row["milliliters"];
                $abv = $row["abv"];
                $ibu = $row["ibu"];
                $srm = $row["srm"];
                $calories = $row["calories"];
            } else {
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    mysqli_stmt_close($stmt);
} else {
    header("location: error.php");
    exit();
}
mysqli_close($link);
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Beer Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper { width: 600px; margin: 0 auto; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Update Beer Record</h2>
        <p>Please edit the input values and submit to update the beer record.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Brand Name</label>
                <input type="text" name="brand_name" class="form-control" value="<?php echo $brand_name; ?>">
            </div>
            <div class="form-group">
                <label>Brewer</label>
                <input type="text" name="brewer" class="form-control" value="<?php echo $brewer; ?>">
            </div>
            <div class="form-group">
                <label>Origin</label>
                <input type="text" name="origin" class="form-control" value="<?php echo $origin; ?>">
            </div>
            <div class="form-group">
                <label>Beer Style</label>
                <input type="text" name="beer_style" class="form-control" value="<?php echo $beer_style; ?>">
            </div>
            <div class="form-group">
                <label>Specific Beer Style</label>
                <input type="text" name="spec_beer_style" class="form-control" value="<?php echo $spec_beer_style; ?>">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control"><?php echo $description; ?></textarea>
            </div>
            <div class="form-group">
                <label>Food Pairings</label>
                <textarea name="food_pairings" class="form-control"><?php echo $food_pairings; ?></textarea>
            </div>
            <div class="form-group">
                <label>Ounces</label>
                <input type="text" name="ounces" class="form-control" value="<?php echo $ounces; ?>">
            </div>
            <div class="form-group">
                <label>Milliliters</label>
                <input type="text" name="milliliters" class="form-control" value="<?php echo $milliliters; ?>">
            </div>
            <div class="form-group">
                <label>ABV</label>
                <input type="text" name="abv" class="form-control" value="<?php echo $abv; ?>">
            </div>
            <div class="form-group">
                <label>IBU</label>
                <input type="text" name="ibu" class="form-control" value="<?php echo $ibu; ?>">
            </div>
            <div class="form-group">
                <label>SRM</label>
                <input type="text" name="srm" class="form-control" value="<?php echo $srm; ?>">
            </div>
            <div class="form-group">
                <label>Calories</label>
                <input type="text" name="calories" class="form-control" value="<?php echo $calories; ?>">
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>