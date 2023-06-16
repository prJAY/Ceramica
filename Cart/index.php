<?php include $_SERVER['DOCUMENT_ROOT']."/auth.php"; ?>
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
<?php include $_SERVER['DOCUMENT_ROOT']."/assets/_Nav_Loader.php"; ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <b class="fs-1">Shopping Cart</b>
        </div>
        <hr/>
        <br/>
        <br/>
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
                                            <form action="/Cart/updatecart.php" method="POST" class="d-flex">
                                                <span class="fs-5 mx-2 my-auto">Qty</span>
                                                
                                                <div class="mindiv" style="width: 150px;">
                                                    <input type="number" value="'.$qty.'" min="1" max="'.$stock.'" step="1" name="newqty"/>
                                                </div>
                                                <div class="vr border mx-3 my-auto" style="height: 30px;"></div>
                                                <input type="hidden" name="pid" value="'.$pid.'"/>
                                                <input type="submit" name="submit" value="Update" class="btn"/>
                                                <div class="vr border mx-3 my-auto" style="height: 30px;"></div>
                                                <a href="/Cart/removefromcart.php?q='.$pid.'" class="my-auto text-decoration-none text-muted">Remove</a>
                                            </form>
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
        <hr/>
        <div class="d-flex justify-content-end">
            <b class="fs-1">Subtotal: <?php echo $sub; ?>.00</b>
        </div>
        <br/>
        <?php 
        if($sub > 0){
            $_SESSION['subtot'] = $sub;
            echo '<a href="/Order/NewOrder.php" class="btn btn-success float-end">Proceed to checkout</a>';
        }
        ?>
        <br/>
        <br/>
        <br/>
    </div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/assets/_Footer.php"; ?>
    <script src="/js/bootstrap-input-spinner.js"></script>
    <script>
       $("input[type='number']").inputSpinner({buttonsOnly: true});
    </script>
</body>
</html>