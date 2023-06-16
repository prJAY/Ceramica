<?php include $_SERVER['DOCUMENT_ROOT']."/auth.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php"; ?>
<?php
    if(isset($_GET['q'])){
        $pid = $_GET['q'];
        $uid = $_SESSION['uid'];

        $sql="delete from cart_master where pid = $pid and user_id = $uid";
        $result=mysqli_query($con,$sql);
        if($result){
            //ok
        }else{
            //fail
        }
        header('location:/Cart/');
    }
    else{
        header('location:/');
    }
?>