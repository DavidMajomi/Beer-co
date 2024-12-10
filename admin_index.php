<?php
// Start the session
session_start();

// Check if the user is logged in and if the logout button is clicked
if (isset($_POST['logout'])) {
    // Destroy the session to log out the user
    session_destroy();
    // Redirect to example.php (or any page you want)
    header("Location: idle.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper {
            width: 600px;
            margin-left: 50px;
        }
        table tr td:last-child {
            width: 120px;
        }
        /* Position the logout button in the top-right corner */
        .logout-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #d32f2f;
        }

        .back-arrow {
            position: fixed;
            bottom: 20px; /* Position towards the bottom left */
            left: 20px;   /* Position it to the left of the screen */
            font-size: 40px; /* Ensure the icon is big enough */
            cursor: pointer;
        }

        .back-arrow:hover {
            color: #4CAF50;
            text-decoration: underline;
        }

    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <!-- Logout Button -->
    <form method="POST" action="">
        <button class="logout-btn" type="submit" name="logout">Logout</button>
    </form>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Beer Details</h2>
                        <a href="CRUD_create.php" class="btn btn-success" style="margin-left: 10px;">
                            <i class="fa fa-plus"></i> Add New Beer
                        </a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    $sql = "SELECT * FROM beers";
                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Brand Name</th>";
                                        echo "<th>Brewer</th>";
                                        echo "<th>Origin</th>";
                                        echo "<th>Beer Style</th>";
                                        echo "<th>Spec Beer Style</th>";
                                        echo "<th>Price</th>";
                                        echo "<th>Description</th>";
                                        echo "<th>Food Pairings</th>";
                                        echo "<th>Ounces</th>";
                                        echo "<th>Milliliters</th>";
                                        echo "<th>ABV</th>";
                                        echo "<th>IBU</th>";
                                        echo "<th>SRM</th>";
                                        echo "<th>Calories</th>";
                                        echo "<th>Image Name</th>";
                                        echo "<th>Stocked?</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['brand_name'] . "</td>";
                                        echo "<td>" . $row['brewer'] . "</td>";
                                        echo "<td>" . $row['origin'] . "</td>";
                                        echo "<td>" . $row['beer_style'] . "</td>";
                                        echo "<td>" . $row['spec_beer_style'] . "</td>";
                                        echo "<td>$" . $row['price'] . "</td>";
                                        echo "<td>" . $row['description'] . "</td>";
                                        echo "<td>" . $row['food_pairings'] . "</td>";
                                        echo "<td>" . $row['ounces'] . "</td>";
                                        echo "<td>" . $row['milliliters'] . "</td>";
                                        echo "<td>" . $row['abv'] . "</td>";
                                        echo "<td>" . $row['ibu'] . "</td>";
                                        echo "<td>" . $row['srm'] . "</td>";
                                        echo "<td>" . $row['calories'] . "</td>";
                                        echo "<td>" . $row['image'] . "</td>";
                                        echo "<td><img src='" . ($row['stock'] == 1 ? 'images/yes.png' : 'images/no.png') . "' alt='" . ($row['stock'] == 1 ? 'Yes' : 'No') . "' style='width: 20px; height: 20px;'></td>";
                                        echo "<td>";
                                            echo '<a href="CRUD_read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="CRUD_update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="CRUD_delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else {
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>

    <!-- Back Arrow -->
    <div class="back-arrow" onclick="window.location.href='admin_settings.php';">
        <i class="fa fa-arrow-left"></i>
    </div>
</body>
</html>