<?php
    session_start();
    if(!isset($_SESSION['user_type']) ){
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

    




    <!--------------------------------------- Start Course ----------------------------------->
    
        

        <?php


        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "webprogramming";
        $query = '';

        // Create a MySQLi connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if($_SESSION['user_type'] == 'admin'){
            $query = "SELECT * FROM image_info ";
        }
        elseif($_SESSION['user_type'] == 'user'){


            
            // Your email (replace with your actual email)
            $myEmail = $_SESSION['email'];

            // Function to calculate Jaccard similarity
            function jaccardSimilarity($set1, $set2) {
                $intersection = count(array_intersect($set1, $set2));
                $union = count(array_unique(array_merge($set1, $set2)));
                return $intersection / $union;
            }

            // Retrieve the set of picture_ids liked by you
            $myLikedPictures = [];
            $query = "SELECT picture_id FROM like_info WHERE liked_by = '$myEmail'";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $myLikedPictures[] = $row['picture_id'];
            }

            // Retrieve the set of picture_ids liked by other users (excluding your liked pictures)
            $otherUsersLikedPictures = [];
            $query = "SELECT DISTINCT liked_by FROM like_info WHERE liked_by != '$myEmail'";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $userEmail = $row['liked_by'];
                $query = "SELECT picture_id FROM like_info WHERE liked_by = '$userEmail'";
                $result2 = mysqli_query($conn, $query);
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $otherUsersLikedPictures[$userEmail][] = $row2['picture_id'];
                }
            }

            // Calculate the Jaccard similarity coefficient for each user
            $jaccardValues = [];
            foreach ($otherUsersLikedPictures as $userEmail => $likedPictures) {
                $jaccardValues[$userEmail] = jaccardSimilarity($myLikedPictures, $likedPictures);
            }

            
            echo'<section>';
            echo'  <div class="container instructor__top">';
            echo'       <div style="margin-left: 30px;">';
            echo'           <h2>ছবি অন্বেষণ</h2>  ';
            echo'  </div>     ';
            echo'      <div style="margin: 10px;"> ';
            
            arsort($jaccardValues);
            echo '<table style="height:60% ; text-align:center ; border:1px Solid white">';
            echo "<tr ><th colspan=2> Your Jaccard Similarity Table is</th></tr>";
            echo '<tr><th>User Email</th><th>Similarity</th></tr>';

            // Display sorted UserEmail by similarity descending in an HTML table
            $count = 0; // Initialize a counter

            foreach ($jaccardValues as $userEmail => $similarity) {
                echo '<tr><td>' . $userEmail . '</td><td>' . $similarity . '</td></tr>';
                
                $count++; // Increment the counter
                
                if ($count >= 4) {
                    break; // Exit the loop after 4 rows
                }
            }
            $highestSimilarityUser = key($jaccardValues);
                
            echo "<tr ><td colspan=2> User with the highest Jaccard value: <b> $highestSimilarityUser </b> </th></td>";
            echo '</table>';
                
            echo' </div>
            </section> ';
           


            
         



            $email = $_SESSION['email'];

            $query = "SELECT ii.*
            FROM image_info ii
            WHERE ii.uploaded_by != '$email' AND
            ii.id IN (     
                SELECT li.picture_id
                FROM like_info li
                WHERE li.liked_by = '$highestSimilarityUser'
            )
            AND ii.id NOT IN (
                SELECT picture_id
                FROM like_info
                WHERE liked_by = '$email'
            )";

        }

    ?>


        <section class="posts">
        <div class="container courses__container__grid">
        <?php
        $result = mysqli_query($conn, $query);
            
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $image_name = $row["image_name"];
                $image_description = $row["image_description"];
                $image_id = $row['id'];
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
                                <button class="btn__enrole like-button" type="button" data-image-id="<?php echo $image_id; ?>">লাইক করুন</button>
                                <!-- <button class="btn danger" type="submit">Remove</button> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <!-- Display the image description -->
                    <p><?php echo $image_description; ?><br> <small> <?php echo $highestSimilarityUser; ?> দ্বারা পছন্দ </small></p>
                </div>
            </dir>


        <?php
            }
        }


        $email = $_SESSION['email'];

            $query = "SELECT ii.*
            FROM image_info ii
            WHERE ii.uploaded_by != '$email' 
            AND ii.id NOT IN (
                SELECT picture_id
                FROM like_info
                WHERE liked_by = '$email') 
            AND ii.id NOT IN(
                SELECT ii.id
                FROM image_info ii
                WHERE ii.uploaded_by != '$email' AND
                ii.id IN (     
                    SELECT li.picture_id
                    FROM like_info li
                    WHERE li.liked_by = '$highestSimilarityUser'
                )
                AND ii.id NOT IN (
                    SELECT picture_id
                    FROM like_info
                    WHERE liked_by = '$email'
                )
            )";

            $result = mysqli_query($conn, $query);
                        
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $image_name = $row["image_name"];
                    $image_description = $row["image_description"];
                    $image_id = $row['id'];
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
                                    <button class="btn__enrole like-button" type="button" data-image-id="<?php echo $image_id; ?>">লাইক করুন</button>
                                    <!-- <button class="btn danger" type="submit">Remove</button> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <!-- Display the image description -->
                        <p><?php echo $image_description; ?></small></p>
                    </div>
                </dir>

        <?php
                }
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

    <script>
        // Add an event listener for the "Like" button click
        document.querySelectorAll('.like-button').forEach(button => {
            button.addEventListener('click', () => {
                const imageId = button.getAttribute('data-image-id');
                const userEmail = '<?php echo $_SESSION["email"]; ?>'; // Get the user's email from PHP

                // Create an object containing the data to send
                const data = {
                    imageId: imageId,
                    userEmail: userEmail,
                };

                // Define the URL to send the POST request to (replace with your actual URL)
                const url = 'likeImage.php';

                // Define the request options
                const requestOptions = {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                };

                // Send the POST request using the fetch API
                fetch(url, requestOptions)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json(); // Parse the response if it's in JSON format
                    })
                    .then(data => {
                        // Update the button text to "Liked"
                        button.textContent = 'লাইক করা হয়েছে';
                        button.disabled = true; // Disable the button to prevent multiple likes
                    })
                    .catch(error => {
                        // Handle any errors that occurred during the fetch
                        console.error('There was a problem with the fetch operation:', error);
                    });
            });
        });

    </script>

    <!-------------------------------------- Custom Js File -------------------------------------->
    <script src="js/main.js"></script>

    <!-------------------------------------- Font Awesome ---------------------------------------->
    <script src="https://kit.fontawesome.com/924def979f.js" crossorigin="anonymous"></script>

</body>

</html>