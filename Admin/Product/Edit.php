<?php include $_SERVER['DOCUMENT_ROOT']."/auth_admin.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include $_SERVER['DOCUMENT_ROOT']."/assets/_Header.php"; 
        include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";
        
        $uid = $_SESSION['uid'];
        $msg = "";
        $pid = $_GET['q'];
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $color = $_POST['color'];
            $material = $_POST['material'];
            $finish = $_POST['finish'];
            $size = $_POST['size'];
            $thick = $_POST['thick'];
            $details = $_POST['details'];
            $cata = $_POST['cata'];


            $sql="update product_master set name='$name',price=$price,color='$color',material='$material',finish='$finish',size='$size',thickness='$thick',details='$details',stock='$stock',catagory='$cata' where id = $pid";
            $result=mysqli_query($con,$sql);
            if($result){
                header('location:/Admin/Product/');
            }else {
                $msg = "Unable to save product";
            }
        }
        if(isset($_POST['save'])){
            $img_name = $_FILES["myimg"]["name"];
            $tmp_name = $_FILES["myimg"]["tmp_name"];
            $filepath = "/uploads/".date('dmY_His').$img_name;
            $folder = $_SERVER['DOCUMENT_ROOT'].$filepath;

            $check = getimagesize($_FILES["myimg"]["tmp_name"]);
            if($check !== false) {
                if(move_uploaded_file($tmp_name,$folder)){
                    $sql="update product_master set imgpath='$filepath' where id = $pid";
                    $result=mysqli_query($con,$sql);
                    if($result){
                        header('location:/Admin/Product/');
                    }else {
                        $msg = "Unable to save product";
                    }
                }
            } else {
                $msg = "File is not an image.";
            }
        }

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
                header('location:/Admin/Product/');
            }
        }
        else{
            header('location:/Admin/Product/');
        }
    ?>
    <title>Ceramica</title>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT']."/assets/_Nav_Loader.php"; ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <b class="fs-1">Edit Product</b>
        </div>
        <hr/>
        <br/>
        <br/>
        <form class="row g-3" method="POST" enctype="multipart/form-data">
            <div class="col-md-4">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required/>
            </div>
            <div class="col-md-4">
                <label>Price</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">₹</span>
                    <input type="number" class="form-control" name="price" value="<?php echo $price; ?>" required/>
                </div>
            </div>
            <div class="col-md-4">
                <label>Select Catagory</label>
                <select class="form-select" name="cata">
                    <optgroup label="Current Selection">
                        <option><?php echo $cata; ?></option>
                    </optgroup>
                    <optgroup label="Options">
                        <option>Wall</option>
                        <option>Kitchen</option>
                        <option>Outdoor</option>
                        <option>Bathroom</option>
                        <option>Floor</option>
                        <option>Shape</option>
                    </optgroup>
                </select>
            </div>
            <div class="col-md-4">
                <label>Color</label>
                <input type="text" class="form-control" name="color" value="<?php echo $color; ?>" required/>
            </div>
            <div class="col-md-4">
                <label>Material</label>
                <input type="text" class="form-control" name="material" value="<?php echo $material; ?>" required/>
            </div>
            <div class="col-md-4">
                <label>Finish</label>
                <input type="text" class="form-control" name="finish" value="<?php echo $finish; ?>" required/>
            </div>
            <div class="col-md-4">
                <label>Size</label>
                <input type="text" class="form-control" name="size" value="<?php echo $size; ?>" required/>
            </div>
            <div class="col-md-4">
                <label>Thickness</label>
                <input type="text" class="form-control" name="thick" value="<?php echo $thickness; ?>" required/>
            </div>
            <div class="col-md-4">
                <label>Stock</label>
                <input type="text" class="form-control" name="stock" value="<?php echo $stock; ?>" required/>
            </div>
            <div class="col-md-12">
                <label>Details</label>
                <textarea name="details" class="form-control" cols="30" rows="3"><?php echo $details; ?></textarea>
            </div>
            <div class="col-md-12">
                <input type="submit" value="Save" class="btn btn-primary" name="submit"/>
            </div>
        </form>
    </div>
    <div class="container mt-5 border p-5 pt-3">
        <div class="d-flex justify-content-between">
            <b class="fs-1">Change product image</b>
        </div>
        <hr/>
        <br/>
        <form class="row g-3" method="POST" enctype="multipart/form-data">
            <div class="col-md">
                <label>Product Image</label>
                <input type="file" class="form-control" name="myimg" id='myimg' required/>
            </div>
            <div class="col-md col-auto d-flex">
                <input type="submit" value="Save" class="btn btn-primary mt-auto" name="save"/>
            </div>
        </form>
    </div>
    <div class="container mt-5 rounded bg-warning">
        <span><?php echo $msg; ?></span>
    </div>
</body>
</html>