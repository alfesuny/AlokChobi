<nav>
    <div class="container nav__container">
        <a href="./index.php"><img class="nav__logo" src="../images/logo.png" alt="logo"></a>
        <ul class="nav__items">
            <li><a href="./index.php">হোম</a></li>
            
            

          
            
            <?php
             // Start the session

            // Check if the user is logged in (based on user_type session variable)
            if (isset($_SESSION['user_type'])) {
          
         
                $servername = "localhost";
                $username = "root";
                $password = ""; 
                $dbname = "webprogramming"; 
                
              
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                

                $profilePictureSrc="";

                $userType = $_SESSION['user_type'];
                
                if($userType == 'user'){

                    $email = $_SESSION['email']; 
                    $query = "SELECT profile_picture FROM user_info WHERE email='$email'";
                    $result = mysqli_query($conn, $query);
    
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $profilePictureValue = $row['profile_picture'];
                        $profilePictureSrc = "../profile_pic/$userType/$profilePictureValue";
    
                    }
                    echo ' <li><a href="./uploadPicture.php">ছবি আপলোড</a></li> ';
                    echo ' <li><a href="./profile.php">প্রোফাইল</a></li> ';
                    echo ' <li><a href="./myPictures.php">আমার ছবি সমুহ</a></li> ' ;
                    echo ' <li><a href="./showAll_test.php">অন্যদের ছবি</a></li> ';

                }
                elseif($userType == 'admin'){
                    $profilePictureSrc = "../profile_pic/$userType/admin.jpg";
                    echo '<li><a href="./showAll.php">অন্যদের ছবি</a></li>';
                }

    ?>   
                  
                
                            
                            <li class="nav__profile">
                              <div class="avatar">
                                  <img src="<?php echo $profilePictureSrc ?>" alt="Profile Picture">
                              </div>
                              <ul>
                                <?php
                                    if($userType == 'admin'){
                                        echo '<li><a href="./dashboard.php">ড্যাশবোর্ড</a></li>';
                                    }
                                ?>
                                  
                                  <li><a href="logout.php">প্রস্থান</a></li>
                              </ul>
                          </li>
                
    <?php
           
                mysqli_close($conn);
            } 
            else {
                // User is not logged in, display the login and signup options
                echo '<li><a href="./signin.php">প্রবেশ করুন</a></li>
                      <li><a href="./signup.php">নিবন্ধন করুন</a></li>';
            }
            ?>
        </ul>
    </div>
</nav>
