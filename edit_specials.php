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
                        <h2 class="pull-left">Edit Specials</h2>
                        <a href="specials_crud_create.php" class="btn btn-success" style="margin-left: 10px;">
                            <i class="fa fa-plus"></i> Add New Special
                        </a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    $sql = "SELECT * FROM beers WHERE special = 1";
                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Brand Name</th>";
                                        echo "<th>Brewer</th>";
                                        echo "<th>Actual Price</th>";
                                        echo "<th>Promotion Price</th>";
                                        echo "<th>Promotion Start Date (MM/DD/YYYY)</th>";
                                        echo "<th>Promotion End Date (MM/DD/YYYY)</th>";           
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['brand_name'] . "</td>";
                                        echo "<td>" . $row['brewer'] . "</td>";
                                        echo "<td>$" . $row['price'] . "</td>";
                                        echo "<td>$" . $row['promotion_price'] . "</td>";
                                        echo "<td>" . $row['promotion_start_date'] . "</td>";
                                        echo "<td>" . $row['promotion_end_date'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="specials_crud_read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="specials_crud_update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="specials_crud_delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
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
</body>
</html>