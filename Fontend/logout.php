<?php


    session_start();
    
    if ( isset($_SESSION['user_type'])  ) {
            
        session_unset();
        session_destroy();
        
    }
    
        header("Location: ./signin.php");
    

?>