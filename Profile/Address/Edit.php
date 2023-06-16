<?php include $_SERVER['DOCUMENT_ROOT']."/auth.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include $_SERVER['DOCUMENT_ROOT']."/assets/_Header.php"; 
        include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";
        
        $uid = $_SESSION['uid'];
        $msg = "";
        if(isset($_POST['submit'])){
            $aid = $_GET['q'];
            $name = $_POST['name'];
            $cno = $_POST['cno'];
            $add1 = $_POST['add1'];
            $add2 = $_POST['add2'];
            $pinc = $_POST['pincode'];
            $city = $_POST['city'];
            $state = $_POST['state'];

            $sql="update address_master set name='$name',contact='$cno',line1='$add1',line2='$add2',pin='$pinc',city='$city',state='$state' where id = $aid and user_id = $uid";
            $result=mysqli_query($con,$sql);
            if($result){
                header('location:/Profile/Address');
            }else {
                $msg = "Unable to save address";
            }
        }

        if(isset($_GET['q']))
        {
            $aid = $_GET['q'];
            $sql="select * from address_master where user_id = $uid and id = $aid";
            $result=mysqli_query($con,$sql);
            if($result){
                while($row=mysqli_fetch_assoc($result)){
                    $aid=$row['id'];
                    $name=$row['name'];
                    $cno=$row['contact'];
                    $add1=$row['line1'];
                    $add2 = $row['line2'];
                    $pinc=$row['pin'];
                    $city=$row['city'];
                    $state=$row['state'];
                }
                if(mysqli_num_rows($result) == 0){
                    header('location:/Profile/Address');
                }
            }
        }
    ?>
    <title>Ceramica</title>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT']."/assets/_Nav_Loader.php"; ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <b class="fs-1">Edit Address</b>
        </div>
        <hr/>
        <br/>
        <br/>
        <form class="row g-3" method="POST">
            <div class="col-md-6">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required/>
            </div>
            <div class="col-md-6">
                <label>Contact No</label>
                <input type="number" class="form-control" name="cno" value="<?php echo $cno; ?>" required/>
            </div>
            <div class="col-md-6">
                <label>Address line 1</label>
                <input type="text" class="form-control" name="add1" value="<?php echo $add1; ?>" required/>
            </div>
            <div class="col-md-6">
                <label>Address line 2</label>
                <input type="text" class="form-control" name="add2" value="<?php echo $add2; ?>" required/>
            </div>
            <div class="col-md-4">
                <label>Pincode</label>
                <input type="number" class="form-control" name="pincode" value="<?php echo $pinc; ?>" required/>
            </div>
            <div class="col-md-4">
                <label>City</label>
                <input type="text" class="form-control" name="city" value="<?php echo $city; ?>" required/>
            </div>
            <div class="col-md-4">
                <label>State</label>
                <select name="state" id="state" class="form-select">
                    <option value="<?php echo $state; ?>"><?php echo $state; ?></option>
                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                    <option value="Assam">Assam</option>
                    <option value="Bihar">Bihar</option>
                    <option value="Chandigarh">Chandigarh</option>
                    <option value="Chhattisgarh">Chhattisgarh</option>
                    <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                    <option value="Daman and Diu">Daman and Diu</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Lakshadweep">Lakshadweep</option>
                    <option value="Puducherry">Puducherry</option>
                    <option value="Goa">Goa</option>
                    <option value="Gujarat">Gujarat</option>
                    <option value="Haryana">Haryana</option>
                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                    <option value="Jharkhand">Jharkhand</option>
                    <option value="Karnataka">Karnataka</option>
                    <option value="Kerala">Kerala</option>
                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                    <option value="Maharashtra">Maharashtra</option>
                    <option value="Manipur">Manipur</option>
                    <option value="Meghalaya">Meghalaya</option>
                    <option value="Mizoram">Mizoram</option>
                    <option value="Nagaland">Nagaland</option>
                    <option value="Odisha">Odisha</option>
                    <option value="Punjab">Punjab</option>
                    <option value="Rajasthan">Rajasthan</option>
                    <option value="Sikkim">Sikkim</option>
                    <option value="Tamil Nadu">Tamil Nadu</option>
                    <option value="Telangana">Telangana</option>
                    <option value="Tripura">Tripura</option>
                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                    <option value="Uttarakhand">Uttarakhand</option>
                    <option value="West Bengal">West Bengal</option>
                </select>
            </div>
            <div class="col-md-12">
                <input type="submit" value="Save" class="btn btn-primary" name="submit"/>
            </div>
        </form>
    </div>
    <div class="container mt-5 rounded bg-danger">
        <span class="text-white"><?php echo $msg; ?></span>
    </div>
</body>
</html>