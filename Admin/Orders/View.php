<?php

    include $_SERVER['DOCUMENT_ROOT']."/auth_admin.php"; 
    include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";

    if(isset($_GET['q'])){
        $oid = $_GET['q'];
    }
    else{
        header('location:/');
        exit;
    }


    $uid = $_SESSION['uid'];
    $sql="select * from order_master where id = '$oid'";
    $result=mysqli_query($con,$sql);
    if($result){
        while($row=mysqli_fetch_assoc($result)){
            $oid=$row['id'];
            $tot=$row['g_total'];
            $pmode=$row['paymode'];
            $dt=$row['date'];
            $addr=$row['s_add'];
        }
        if(mysqli_num_rows($result) == 0){
            header('location:/');
            exit;
        }
    }
    else{
        header('location:/');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include $_SERVER['DOCUMENT_ROOT']."/assets/_Header.php"; 
    ?>
    <title>Ceramica</title>
</head>
<body>
    <?php
        include $_SERVER['DOCUMENT_ROOT']."/assets/_Nav_Loader.php";
    ?>
    
    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <b class="fs-1">Order Details</b>
        </div>
        <hr/>
    </div>
        
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <b class="fs-2">Shipping Address</b>
                <hr/>
                <?php
                    $uid = $_SESSION['uid'];
                    $sql="select * from address_master where id = $addr";
                    $result=mysqli_query($con,$sql);
                    if($result){
                        while($row=mysqli_fetch_assoc($result)){
                            $aid=$row['id'];
                            $name=$row['name'];
                            $cno=$row['contact'];
                            $add1=$row['line1'];
                            $add2=$row['line2'];
                            $pin=$row['pin'];
                            $city=$row['city'];
                            $state=$row['state'];
                            
                            echo'
                            <input type="hidden" name="addr" value="'.$aid.'">
                            <label>
                                <h4><b>'.$name.'</b></h4>
                                <p>
                                    '.$add1.',<br/>
                                    '.$add2.',<br/>
                                    '.$city.',<br/>
                                    '.$state.' - '.$pin.'
                                </p>
                                <span>'.$cno.'</span>
                            </label>

                            ';
                        }
                    }
                ?>
            </div>
            <div class="col-md-6">
                <b class="fs-2">Payment Mode - <?php echo $pmode; ?></b>
                <hr/>
                <table class="table table-borderless">
                    <tr>
                        <th>Sub total</th>
                        <td><?php echo $tot; ?>.00</td>
                    </tr>
                    <tr>
                        <th>GST / CGST</th>
                        <td>Included in MRP</td>
                    </tr>
                    <tr>
                        <th>Shipping Charges</th>
                        <td>Applicable later</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td><?php echo $tot; ?>.00</td>
                    </tr>
                </table>
            </div>
        </div>
        <hr/>
    </div>

    <?php

    $uid = $_SESSION['uid'];
    $sql = "select p.*,i.*,i.id from product_master p,order_items i where p.id = i.pid and order_id = '$oid'";

    $result=mysqli_query($con,$sql);
    if($result){
        while($row=mysqli_fetch_assoc($result)){
            $itemid=$row['id'];
            $pid=$row['pid'];
            $name=$row['name'];
            $price=$row['amount'];
            $color=$row['color'];
            $material=$row['material'];
            $finish=$row['finish'];
            $size=$row['size'];
            $thickness=$row['thickness'];
            $details=$row['details'];
            $imgpath=$row['imgpath'];
            $stock=$row['stock'];
            $cata=$row['catagory'];
            $qty=$row['qty'];
            $status=$row['status'];
            
            $btn = '';
            echo'
            <div class="container shadow-sm my-2 p-3">
                <div class="row">
                    <img src="'.$imgpath.'" class="col-md-2"/>
                    <div class="col-md">
                        <table class="table table-borderless h-100">
                            <tr>
                                <td colspan="3"><h1><a href="/Product/Details.php?q='.$pid.'" class="text-dark text-decoration-none">'.$name.'</a></h1></td>
                            </tr>
                            <tr class="h-50">
                                <td>Color: '.$color.'</td>
                                <td>Material: '.$material.'</td>
                                <td>Finish: '.$finish.'</td>
                            </tr>
                            <tr class="h-50">
                                <td>
                                    <div class="d-flex">
                                        <span class="fs-5 my-auto">Qty. '.$qty.'</span>
                                    </div>
                                </td>
                                <td>
                                    Item Status: Order '.$status.'
                                </td>
                                <td>
                                    '.$btn.'
                                </td>
                            </tr>
                        </table>
                    </div>
                    <h4 class="text-success col-md-1 mt-3 me-3">'.$price.'.00</h4>
                </div>
                <div class="row w-100 mx-auto my-3">
                    <a class="col-md-3 btn btn-outline-dark rounded-0 " href="/Admin/Orders/MarkOrder.php?q='.$itemid.'&rtn='.$oid.'&stat=Processing" class="text-decoration-none text-dark stretched-link">Processing</a>
                    <a class="col-md-3 btn btn-outline-dark rounded-0 " href="/Admin/Orders/MarkOrder.php?q='.$itemid.'&rtn='.$oid.'&stat=Shipped" class="text-decoration-none text-dark stretched-link">Shipped</a>                    
                    <a class="col-md-3 btn btn-outline-dark rounded-0 " href="/Admin/Orders/MarkOrder.php?q='.$itemid.'&rtn='.$oid.'&stat=Completed" class="text-decoration-none text-dark stretched-link">Completed</a>
                    <a class="col-md-3 btn btn-outline-dark rounded-0 " href="/Admin/Orders/MarkOrder.php?q='.$itemid.'&rtn='.$oid.'&stat=Cancelled" class="text-decoration-none text-dark stretched-link">Cancelled</a>
                </div>
            </div>';
        }
        if(mysqli_num_rows($result) == 0){
            echo '<div class="container my-2 p-3"><i>Your Cart is empty</i></div>';
        }
    }
    ?>

    <div class="container mt-5">
        
    </div>
    
    <?php
        include $_SERVER['DOCUMENT_ROOT']."/assets/_Footer.php";
    ?>
</body>
</html>