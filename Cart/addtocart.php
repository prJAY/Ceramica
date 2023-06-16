<?php include $_SERVER['DOCUMENT_ROOT']."/auth.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php"; ?>
<?php
    if(isset($_POST['submit'])){
        $pid = $_POST['pid'];
        $qty = $_POST['qty'];
        $uid = $_SESSION['uid'];

        $sql="select * from cart_master where pid = $pid and user_id = $uid";
        $result=mysqli_query($con,$sql);
        if($result){
            while($row=mysqli_fetch_assoc($result)){
                $qty += $row['qty'];
                $sql="update cart_master set qty = $qty where pid = $pid and user_id = $uid";
                $result2=mysqli_query($con,$sql);
                if($result2){
                    //ok
                }else{
                    //fail
                }
            }
            if(mysqli_num_rows($result) == 0){
                $sql="insert into cart_master (pid,qty,user_id) values ($pid,$qty,$uid)";
                $result3=mysqli_query($con,$sql);
                if($result3){
                    //ok
                }else{
                    //fail
                }
            }
        }
        else{
            $sql="insert into cart_master (pid,qty,user_id) values ($pid,$qty,$uid)";
            $result4=mysqli_query($con,$sql);
            if($result4){
                //ok
            }else{
                //fail
            }
        }
        header('location:/Cart/');
    }
    else{
        header('location:/');
    }
?>