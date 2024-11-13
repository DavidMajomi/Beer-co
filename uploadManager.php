<?php
$timestamp = date('Ymd'); // Get the current timestamp in the format 'YYYYMMDD'
$name = "BeerData_" . $timestamp; // Concatenate the string with the timestamp

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file was uploaded without errors, using the dynamic 'name' attribute
    if (isset($_FILES[$name]) && $_FILES[$name]["error"] == 0) {
        // Allowed file types and MIME types
        $allowedExtensions = array("csv" => "csv");
        $allowedMimeTypes = array("csv" => "text/csv"); // Allow only CSV files with MIME type "text/csv"
        
        $filename = $_FILES[$name]["name"]; // Get the uploaded file name
        $filetype = $_FILES[$name]["type"]; // Get the MIME type of the file
        $filesize = $_FILES[$name]["size"]; // Get the file size in bytes

        // Verify file extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); // Get file extension and make it lowercase
        if (!array_key_exists($ext, $allowedExtensions)) {
            die("Error: Invalid file format. Only CSV files are allowed.");
        }

        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024; // 5MB limit
        if ($filesize > $maxsize) {
            die("Error: File size is larger than the allowed limit.");
        }

        // Verify MIME type of the file
        if ($filetype !== $allowedMimeTypes[$ext]) {
            die("Error: Invalid MIME type.");
        }

        // Create a new filename with the format Beer_{TIMESTAMP}.csv
        $newFilename = "Beer_" . $timestamp . ".csv"; // E.g., Beer_20241112.csv

        // Sanitize the file name to avoid special characters
        $sanitizedFilename = preg_replace("/[^a-zA-Z0-9\-\_\.]/", "_", $newFilename);

        // Set the target directory
        $targetDir = "upload/";

        // Check whether the file already exists before uploading it
        if (file_exists($targetDir . $sanitizedFilename)) {
            echo $sanitizedFilename . " already exists.";
        } else {
            // Move the uploaded file to the desired directory with the new name
            if (move_uploaded_file($_FILES[$name]["tmp_name"], $targetDir . $sanitizedFilename)) {
                echo "Your file was uploaded successfully as $sanitizedFilename.";
            } else {
                echo "Error: There was a problem moving the uploaded file.";
            }
        }
    } else {
        echo "Error: " . $_FILES[$name]["error"];
    }
}
?>