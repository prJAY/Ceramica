<?php include $_SERVER['DOCUMENT_ROOT']."/auth.php"; 

    if(isset($_POST['submit']) && isset($_POST['addr']) && isset($_POST['payopt'])){
        $addr = $_POST['addr'];
        $payopt = $_POST['payopt'];
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
        include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";
    ?>
    <title>Ceramica</title>
</head>
<body>
    <nav class="navbar bg-success text-light p-3">
        <span class="text-center w-100">Ceramica</span>
    </nav>
    <br/>
    <div class="d-flex justify-content-center">
        <div class="d-grid">
            <div class="btn btn-success rounded-0 m-auto mb-2">
                Step 1
            </div>
            <span>Select Address
            <svg xmlns="http://www.w3.org/2000/svg" style="height: 20px;" class="text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            </span>
        </div>
        <hr class="w-25 bg-success" style="height: 3px;"/>
        <div class="d-grid">
            <div class="btn btn-success rounded-0 m-auto mb-2">
                Step 2
            </div>
            <span>Select Payment
            <svg xmlns="http://www.w3.org/2000/svg" style="height: 20px;" class="text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            </span>
        </div>
        <hr class="w-25 bg-success" style="height: 3px;"/>
        <div class="d-grid">
            <div class="btn btn-success rounded-0 m-auto mb-2">
                Step 3
            </div>
            <span>Confirm Order
            </span>
        </div>
    </div>

    <br/>
    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <b class="fs-1">Confirm Order</b>
        </div>
        <hr/>
    </div>
        
    <div class="container my-5">
        <div class="d-flex justify-content-between">
            <b class="fs-2">Shipping Address</b>
        </div>
        <hr/>
        <?php
            $uid = $_SESSION['uid'];
            $sql="select * from address_master where user_id = $uid and id = $addr";
            $result=mysqli_query($con,$sql);
            $count = 0;
            if($result){
                while($row=mysqli_fetch_assoc($result) and $count < 5){
                    $aid=$row['id'];
                    $name=$row['name'];
                    $cno=$row['contact'];
                    $add1=$row['line1'];
                    $add2=$row['line2'];
                    $pin=$row['pin'];
                    $city=$row['city'];
                    $state=$row['state'];
                    $count += 1;
                    
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
        <hr/>
    </div>

    <?php

    $uid = $_SESSION['uid'];
    $sql = "select p.* , SUM(qty) from product_master p,cart_master c where p.id = c.pid and c.user_id = $uid GROUP BY p.id";

    $result=mysqli_query($con,$sql);
    if($result){
        $sub = 0;
        while($row=mysqli_fetch_assoc($result)){
            $pid=$row['id'];
            $name=$row['name'];
            $price=$row['price'];
            $color=$row['color'];
            $material=$row['material'];
            $finish=$row['finish'];
            $size=$row['size'];
            $thickness=$row['thickness'];
            $details=$row['details'];
            $imgpath=$row['imgpath'];
            $stock=$row['stock'];
            $cata=$row['catagory'];
            $qty=$row['SUM(qty)'];
            $sub += ($price * $qty);
            
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
                                <td colspan="3">
                                    <div class="d-flex">
                                        <span class="fs-5 mx-2 my-auto">Qty. '.$qty.'</span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <h4 class="text-success col-md-1 mt-3 me-3">'.$price.'.00</h4>
                </div>
            </div>';
        }
        if(mysqli_num_rows($result) == 0){
            echo '<div class="container my-2 p-3"><i>Your Cart is empty</i></div>';
        }
    }
    ?>

    <div class="container mt-5">
        <table class="table table-borderless w-50">
            <tr>
                <th>Payment Mode - <?php echo $payopt; ?></th>
                <td></td>
            </tr>
            <tr>
                <th>Sub total</th>
                <td><?php echo $sub; ?>.00</td>
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
                <td><?php echo $sub; ?>.00</td>
            </tr>
        </table>
    </div>

    <div class="container mt-3">
        <form action="NewOrderFinal.php" method="POST">
            <input type="hidden" name="addr" value="<?php echo $addr; ?>" />
            <input type="hidden" name="payopt" value="<?php echo $payopt; ?>" />
            <input type="submit" name="submit" value="Confirm & Place Order" class="btn btn-success" />
        </form>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
    </div>

    <footer class="navbar bg-success text-light p-3">
        <span class="text-center w-100">&copy; Ceramica.com</span>
    </footer>

</body>
</html>