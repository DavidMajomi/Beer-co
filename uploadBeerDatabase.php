<?php
// Get the current timestamp in the format 'YYYYMMDD'
$timestamp = date('Ymd');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Beer Database</title>
</head>
<body>
    <form action="uploadManager.php" method="post" enctype="multipart/form-data">
        <h2>Upload The Beer CSV Here</h2>
        <label for="fileSelect">Filename:</label>
        <!-- Dynamically set the name attribute to include BeerData_ followed by the timestamp -->
        <input type="file" name="BeerData_<?php echo $timestamp; ?>" id="fileSelect">
        <input type="submit" name="submit" value="Upload">
        <p><strong>Note:</strong> Only .csv format is permitted.</p>
    </form>
</body>
</html>