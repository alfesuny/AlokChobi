<?php
session_start(); // Start the session

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webprogramming";

// Create a MySQLi connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get image_id and image_name from POST data
        $image_id = $_POST["image_id"];
        $image_name = $_POST["image_name"];

        // Delete the image from the "image_info" table
        $deleteQuery = "DELETE FROM image_info WHERE id = '$image_id'";
        
        if (mysqli_query($conn, $deleteQuery)) {
            // Successfully deleted from the database, now delete the image file
            $imageFilePath = "../picture/$image_name";
            
            if (file_exists($imageFilePath) && unlink($imageFilePath)) {
                echo "Image and data deleted successfully.";
            } else {
                echo "Error deleting the image file.";
            }
        } else {
            echo "Error deleting data from the database.";
        }
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit;
    }

// Close the database connection
mysqli_close($conn);
?>
