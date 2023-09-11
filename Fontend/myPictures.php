<?php
    session_start();
    if(!isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'user'){
        header("Location: ./signin.php");
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ca603e05a0.js" crossorigin="anonymous"></script>
</head>

<body>
    <!--------------------------------------- Navigation Bar ------------------------------------->
   
    <?php include 'header.php';?>

    <!----------------------------------------- End Nav Bar --------------------------------------->
    <br><br>

    <section>
        <div class="container instructor__top">
            <div style="margin-left: 30px;">
                <h2>নিজের ছবি সমুহ</h2>
            </div>
            <div style="margin: 10px;">
                <img class="instructor__top_banar" src="../images/courses_banar.gif" alt="">
            </div>
        </div>
    </section>

    <!-- <section class="posts">
        <div class="courses__full_title">
            <br>
            <h2>Explore Our Courses</h2>
        </div> -->

<!-- 
        <div>
            <div class="courses__category__button">
                <button style="background-color: white; color: black;" class="btn">All Courses</button>
                <button class="btn">Programming</button>
                <button class="btn">Development</button>
                <button class="btn">Data Science</button>
                <button class="btn">Design</button>
                <button class="btn">Photography</button>
                <button class="btn">Networking</button>
                <button class="btn">Marketing</button>
            </div>
        </div>
    </section> -->



    <!--------------------------------------- Start Course ----------------------------------->
    <section class="posts">
        <div class="container courses__container__grid">


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

                $user_email =  $_SESSION['email'];
                // Fetch images and descriptions from the database
                $query = "SELECT * FROM image_info WHERE uploaded_by ='$user_email' ";
                $result = mysqli_query($conn, $query);

                    
                // ... (previous code for database connection and fetching images)

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $image_id = $row["id"]; // Assuming there's an 'id' column in your table
                        $image_name = $row["image_name"];
                        $image_description = $row["image_description"];
                ?>

                <dir>
                    <div class="course__container_in_corses">
                        <div>
                            <!-- Display the image with its name as alt text -->
                            <img class="course__container_in_corses_banar" src="../picture/<?php echo $image_name; ?>" alt="<?php echo $image_name; ?>">
                        </div>
                        <div>
                            <div style="margin-top: 15px;" class="courses__instructor">
                                <div>
                                    <!-- Add a form for the Delete button with hidden input for image_id -->
                                    <form action="deleteImage.php" method="POST">
                                    <input type="hidden" name="image_id" value="<?php echo $image_id; ?>">
                                    <input type="hidden" name="image_name" value="<?php echo $image_name; ?>">
                                        <button class="btn danger" type="submit">মুছে ফেলুন</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <!-- Display the image description -->
                        <p><?php echo $image_description; ?></p>
                    </div>
                </dir>

                <?php
                    }
                } else {
                    echo "No images found in the database.";
                }

                // Close the database connection
                mysqli_close($conn);
                ?>


            
                            



            

   
      


        </div>
    </section>
    <br>

    <!--------------------------------------- End Course --------------------------------------->

    <!--------------------------------------- Feedback from students ----------------------------------->
 
    <br>

    <!--------------------------------------- Start Category ----------------------------------->
    <!-- <section class="category__buttons">
        <div class="container category__buttons-container">
            <a href="" class="category__button">Programming</a>
            <a href="" class="category__button">Development</a>
            <a href="" class="category__button">Data Science</a>
            <a href="" class="category__button">Photography</a>
            <a href="" class="category__button">Networking</a>
            <a href="" class="category__button">Art & Design</a>
            <a href="" class="category__button">Sale & Marketing</a>
            <a href="" class="category__button">UX/UI Design</a>
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