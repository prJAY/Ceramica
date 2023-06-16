<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $msg = "";
    include $_SERVER['DOCUMENT_ROOT']."/assets/_Header.php";
    include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";
    if(isset($_POST['submit'])){
        $uname=$_POST['name'];
        $uemail=$_POST['email'];
        $ucno=$_POST['cno'];
        $upass=$_POST['pass'];
        $urepass=$_POST['repass'];

        if($upass == $urepass)
        {
            if(strlen($upass) > 7){
                $sql="insert into user_master (user_name,user_cno,user_email,user_pass,user_type,user_status) values ('$uname','$ucno','$uemail','$upass','C','Active')";
                $result=mysqli_query($con,$sql);
                if($result){
                    header('location:/User/Login.php');
                }else{
                    $msg = "Operation failed. Could not create account.";
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
<?php include $_SERVER['DOCUMENT_ROOT']."/assets/_Nav_Loader.php"; ?>

    <div class="container my-5">
        <div class="d-flex justify-content-center">
            <div class="border p-5 rounded-3 " style="width: 500px;">
                <h1><b>Sign Up</b></h1>
                <hr/>
                <form class="row g-4" method="POST">
                    <div class="col-md-12">
                        <label class=" label">Name</label>
                        <input type="text" class="form-control" name="name" required/>
                    </div>
                    <div class="col-md-12">
                        <label class=" label">Email</label>
                        <input type="email" class="form-control" name="email" required/>
                    </div>
                    <div class="col-md-12">
                        <label class=" label">Contact No</label>
                        <input type="number" class="form-control" name="cno" min="1000000000" max="9999999999" required/>
                    </div>
                    <div class="col-md-12">
                        <label class=" label">Create Password</label>
                        <input type="password" class="form-control" name="pass" required/>
                    </div>
                    <div class="col-md-12">
                        <label class=" label">Confirm Password</label>
                        <input type="password" class="form-control" name="repass" required/>
                    </div>
                    <div class="col-md-12">
                        <input type='submit' value="Sign Up" name='submit' class="btn btn-primary w-100"/>
                    </div>
                </form>
                <br/>
                Already have an account? <a href="/User/Login.php">Log In</a>
                <br/>
                <?php
                    echo "<span class='text-danger'>$msg</span>";
                ?>
            </div>
        </div>
    </div>
</body>
</html>