<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include $_SERVER['DOCUMENT_ROOT']."/assets/_Header.php"; 
        include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";
        
        $pid = $_GET['q'];
        
        $sql="select * from product_master where id = $pid";
        $result=mysqli_query($con,$sql);
        if($result){
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
            }
            if(mysqli_num_rows($result) == 0){
                header('location:/Product/');
            }
        }
        else{
            header('location:/Product/');
        }
    ?>
    <title>Ceramica</title>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT']."/assets/_Nav_Loader.php"; ?>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-4">
                <img src="<?php echo $imgpath; ?>" class="w-100"/>
            </div>
            <div class="col-md-8">
                <form action="/Cart/addtocart.php" method="POST">
                <table class="table table-borderless h-100">
                    <tr>
                        <td>
                            <h1><?php echo $name; ?></h1>
                            <input type="hidden" value="<?php echo $pid; ?>" name="pid"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4 class="text-muted">Catagory: <?php echo $cata; ?> Tile</h4>
                        </td>
                    </tr>
                    <tr>
                        <td class="h-50">
                            <h4 class="text-success my-auto">₹<?php echo $price; ?>.00/-</h4>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <?php
                            if($stock > 0){
                                echo '
                            <h5 class="text-muted">Available: '.$stock.' Pcs</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="mindiv" style="width: 150px;">
                                <input type="number" value="5" min="1" max="'.$stock.'" step="1" name="qty"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="h-50">
                            <input type="submit" name="submit" value="Add to cart" class="btn btn-success"/>
                        </td>
                    </tr>
                                ';
                            }
                            else{
                                echo '
                            <h5 class="text-danger">Out of stock !</h5>
                        </td>
                    </tr>';
                            }
                        ?>
                        
                    <tr>
                        <td>
                            Free Shipping on orders over 5999/- all over India.
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#details">View detailed specifications</a>
                        </td>
                    </tr>
                </table>
                </form>
            </div>
        </div>
    </div>
    <br/>
    <br/>
    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <b class="fs-1" id='details'>Product Specifications</b>
        </div>
        <hr/>
        <br/>
        <br/>
        <table class="table">
            <tr>
                <th>Catagory</th>
                <td colspan="3"><?php echo $cata; ?> Tile</td>
            </tr>
            <tr>
                <th>Size</th>
                <td><?php echo $size; ?></td>
                <th>Thickness</th>
                <td><?php echo $thickness; ?></td>
            </tr>
            <tr>
                <th>Color</th>
                <td><?php echo $color; ?></td>
                <th>Material</th>
                <td><?php echo $material; ?></td>
            </tr>
            <tr>
                <th>Finish</th>
                <td colspan="3"><?php echo $finish; ?></td>
            </tr>
        </table>
        <br/>
        <br/>
        <br/>
        <br/>
        <div class="d-flex justify-content-between">
            <b class="fs-1" id='details'>Product Details</b>
        </div>
        <hr/>
        <br/>
        <p><?php echo $details; ?></p>
        <br/>
        <br/>
        <br/>
        <br/>
        <div class="d-flex justify-content-between">
            <b class="fs-1" id='details'>Shipping Details</b>
        </div>
        <hr/>
        <br/>
        <p>Tiles will be shrink wrapped on a pallet and delivered to the ground level edge of your property (curbside). The driver will NOT be able to assist getting the tiles into your property due to insurance purposes. Orders under 20kg weight will be delivered with a parcel courier.
<br/><br/>
When ordering Tile Samples you will receive a small cut sample either 10cm x 10cm or 15cm x 15cm.
<br/><br/>
We hope that you will be pleased with the tiles that you have bought from us. If you wish to return any goods to us, it must be returned to us in re-saleable condition, in its full original carton/box and the range is still for sale via our website. The customer will be responsible for organising the return of the goods to our distribution warehouse return centre within 30 days of the delivery date. The refund will be processed within 3-5 working days following our receipt of the re-saleable items.
<br/><br/>
There will be a restocking charge of 10% of the goods returned.
<br/><br/>
If the goods are not in a re-saleable condition when they arrive back with us, We reserve the right to amend the amount of the refund based on the value of re-saleable goods.
<br/><br/>
If you decide to return an entire order, costs will need to be deducted for the delivery, and the return costs.</p>
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