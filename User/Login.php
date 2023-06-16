<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    
    include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";

    $_SESSION['uid'] = "";
    $_SESSION['uname'] = "";
    $_SESSION['type'] = "";
    $msg = "";

    if(!isset($_COOKIE['cart'])){
        setcookie('cart', '0x', time() + (86400 * 7), "/");
    }

    if(isset($_POST['email']) and isset($_POST['pass'])){
        $uemail=$_POST['email'];
        $upass=$_POST['pass'];

        $sql="select * from user_master where user_email = '$uemail' and user_pass = '$upass'";
        $result=mysqli_query($con,$sql);
        if($result and mysqli_num_rows($result) > 0){
            while($row=mysqli_fetch_assoc($result)){

                if($row['user_status'] == "Active"){
                    $_SESSION['uid'] = $row['user_id'];
                    $_SESSION['utype'] = $row['user_type'];
                    $_SESSION['uname'] = $row['user_name'];
                    header('location:/');
                }
                else{
                    $msg = "Your account is blocked.<br/>Reach out to our customer care via email.";
                }
                
            }
            
        }
        else{
            $msg = "Email or Password is incorrect";
        }
    }
    
    include $_SERVER['DOCUMENT_ROOT']."/assets/_Header.php"; ?>
    <title>Ceramica</title>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT']."/assets/_Nav_Loader.php"; ?>

    <div class="container my-5">
        <div class="d-flex justify-content-center">
            <div class="border p-5 rounded-3 " style="width: 500px;">
                <h1><b>Login</b></h1>
                <hr/>
                <form class="row g-4" method="POST">
                    <div class="col-md-12">
                        <label class=" label">Email ID</label>
                        <input type="email" class="form-control" name="email" required/>
                    </div>
                    <div class="col-md-12">
                        <label class=" label">Password</label>
                        <input type="password" class="form-control" name="pass" required/>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary w-100">Login</button>
                    </div>
                </form>
                <br/>
                Don't have an account? <a href="/User/SignUp.php">Create New</a>
                <br/>
                <?php
                    echo "<span class='text-danger'>$msg</span>";
                ?>
            </div>
        </div>
    </div>
</body>
</html>