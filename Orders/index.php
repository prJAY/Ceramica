<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include $_SERVER['DOCUMENT_ROOT']."/assets/_Header.php"; 
        include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";
        
        $uid = $_SESSION['uid'];
    ?>
    <title>Ceramica</title>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT']."/assets/_Nav_Loader.php"; ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <b class="fs-1">Your order history</b>
        </div>
        <hr/>
        <br/>
        <br/>
    </div>

    <?php
        $sql="select * from order_master where user_id = $uid order by id desc";

        $result=mysqli_query($con,$sql);
        if($result){
            while($row=mysqli_fetch_assoc($result)){
                $oid = $row['id'];
                $tot= $row['g_total'];
                $dt = $row['date'];
                
                echo'
                <div class="container border border-dark my-2 p-3">
                    <div class="d-flex justify-content-between">
                        <span class="fs-4"><a href="/orders/View.php?q='.$oid.'" class=" text-decoration-none text-dark">Order ID <b>#'.$oid.'</b></a></span>
                        <span class="fs-4">'.$dt.'</span>
                    </div>
                    <br/>
                    <table class="table">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Price</th>
                        </tr>';

                        $sql="select i.*,name from order_items i,product_master p where order_id = '$oid' and p.id = pid";

                        $result2=mysqli_query($con,$sql);
                        if($result2){
                            while($row=mysqli_fetch_assoc($result2)){
                                $pid = $row['name'];
                                $amt = $row['amount'];
                                $qty = $row['qty'];
                                $status = $row['status'];

                                echo '
                                <tr>
                                    <td>'.$pid.'</td>
                                    <td>'.$qty.'</td>
                                    <td>'.$status.'</td>
                                    <td>'.$amt.'</td>
                                </tr>
                                ';
                            }
                        }

                        echo '
                        <tr>
                            <td colspan="3" align="right">Total</td>
                            <th>'.$tot.'</th>
                        </tr>
                    </table>
                </div>';
            }
            if(mysqli_num_rows($result) == 0){
                echo '<div class="container my-2 p-3">
                        <i>You have not placed any order</i></div>';
            }
        }
    ?>
    <?php include $_SERVER['DOCUMENT_ROOT']."/assets/_Footer.php"; ?>
</body>
</html>