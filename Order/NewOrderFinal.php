<?php

    include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";
    include $_SERVER['DOCUMENT_ROOT']."/auth.php"; 
    

    if(isset($_POST['submit']) && isset($_POST['addr']) && isset($_POST['payopt'])){

        $uid = $_SESSION['uid'];
        
        $order_id = date('Ymd-his')."-".substr(round(microtime(true)*1000),-4)."-".$uid;
        $gtot = $_SESSION['subtot'];
        $payopt = $_POST['payopt'];
        $dt = date("Y-m-d");
        $addr = $_POST['addr'];
        

        $sql = "insert into order_master values('$order_id',$gtot,'$payopt','$dt',$addr,$addr,$uid)";
        $result = mysqli_query($con,$sql);
        if($result){

            $sql2 = "select pid, qty , price from cart_master c,product_master p where p.id = pid and user_id = $uid";
            $result2 = mysqli_query($con,$sql2);
            if($result2){
                while($row=mysqli_fetch_assoc($result2)){

                    $pid = $row['pid'];
                    $qty = $row['qty'];
                    $amt = $row['price'];
                    $tot = $qty * $amt;

                    $sql3 = "insert into order_items (pid,amount,qty,total,status,order_id) values($pid,$amt,$qty,$tot,'Received','$order_id')";
                    $result3 = mysqli_query($con,$sql3);

                    if($result3){
                        $flag = TRUE;
                    }
                    else{
                        $flag = False;
                        break;
                    }
                }
            }
            else{
                $flag = False;
            }

            if($flag){
                $sql = "delete from cart_master where user_id = '$uid'";
                $result = mysqli_query($con,$sql);
                header('location:/Order/Success.php?q='.$order_id);
            }
            else{
                $sql = "delete from order_master where order_id = '$order_id'";
                $result = mysqli_query($con,$sql);
                echo "<h1 style='color:red;'>Some of the items cannot be processed. Order failed. <a href='/'>Back to Home</a></h1>";
                header('location:/Order/Failed.php');
            }

        }
        else {
            echo "<h1 style='color:red;'>Order failed. Please try again. <a href='/'>Back to Home</a></h1>";
            header('location:/Order/Failed.php');
        }
    }
    else{
        header('location:/');
    }


    
    
?>