<?php
    include $_SERVER['DOCUMENT_ROOT']."/auth_admin.php"; 
    include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";
    
    if(isset($_GET['stat']) && isset($_GET['q'])){
        $stat = $_GET['stat'];
        $id = $_GET['q'];

        $sql="update user_master set user_status='$stat' where user_id = $id and user_type='C'";
        $result=mysqli_query($con,$sql);
        if($result){
            header('location:/Admin/Users/?q='.$stat);
        }
        else {
            header('location:/Admin/');
        }
    }
    else {
        header('location:/');
    }
?>