<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_SESSION["uid"]) and $_SESSION['uid'] != "" and $_SESSION['utype'] == "A")
    {
        //echo "Admin OK";
    }
    else
    {
        //echo "Admin Fail";
        header("location: /403.php");
        exit;
    }
?>