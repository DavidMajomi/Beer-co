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

// Check if the download button was clicked
// CSV download functionality
$currentDate = date('mdY');
if (isset($_POST['download_csv'])) {
    // Include config file
    require_once "config.php";

    // Fetch data from the database
    $sql = "SELECT * FROM popular_data ORDER BY clicks DESC";
    if ($result = mysqli_query($link, $sql)) {
        // Open a memory stream for the CSV output
        $output = fopen('php://output', 'w');

        // Output the headers for CSV
        fputcsv($output, ['#', 'Clicked Search Term', 'Clicks']);

        // Output the data rows
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($output, [$row['id'], $row['brand_name'], $row['clicks']]);
        }

        // Close the output stream
        fclose($output);

        // Set headers to force download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="popular_data_' . $currentDate . '.csv"');

        // Exit to stop further script execution
        exit;
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
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
    <form method="POST" action="">
    <button type="submit" name="download_csv" class="btn btn-success mb-3">
        <i class="fa fa-download"></i> Download CSV
    </button>
    </form>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Search Details</h2>
                        </a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    $sql = "SELECT * FROM popular_data ORDER BY clicks DESC";
                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Clicked Search Term</th>";
                                        echo "<th>Clicks</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['brand_name'] . "</td>";
                                        echo "<td>" . $row['clicks'] . "</td>";
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