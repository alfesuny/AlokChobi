<?php
    session_start(); // Start a session
    if(isset($_SESSION['user_type']) ){
        header("Location: ./index.php");
        exit();
    }

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = ""; // No password
    $dbname = "webprogramming"; // Your database name

    // Create a MySQLi connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get user input from the form
    $email = $_POST["email"];
    $password = hash("sha256", $_POST["password"]); // Hash the entered password using SHA-256

    // Query to check if the email and hashed password match
    $sql = "SELECT email, password FROM user_info WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Email and password match, log in the user
        $row = mysqli_fetch_assoc($result);
        
        // Set user type and email in session
        $_SESSION['user_type'] = 'user';
        $_SESSION['email'] = $row['email'];

        // Redirect to a logged-in user page or display a success message
        header("Location: index.php"); // Change "logged_in.php" to your actual logged-in page
        exit();
    } else {
        echo "Invalid email or password. Please try again.";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>আলোক ছবি</title>

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="../style/style.css">

    <!-- IconScout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- Google Font Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ca603e05a0.js" crossorigin="anonymous"></script>
</head>
<body>
    <!--------------------------------------- Navigation Bar ------------------------------------->
    <?php include 'header.php';?>
    <!----------------------------------------- End Nav Bar --------------------------------------->
    <br>

    <section class="form__section">
        <div class="container form__section-container">
            <h2>প্রবেশ করুন</h2>
                <form action="signin.php" method="POST">
                    <input type="text" placeholder="ইমেইল" name='email'>
                    <input type="password" placeholder="পাসওয়ার্ড" name='password'>
                    
                <!-- Div ta shorai dilei hobe buttons will be verticle -->
                <div class="button-container">
                        <button class="btn" type="submit">প্রবেশ করুন</button>
                        <button class="btn danger"> <a href='./admin.php'>অ্যাডমিন লগইন</a> </button> 
                </div>
                
                <small>আপনার অ্যাকাউন্ট নেই? <a href="./signup.php">নিবন্ধন করুন</a></small>
            </form>
        </div>
    </section>
</body>

</html>


