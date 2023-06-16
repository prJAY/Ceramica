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
            $name = $_POST['name'];
            $cno = $_POST['cno'];
            $add1 = $_POST['add1'];
            $add2 = $_POST['add2'];
            $pinc = $_POST['pincode'];
            $city = $_POST['city'];
            $state = $_POST['state'];

            $sql="insert into address_master (name,contact,line1,line2,pin,city,state,user_id) values ('$name','$cno','$add1','$add2','$pinc','$city','$state',$uid)";
            $result=mysqli_query($con,$sql);
            if($result){
                header('location:/Profile/Address');
            }else {
                $msg = "Unable to save address";
            }
        }
    ?>
    <title>Ceramica</title>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT']."/assets/_Nav_Loader.php"; ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <b class="fs-1">New Address</b>
        </div>
        <hr/>
        <br/>
        <br/>
        <form class="row g-3" method="POST">
            <div class="col-md-6">
                <label>Name</label>
                <input type="text" class="form-control" name="name" required/>
            </div>
            <div class="col-md-6">
                <label>Contact No</label>
                <input type="number" class="form-control" name="cno" required/>
            </div>
            <div class="col-md-6">
                <label>Address line 1</label>
                <input type="text" class="form-control" name="add1" required/>
            </div>
            <div class="col-md-6">
                <label>Address line 2</label>
                <input type="text" class="form-control" name="add2" required/>
            </div>
            <div class="col-md-4">
                <label>Pincode</label>
                <input type="number" class="form-control" name="pincode" required/>
            </div>
            <div class="col-md-4">
                <label>City</label>
                <input type="text" class="form-control" name="city" required/>
            </div>
            <div class="col-md-4">
                <label>State</label>
                <select name="state" id="state" class="form-select">
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