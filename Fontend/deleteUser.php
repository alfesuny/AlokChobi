<?php
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

// Check if the email is provided via POST
if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Prepare the delete user query
    $deleteUserQuery = "DELETE FROM user_info WHERE email = ?";
    
    // Prepare the delete image info query
    $deleteImageInfoQuery = "DELETE FROM image_info WHERE uploaded_by = ?";
    
    // Prepare the delete like info query
    $deleteLikeInfoQuery = "DELETE FROM like_info WHERE liked_by = ?";
    
    // Use prepared statements
    if ($stmt = mysqli_prepare($conn, $deleteUserQuery)) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "s", $email);
        
        // Execute the delete user query
        if (mysqli_stmt_execute($stmt)) {
            echo "User with email '$email' has been deleted successfully.";
        } else {
            echo "Error deleting user: " . mysqli_error($conn);
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing delete user statement: " . mysqli_error($conn);
    }
    
    // Use prepared statements to delete rows from 'image_info'
    if ($stmt = mysqli_prepare($conn, $deleteImageInfoQuery)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        if (mysqli_stmt_execute($stmt)) {
            echo "Deleted user's images from 'image_info'.";
        } else {
            echo "Error deleting user's images from 'image_info': " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing delete image info statement: " . mysqli_error($conn);
    }
    
    // Use prepared statements to delete rows from 'like_info'
    if ($stmt = mysqli_prepare($conn, $deleteLikeInfoQuery)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        if (mysqli_stmt_execute($stmt)) {
            echo "Deleted user's likes from 'like_info'.";
        } else {
            echo "Error deleting user's likes from 'like_info': " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing delete like info statement: " . mysqli_error($conn);
    }
} else {
    echo "Email not provided for deletion.";
}

// Close the database connection
    mysqli_close($conn);
    header("Location: ./dashboard.php"); // Replace 'login.php' with your actual login page URL
    exit()
?>
