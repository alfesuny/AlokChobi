<?php
    session_start();
    if ( isset($_SESSION['user_type']) ) {
        
            header("Location: ./index.php");
            exit();

        
    }

  

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
            $link = mysqli_connect("localhost", "root", "", "webprogramming");
            if(!$link){
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }

            

            $username = $_POST["username"];
            $password = $_POST['password'];

            $sql = "SELECT * FROM admin_info WHERE admin_username='$username' AND admin_password='$password'";
            $result = mysqli_query($link, $sql);

            if (mysqli_num_rows($result) == 1) {
                // Email and password match, log in the user
                $row = mysqli_fetch_assoc($result);
                $_SESSION['user_type'] = 'admin';
                $_SESSION['username'] = $row['admin_username'];

         
                header("Location: index.php"); 
                exit();
            } else {
                echo "Invalid email or password. Please try again.";
            }

            // Close the database connection
            mysqli_close($link);

        

       
        
    }

    
 
  
    if ( isset($_SESSION['user_type'])  ) {
        header("Location: ./index.php");
        exit();
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
            <h2>অ্যাডমিন </h2>
            <!-- <div class="alert__message success">
                <p>This is an success message</p>
            </div> -->
            <?php
            // if($password_matching != 'off' && $password_matching != 'done'  ){
            // echo '<div class="alert__message error">
            //     <p>Sorry The Email or The Password Didn\'t match !</p>
            // </div>';
            // }

            ?>

            <form action="admin.php" method="POST">
                <input type="text" placeholder="ব্যবহারকারীর নাম" name='username'>
                <input type="password" placeholder="পাসওয়ার্ড" name='password'>
                <button class="btn" type="submit">সাইন ইন করুন</button>
                <!-- <small>Don't have an account? <a href="./signup.html">Sign Up</a></small> -->
            </form>
        </div>
    </section>
</body>

</html>


