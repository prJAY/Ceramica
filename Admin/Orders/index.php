<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include $_SERVER['DOCUMENT_ROOT']."/auth_admin.php"; 
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
            <b class="fs-1">Order list</b>
        </div>
        <hr/>
        <br/>
        <br/>
    </div>

    <?php
        
        if(isset($_GET['stat'])){
            $sql="select distinct m.* from order_master m,order_items i where i.order_id = m.id and i.status = '".$_GET['stat']."' order by m.id desc";
        }
        else{
            $sql="select distinct m.* from order_master m,order_items i where i.order_id = m.id order by m.id desc";
        }
        

        $result=mysqli_query($con,$sql);
        if($result){
            while($row=mysqli_fetch_assoc($result)){
                $oid = $row['id'];
                $tot= $row['g_total'];
                $dt = $row['date'];
                
                echo'
                <div class="container border border-dark my-2 p-3">
                    <div class="d-flex justify-content-between">
                        <span class="fs-4"><a href="/Admin/Orders/View.php?q='.$oid.'" class=" text-decoration-none text-dark">Order ID <b>#'.$oid.'</b></a></span>
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
                            while($row2=mysqli_fetch_assoc($result2)){
                                $pid = $row2['name'];
                                $amt = $row2['amount'];
                                $qty = $row2['qty'];
                                $status = $row2['status'];

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
                echo '<div class="container"><i>No orders found</i></div>';
            }
        }
    ?>
    <?php include $_SERVER['DOCUMENT_ROOT']."/assets/_Footer.php"; ?>
</body>
</html>