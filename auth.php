<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_SESSION["uid"]) and $_SESSION['uid'] != "")
    {
        //echo "User OK";
    }
    else
    {
        //echo "User Fail";
        header("location: /User/Login.php");
        exit;
    }

?>