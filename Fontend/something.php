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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ca603e05a0.js" crossorigin="anonymous"></script>
</head>
<body>
    <!--------------------------------------- Navigation Bar ------------------------------------->
    <?php include 'header.php';?>
    <!----------------------------------------- End Nav Bar --------------------------------------->
    <br>


    <!----------------------------------------- Start Manage Course --------------------------------------->
    <section class="dashboard">
        <div class="container dashboard__container">
            <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
            <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
            <aside>
                <ul>
                    <li><a href="./signup.php"><i class="uil uil-pen"></i>
                        <h5>Add User</h5>
                    </a></li>
                </ul>
                <ul>
                    <li><a class="active" href="./dashboard.php"><i class="uil uil-fast-mail"></i>
                        <h5>Edit Users</h5>
                    </a></li>
                </ul>
                <ul>
                    <li><a href="./manageInstructor.html"><i class="uil uil-user-plus"></i>
                        <h5>Add Admin</h5>
                    </a></li>
                </ul>
                <ul>
                    <li><a href="./manageUsers.html"><i class="uil uil-user-times"></i>
                        <h5>Edit Admin</h5>
                    </a></li>
                </ul>
                <ul>
                    <li><a href="./manageCategories.html"><i class="uil uil-edit"></i>
                        <h5>Manage Categori</h5>
                    </a></li>
                </ul>
                <!-- <ul>
                    <li><a href="manage-categories.html"><i class="uil uil-list-ul"></i>
                        <h5>Manage Categories</h5>
                    </a></li>
                </ul> -->
            </aside>

            <main>
                <h2>Edit Users</h2>
                
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

            // Fetch user information from the database
            $query = "SELECT * FROM user_info";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                echo '<table>';
                echo '<thead>';
                echo '<tr>';
                echo '<th>User Id</th>';
                echo '<th>Email</th>';
                echo '<th>First Name</th>';
                echo '<th>Last Name</th>';
                echo '<th>Gender</th>';
                echo '<th>Edit</th>';
                echo '<th>Delete</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<form method="POST" action="editUser.php">';
                    echo '<tr>';
                    echo '<td>' . $row['user_id'] . '</td>';
                    echo '<td><input type="text" name="email" value="' . $row['email'] . '" readonly></td>';
                    echo '<td><input type="text" name="first_name" value="' . $row['first_name'] . '"></td>';
                    echo '<td><input type="text" name="last_name" value="' . $row['last_name'] . '"></td>';
            ?>
                    <td>

                        <select id="gender" name="gender" required>
                            <option value="Male" <?php if ($row['gender'] === 'Male') echo 'selected'; ?>>পুরুষ</option>
                            <option value="Female" <?php if ($row['gender'] === 'Female') echo 'selected'; ?>>মহিলা</option>
                            <option value="Other" <?php if ($row['gender'] === 'Other') echo 'selected'; ?>>অন্যান্য</option>
                        </select>
                    
                    </td>

    <?php
                
                    echo '<td><button type="submit" class="btn sm">Edit</button></td>';
                    echo '<td><a href="#" class="btn sm danger">Delete</a></td>';
                    echo '</tr>';
                    echo '</form>';
                }

                echo '</tbody>';
                echo '</table>';
            } else {
                echo "No users found in the database.";
            }

            // Close the database connection
            mysqli_close($conn);
            
    ?>


               
              
            </main>
        </div>
    </section>
    <!----------------------------------------- End Manage Course --------------------------------------->




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
                    <li><a href="">Home</a></li>
                    <li><a href="">Signin</a></li>
                </ul>
            </article>


            <article>
                <h4>Permalinks</h4>
                <ul>
                    <li><a href="./index.php">Home</a></li>
                    <li><a href="https://www.ewubd.edu/">East West University</a></li>
                    <li><a href="https://bangladesh.gov.bd/index.php">Bangladesh Govt</a></li>
                    <li><a href="https://moedu.gov.bd/">Ministry of Education</a></li>
                    <li><a href="https://www.police.gov.bd/">Police</a></li>
                </ul>
            </article>
        </div>
        <div class="footer__copyright">
            <small>Copyright &copy; 2024 <span style="color: orange;">আলোক ছবি</span>Py</small>
        </div>
    </footer>

    <!--------------------------------------- End Footer ----------------------------------->


    <!-------------------------------------- Custom Js File -------------------------------------->
    <script src="js/main.js"></script>

    <!-------------------------------------- Font Awesome ---------------------------------------->
    <script src="https://kit.fontawesome.com/924def979f.js" crossorigin="anonymous"></script>

</body>
</html>