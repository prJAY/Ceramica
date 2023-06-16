<?php include $_SERVER['DOCUMENT_ROOT']."/auth_admin.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include $_SERVER['DOCUMENT_ROOT']."/assets/_Header.php"; 
        include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";
        
        $uid = $_SESSION['uid'];
        $msg = "";
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
            
            $img_name = $_FILES["myimg"]["name"];
            $tmp_name = $_FILES["myimg"]["tmp_name"];
            $filepath = "/uploads/".date('dmY_His').$img_name;
            $folder = $_SERVER['DOCUMENT_ROOT'].$filepath;

            $check = getimagesize($_FILES["myimg"]["tmp_name"]);
            if($check !== false) {
                if(move_uploaded_file($tmp_name,$folder)){
                    $sql="insert into product_master (name,price,color,material,finish,size,thickness,details,imgpath,stock,catagory) values ('$name',$price,'$color','$material','$finish','$size','$thick','$details','$filepath','$stock','$cata')";
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
    ?>
    <title>Ceramica</title>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT']."/assets/_Nav_Loader.php"; ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <b class="fs-1">New Product</b>
        </div>
        <hr/>
        <br/>
        <br/>
        <form class="row g-3" method="POST" enctype="multipart/form-data">
            <div class="col-md-4">
                <label>Name</label>
                <input type="text" class="form-control" name="name" required/>
            </div>
            <div class="col-md-4">
                <label>Price</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">₹</span>
                    <input type="number" class="form-control" name="price" required/>
                </div>
            </div>
            <div class="col-md-4">
                <label>Select Catagory</label>
                <select class="form-select" name="cata">
                    <optgroup>
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
                <input type="text" class="form-control" name="color" required/>
            </div>
            <div class="col-md-4">
                <label>Material</label>
                <input type="text" class="form-control" name="material" required/>
            </div>
            <div class="col-md-4">
                <label>Finish</label>
                <input type="text" class="form-control" name="finish" required/>
            </div>
            <div class="col-md-4">
                <label>Size</label>
                <input type="text" class="form-control" name="size" required/>
            </div>
            <div class="col-md-4">
                <label>Thickness</label>
                <input type="text" class="form-control" name="thick" required/>
            </div>
            <div class="col-md-4">
                <label>Stock</label>
                <input type="text" class="form-control" name="stock" required/>
            </div>
            <div class="col-md-12">
                <label>Details</label>
                <textarea name="details" class="form-control" cols="30" rows="3"></textarea>
            </div>
            <div class="col-md-12">
                <label>Product Image</label>
                <input type="file" class="form-control" name="myimg" id='myimg' required/>
            </div>
            <div class="col-md-12">
                <input type="submit" value="Save" class="btn btn-primary" name="submit"/>
            </div>
        </form>
    </div>
    <div class="container mt-5 rounded bg-warning">
        <span><?php echo $msg; ?></span>
    </div>
</body>
</html>