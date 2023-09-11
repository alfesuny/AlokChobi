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

    <!----------------------------------------- hero section -------------------------------------->
    <section class="hero-section_1">
        <div class="content_1">
            <h2>আপনার চাক্ষুষ  <span style="color: #fe8171;"> গল্প </span> বলাকে <br>  মুক্ত করুন.</h2>
            <p>একটি ছবি শেয়ারিং প্ল্যাটফর্ম</p><br>
            <div class="buttons_1">
                <a href="./signup.php" class="get-started-button_1">যোগদান করুন</a>
                <a href="./courses.html" class="browse-courses-button_1">Browse Courses</a>
            </div>
        </div>
        <div class="image-container_1">
            <img src="../images/banar1.jpg" alt="Image">
        </div>
    </section>


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