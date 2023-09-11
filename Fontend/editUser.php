<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webprogramming"; // Replace with your actual database name

    // Create a MySQLi connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get user input from the form
    $email = $_POST["email"]; // Assuming email is the primary key
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $gender = $_POST["gender"];

    // Update user information in the database
    $updateQuery = "UPDATE user_info SET first_name = '$first_name', last_name = '$last_name', gender = '$gender' WHERE email = '$email'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "User information updated successfully.";
    } else {
        echo "Error updating user information: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
    header("Location: ./dashboard.php");
    exit();
}
?>
