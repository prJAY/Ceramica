<?php include $_SERVER['DOCUMENT_ROOT']."/auth.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include $_SERVER['DOCUMENT_ROOT']."/assets/_Header.php"; 
        include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";
    ?>
    <link rel="stylesheet" href="/css/radio.css"/>
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
            <span>Select Address</span>
        </div>
        <hr class="w-25" style="height: 3px;"/>
        <div class="d-grid">
            <div class="btn btn-outline-dark rounded-0 m-auto mb-2">
                Step 2
            </div>
            <span>Select Payment</span>
        </div>
        <hr class="w-25" style="height: 3px;"/>
        <div class="d-grid">
            <div class="btn btn-outline-dark rounded-0 m-auto mb-2">
                Step 3
            </div>
            <span>Confirm Order</span>
        </div>
    </div>

    <br/>
    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <b class="fs-1">Select Shipping Address</b>
            <a class="btn btn-outline-dark my-auto" href="/Profile/Address/New.php">+Add New</a>
        </div>
        <hr/>
        <br/>
        <br/>
        <form action="NewOrderPayment.php" method="POST">
            <div class="wrapper">
			<?php
                $uid = $_SESSION['uid'];
				$sql="select * from address_master where user_id = $uid";
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
						<input type="radio" name="addr" value="'.$aid.'" id="option-'.$count.'" checked>
                        <label for="option-'.$count.'" class="mx-2 option option-'.$count.' p-4">
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
            </div>
            <br/>
            <br/>
            <hr/>
            <?php
                if($count > 0){
                    echo '<input type="submit" name="submit" value="Continue" class="btn btn-primary float-end"/>';
                }
            ?>
        </form>
    </div>
</body>
</html>