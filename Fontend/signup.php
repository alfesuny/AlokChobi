<?php
    session_start();

    if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'user'){
        header("Location: ./index.php");
        exit();
    }



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
    $password = hash("sha256", $_POST["password"]); // Hash the password using SHA-256
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $date_of_birth = $_POST["date_of_birth"];
    $gender = $_POST["gender"];


    $checkQuery = "SELECT email FROM user_info WHERE email='$email'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        // Email already exists, display an alert to the user
        echo "User with this email already exists. Please choose a different email.";
    }
    
    else {
     
        $targetDirectory = "../profile_pic/user/";
        
        $profilePictureName = $_FILES["profile_picture"]["name"];
        
        $file_extension = pathinfo($profilePictureName, PATHINFO_EXTENSION);
        
        $upload_name = $email . "_" . $gender . "." . $file_extension;

        $targetFilePath = $targetDirectory . $upload_name;

        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFilePath)) {
            // Insert user data into the database with the actual picture name
            $sql = "INSERT INTO user_info (email, password, first_name, last_name, date_of_birth, gender, profile_picture)
                    VALUES ('$email', '$password', '$first_name', '$last_name', '$date_of_birth', '$gender', '$upload_name')";

            if (mysqli_query($conn, $sql)) {
           
                
                if(!isset($_SESSION['user_type'])){
                    
                    
                    $_SESSION['user_type'] = 'user';
                    $_SESSION['email'] = $email;
                    
                    header("Location: ./profile.php"); // Change "logged_in.php" to your actual logged-in page
                    exit();
                }
            

              
                
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Error uploading profile picture.";
        }
    }


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

        <h1>ব্যবহারকারী নিবন্ধন</h1>
                    

        <form action="signup.php" method="POST" enctype="multipart/form-data">
                <label for="email">ইমেইল:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">পাসওয়ার্ড:</label>
                <input type="password" id="password" name="password" required>

                <label for="first_name">নামের প্রথম অংশ:</label>
                <input type="text" id="first_name" name="first_name" required>

                <label for="last_name">নামের শেষাংশ:</label>
                <input type="text" id="last_name" name="last_name" required>

                <label for="date_of_birth">জন্ম তারিখ:</label>
                <input type="date" id="date_of_birth" name="date_of_birth" required>

                <label for="gender">লিঙ্গ:</label>
                <select id="gender" name="gender" required>
                    <option value="Male">পুরুষ</option>
                    <option value="Female">মহিলা</option>
                    <option value="Other">অন্যান্য</option>
                </select>

                <label for="profile_picture">Profile Picture:</label>
                <input type="file" id="profile_picture" name="profile_picture" required>

                <input type="submit" value="Register">
                
                <small> ইতিমধ্যে একটি সদস্যপদ আছে? <a href="./signin.php">প্রবেশ করুন</a></small>
        </form>



        </div>

    </section>
            
        <script>
            function validateForm() {
                var email = document.getElementById("email").value;
                var password = document.getElementById("password").value;
                var firstName = document.getElementById("first_name").value;
                var lastName = document.getElementById("last_name").value;
                var dateOfBirth = document.getElementById("date_of_birth").value;
                
                // Validate email format (simple example)
                var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                if (!emailPattern.test(email)) {
                    alert("Invalid email address");
                    return false;
                }

                // Validate password (e.g., minimum length)
                if (password.length < 3) {
                    alert("Password must be at least 8 characters long");
                    return false;
                }

                // Validate first name (no digits or special characters)
                var namePattern = /^[a-zA-Z\s]+$/; // Allow only letters and spaces
                if (!namePattern.test(firstName)) {
                    alert("First name should contain only letters and spaces");
                    return false;
                }

                // Validate last name (no digits or special characters)
                if (!namePattern.test(lastName)) {
                    alert("Last name should contain only letters and spaces");
                    return false;
                }

                // Add more validation rules for dateOfBirth and other fields as needed

                return true; // Form is valid and can be submitted
            }
        </script>

</body>

</html>