<?php
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

// Check if the request contains data
$request_data = file_get_contents('php://input');
if (!empty($request_data)) {
    // Decode the JSON data
    $data = json_decode($request_data);

    // Check if userEmail and imageId are set
    if (isset($data->userEmail) && isset($data->imageId)) {
        $userEmail = $data->userEmail;
        $imageId = $data->imageId;

        // Insert data into the "liked_info" table (you'll need to adjust this query accordingly)
        $insertQuery = "INSERT INTO like_info (liked_by, picture_id) VALUES ('$userEmail', '$imageId')";

        if (mysqli_query($conn, $insertQuery)) {
            // Return a success response (you can customize this response)
            echo json_encode(array("message" => "Image liked successfully"));
        } else {
            // Return an error response if the query fails
            echo json_encode(array("error" => "Error inserting data"));
        }
    } else {
        // Return an error response if userEmail or imageId is missing
        echo json_encode(array("error" => "userEmail and imageId are required"));
    }
} else {
    // Return an error response if the request is empty
    echo json_encode(array("error" => "Empty request data"));
}

// Close the database connection
mysqli_close($conn);
?>
