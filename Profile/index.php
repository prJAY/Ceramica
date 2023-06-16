<?php include $_SERVER['DOCUMENT_ROOT']."/auth.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include $_SERVER['DOCUMENT_ROOT']."/assets/_Header.php"; 
    include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";
    
    $msg = "";
    $msgcls = "bg-danger";
    $uid = $_SESSION['uid'];
    
    if(isset($_POST['submit'])){
        $uname=$_POST['name'];
        $uemail=$_POST['email'];
        $ucno=$_POST['cno'];
        
        $sql="update user_master set user_name='$uname',user_cno='$ucno',user_email='$uemail' where user_id = $uid";
        $result=mysqli_query($con,$sql);
        if($result){
            $msg = "Saved changes";
            $msgcls = "bg-success";
        }else{
            $msg = "Operation failed";
        }
    }
    if(isset($_POST['save'])){
        $oldpass=$_POST['oldpass'];
        $upass=$_POST['newpass'];
        $urepass=$_POST['newrepass'];

        if($upass == $urepass){
            if(strlen($upass) > 7){
                $sql="update user_master set user_pass='$upass' where user_id = $uid and user_pass = '$oldpass' ";
                $result=mysqli_query($con,$sql);
                if($result){
                    $msg = "Saved changes";
                    $msgcls = "bg-success";
                }else{
                    $msg = "Password incorrect";
                }
            }
            else{
                $msg = "Password must have 8 characters or more";
            }
            
        }
        else{
            $msg = "Both password must be same";
        }
    }
    
    ?>
    <title>Ceramica</title>
</head>
<body>
    <?php
    
    include $_SERVER['DOCUMENT_ROOT']."/assets/_Nav_Loader.php";


    $sql="select * from user_master where user_id = $uid";
    $result=mysqli_query($con,$sql);
    if($result){
        while($row=mysqli_fetch_assoc($result)){
            $uname = $row['user_name'];
            $uemail= $row['user_email'];
            $ucno= $row['user_cno'];
        }
    }   
    
    ?>

    <div class="container mt-5">
        
        <h1><b>Profile</b></h1>
        <hr/>
        <form class="row g-3" method="post">
            <div class="col-md-12">
                <label>Full Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $uname?>"/>
            </div>
            <div class="col-md-6">
                <label>Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo $uemail?>"/>
            </div>
            <div class="col-md-6">
                <label>Contact No</label>
                <input type="number" class="form-control" name="cno" min="1000000000" max="9999999999" value="<?php echo $ucno?>"/>
            </div>
            <div class="col-md-12">
                <input type="submit" value="Save" name="submit" class="btn btn-primary" />
            </div>
        </form>
        <br/>
        <br/>
        <br/>
        <br/>
        <h2>Change Password</h2>
        <hr/>
        <form class="row g-3" method="POST">
            <div class="col-md">
                <label>Current Password</label>
                <input type="Password" class="form-control" name="oldpass" />
            </div>
            <div class="col-md">
                <label>New Password</label>
                <input type="Password" class="form-control" name="newpass" />
            </div>
            <div class="col-md">
                <label>Confirm New Password</label>
                <input type="Password" class="form-control" name="newrepass" />
            </div>
            <div class="col-md col-auto d-flex">
                <input type="submit" value="Save" name="save" class="btn btn-primary mt-auto" />
            </div>
        </form>
    </div>

    <div class="container mt-5 rounded <?php echo $msgcls; ?>">
        <span class="text-white"><?php echo $msg; ?></span>
    </div>
</body>
</html>