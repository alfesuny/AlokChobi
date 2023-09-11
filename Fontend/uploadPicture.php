<?php

    session_start();


    // Function to generate a random 50-digit hexadecimal number
    function generateRandomHex() {
        return bin2hex(random_bytes(25)); // 50 characters (2 characters per byte)
    }

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


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["user_picture"])) {
        $file = $_FILES["user_picture"];
    
        // Check for file errors
        if ($file["error"] !== UPLOAD_ERR_OK) {
            echo "Error uploading file. Please try again.";
        } else {
            $originalFilename = basename($file["name"]);
            $uniqueFilename = generateRandomHex() . "." . pathinfo($originalFilename, PATHINFO_EXTENSION);
            $uploadPath = "../picture/" . $uniqueFilename;
    
            // Check if the generated filename is already in the database
            $query = "SELECT * FROM image_info WHERE image_name = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "s", $uniqueFilename);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
    
            while (mysqli_stmt_num_rows($stmt) > 0) {
                // Regenerate the unique filename until it's truly unique
                $uniqueFilename = generateRandomHex() . "." . pathinfo($originalFilename, PATHINFO_EXTENSION);
                $uploadPath = "../picture/" . $uniqueFilename;
    
                // Re-check if the new filename is in the database
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
            }
    
            // Insert information into the database using a prepared statement
            $userEmail = $_SESSION['email'];
            $timestamp = date("Y-m-d H:i:s");
            $imageDescription = $_POST['user_description'];
    
            $insertQuery = "INSERT INTO image_info (uploaded_by, image_name, upload_time, image_description) 
                            VALUES (?, ?, ?, ?)";
    
            $stmt = mysqli_prepare($conn, $insertQuery);
            mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $uniqueFilename, $timestamp, $imageDescription);
    
            // Move the uploaded file to the destination directory
            if (move_uploaded_file($file["tmp_name"], $uploadPath) && mysqli_stmt_execute($stmt)) {
                echo "File uploaded successfully as $uniqueFilename.";
            } else {
                echo "Error uploading file or inserting data into the database. Please try again.";
            }
            
            // Close the prepared statement
            mysqli_stmt_close($stmt);
        }
    }
    


// Close the database connection
mysqli_close($conn);


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>আলোক ছবি</title>


    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">


    <script src="https://kit.fontawesome.com/ca603e05a0.js" crossorigin="anonymous"></script>


</head>

<body>
    <!--------------------------------------- Navigation Bar ------------------------------------->
    <?php include 'header.php';?>
    <!----------------------------------------- End Nav Bar --------------------------------------->
    <br>

    <!----------------------------------------- hero section -------------------------------------->
    <section class="hero-section_1">
    <div class="content_1">
        <h2>আপলোড করুন <span style="color: #fe8171;"> ছবি </span> </h2>
        <!-- <p>LearnyPy is an online education platform</p><br> -->
    </div>
    <div class="image-container_1">
        <!-- Add a form for picture upload -->
        <form action="uploadPicture.php" method="POST" enctype="multipart/form-data">
            
        <label for="user_picture">আপনার ছবি আপলোড করুন:</label>
            
        <input type="file" name="user_picture" id="user_picture" accept=".jpg, .jpeg, .png" required>
        <textarea id="user_description" name="user_description" placeholder="আপনার ছবির বিবরণ লিখুন" required></textarea>


                    
            <input type="submit" class= 'browse-courses-button_1' value="আপলোড ছবি">
        </form>
        <!-- End of picture upload form -->
    </div>
</section>


    <!--------------------------------------- Feature ----------------------------------->
    <!-- <section class="feature-section_1">
        <h2>Explore Our Categories</h2>
        <div class="row_1">
            <div class="feature-box_1">
                <a href="./category-posts.html">
    
                    <i class="fa-brands fa-free-code-camp"></i>
                    <h3>Programming</h3>
                    <small>7 Courses</small>
                </a>
            </div>
            <div class="feature-box_1">
                <a href="./category-posts.html">
                  
                    <i class="fa-brands fa-html5"></i>
                    <h3>Development</h3>
                    <small>2 Courses</small>
                </a>
            </div>
            <div class="feature-box_1">
                <a href="./category-posts.html">
               
                    <i class="fa-solid fa-atom"></i>
                    <h3>Data Science</h3>
                    <small>4 Courses</small>
                </a>
            </div>
            <div class="feature-box_1">
                <a href="./category-posts.html">
                    
                    <i class="fa-solid fa-camera-retro"></i>
                    <h3>Photography</h3>
                    <small>3 Courses</small>
                </a>
            </div>
        </div>
        <div class="row_1">
            <div class="feature-box_1">
                <a href="./category-posts.html">
                    
                    <i class="fa-solid fa-diagram-project"></i>
                    <h3>Networking</h3>
                    <small>1 Courses</small>
                </a>
            </div>
            <div class="feature-box_1">
                <a href="./category-posts.html">
                    
                    <i class="fa-solid fa-palette"></i>
                    <h3>Art & Design</h3>
                    <small>2 Courses</small>
                </a>
            </div>
            <div class="feature-box_1">
                <a href="./category-posts.html">
                   
                    <i class="fa-brands fa-uikit"></i>
                    <h3>UX/UI Design</h3>
                    <small>4 Courses</small>
                </a>
            </div>
            <div class="feature-box_1">
                <a href="./category-posts.html">
                    
                    <i class="fa-solid fa-sack-dollar"></i>
                    <h3>Finance</h3>
                    <small>1 Courses</small>
                </a>
            </div>
        </div>
    </section>
 -->

    <!--------------------------------------- Start Category ----------------------------------->
    <!-- <section class="category__buttons">
        <div class="container category__buttons-container">
            <a href="./category-posts.html" class="category__button">Programming</a>
            <a href="./category-posts.html" class="category__button">Development</a>
            <a href="./category-posts.html" class="category__button">Data Science</a>
            <a href="./category-posts.html" class="category__button">Photography</a>
            <a href="./category-posts.html" class="category__button">Networking</a>
            <a href="./category-posts.html" class="category__button">Art & Design</a>
            <a href="./category-posts.html" class="category__button">Sale & Marketing</a>
            <a href="./category-posts.html" class="category__button">UX/UI Design</a>
        </div>
    </section> -->
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