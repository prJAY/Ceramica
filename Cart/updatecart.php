<?php include $_SERVER['DOCUMENT_ROOT']."/auth.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php"; ?>
<?php
    if(isset($_POST['submit'])){
        $pid = $_POST['pid'];
        $qty = $_POST['newqty'];
        $uid = $_SESSION['uid'];

        $sql="update cart_master set qty = $qty where pid = $pid and user_id = $uid";
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