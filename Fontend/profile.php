<?php

    session_start();



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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ca603e05a0.js" crossorigin="anonymous"></script>
</head>

<body>
    <!--------------------------------------- Navigation Bar ------------------------------------->
    
    <?php include 'header.php';?>

    <!----------------------------------------- End Nav Bar --------------------------------------->
    <br>
    <!----------------------------------------- Start Single Instructor Body --------------------------------------->
    
    <?php
        

            // Check if the user_type session variable is not set
            if (!isset($_SESSION['user_type'])) {
                // Redirect to the login page if user_type is not set
                header("Location: ./signin.php"); // Replace 'login.php' with your actual login page URL
                exit(); // Ensure the script stops executing
            }

            // Check if user_type is "user"
            if ($_SESSION['user_type'] === 'user') {
                // Get user's email from the session
                $userEmail = $_SESSION['email']; // Assuming you store the user's email in the session

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

                // Query to fetch user information from the database
                $query = "SELECT first_name, last_name, gender, date_of_birth, profile_picture FROM user_info WHERE email='$userEmail'";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    // Fetch user data
                    $row = mysqli_fetch_assoc($result);
                    $firstName = $row['first_name'];
                    $lastName = $row['last_name'];
                    $gender = $row['gender'];
                    $dateOfBirth = $row['date_of_birth'];
                    $profilePictureName = $row['profile_picture'];

                    // Display user's information
                    echo '<section class="singlepost">
                            <div class="container singleInstructor__container">
                                <div>
                                    <h2>স্বাগত ! ' . $firstName . ' ' . $lastName . '</h2><br>
                                    
                                </div>

                                <div class="singInstructor__thumbnail">
                                    <img style="border-radius: 50%; width: 8cm " class="singlepost__thumbnail_img" src="../profile_pic/user/' . $profilePictureName . '" alt="">
                                </div>

                                <table class="table custom-table" style="border:1px solid white; font-size:30px ; font-family: fangsong">
                                    <tr>
                                        <td> উপাধি : </td>
                                        <td>' . $_SESSION['user_type'] . '</td>
                                    </tr>
                                    <tr>
                                        <td> নাম: </td>
                                        <td>' . $firstName . ' ' . $lastName . '</td>
                                        
                                    </tr>

                                    <tr>

                                        <td> লিঙ্গ : </td>
                                        <td>' .$gender. '</td>

                                    </tr>
                                    <tr>

                                        <td> জন্ম তারিখ : </td>
                                        <td>' .$dateOfBirth. '</td>

                                    </tr>
                                </table>
                            </div>
                        </section>';
                } else {
                    // Handle the case where user information is not found in the database
                }

                // Close the database connection
                mysqli_close($conn);
            } else {
                // Handle cases where user_type is not "user" (e.g., for other user types)
                // You can add additional logic or redirect the user to an appropriate page
            }
            ?>




    <!--------------------------------------- End Single Instructor Body ----------------------------------->

    <!--------------------------------------- Start Category ----------------------------------->

    <!--------------------------------------- End Category ----------------------------------->

    <!--------------------------------------- Start Footer ----------------------------------->
    <footer>
        <div class="footer__socials">
            <a href="https://www.linkedin.com/in/fahad-bd/" target="_blank"><i class="uil uil-linkedin"></i></a>
            <a href="https://www.youtube.com/" target="_blank"><i class="uil uil-youtube"></i></a>
            <a href="https://www.facebook.com/fahadahammedbd" target="_blank"><i class="uil uil-facebook"></i></a>
            <a href="https://twitter.com/fahadbd01" target="_blank"><i class="uil uil-twitter"></i></a>
            <a href="https://www.instagram.com/fahadahammedbd/" target="_blank"><i
                    class="uil uil-instagram-alt"></i></a>
        </div>
        <div class="container footer__container">
            <article style="margin-right: 50px;">
                <img src="../images/logo.png" alt="">
                <small>আমাদের ইমেজ শেয়ারিং প্ল্যাটফর্মে স্বাগতম, যেখানে সৃজনশীলতার কোন সীমা নেই। আপনার কল্পনা প্রকাশ করুন 
                    এবং আমাদের প্রাণবন্ত ইমেজ শেয়ারিং সম্প্রদায়ের লেন্সের মাধ্যমে বিশ্বকে অন্বেষণ করুন</small>
                
            </article>

            <article>
                <h4>গুরুত্বপূর্ণ লিঙ্ক</h4>
                <ul>
                    <li><a href="./index.php">হোম</a></li>
                    <li><a href="./signin.php">সাইনইন</a></li>
                </ul>
            </article>

            <article>
                <h4>পার্মালিঙ্ক</h4>
                <ul>
                    <li><a href="./index.php">হোম</a></li>
                    <li><a href="https://www.ewubd.edu/">ইস্ট ওয়েস্ট বিশ্ববিদ্যালয়</a></li>
                    <li><a href="https://bangladesh.gov.bd/index.php">বাংলাদেশ সরকার</a></li>
                    <li><a href="https://moedu.gov.bd/">শিক্ষা মন্ত্রণালয়</a></li>
                    <li><a href="https://www.police.gov.bd/">পুলিশ</a></li>
                </ul>
            </article>

        </div>
        <div class="footer__copyright">
            <small>Copyright &copy; 2024 <span style="color: orange;">আলোক </span>ছবি</small>
        </div>
    </footer>
    <!--------------------------------------- End Footer ----------------------------------->


    <!-------------------------------------- Custom Js File -------------------------------------->
    <script src="js/main.js"></script>

    <!-------------------------------------- Font Awesome ---------------------------------------->
    <script src="https://kit.fontawesome.com/924def979f.js" crossorigin="anonymous"></script>

</body>

</html>