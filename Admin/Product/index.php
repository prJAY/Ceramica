<?php include $_SERVER['DOCUMENT_ROOT']."/auth_admin.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include $_SERVER['DOCUMENT_ROOT']."/assets/_Header.php"; 
        include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";
        
        $uid = $_SESSION['uid'];
    ?>
    <title>Ceramica</title>
</head>
<body class="bg-light">
<?php include $_SERVER['DOCUMENT_ROOT']."/assets/_Nav_Loader.php"; ?>

    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <b class="fs-1">Product List</b>
            <a class="btn btn-primary my-auto" href="/Admin/Product/New.php">+Add New</a>
        </div>
        <hr/>
        <br/>
        <br/>
    </div>

			<?php
				$sql="select * from product_master";
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
                        
                        echo'
						<div class="container bg-white shadow-sm my-2 p-3">
							<div class="row">
                                <img src="'.$imgpath.'" class="col-md-3 "/>
                                <div class="col-md">
                                    <table class="table">
                                        <tr>
                                            <td colspan="2"><h1>'.$name.' <span class="fs-5"> ( '.$cata.' )</span></h1></td>
                                            <td align="right">
                                            <a href="/Admin/Product/Edit.php?q='.$pid.'" class="btn btn-primary">Edit</a>
                                            <a href="/Product/Details.php?q='.$pid.'" class="btn btn-secondary">View</a>
                                            </td>
                                        </tr>
                                        <tr>
                                        <td colspan="3"><h4 class="text-success">'.$price.'.00/-</h4></td>
                                        </tr>
                                        <tr>
                                            <td>Color: '.$color.'</td>
                                            <td>Material: '.$material.'</td>
                                            <td>Finish: '.$finish.'</td>
                                        </tr>
                                        <tr>
                                            <td>Size: '.$size.'</td>
                                            <td>Thickness: '.$thickness.'</td>
                                            <td>Stock: '.$stock.'</td>
                                        </tr>
                                        <tr>
                                        <td colspan="3">'.$details.'</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
						</div>';
					}
                    if(mysqli_num_rows($result) == 0){
                        echo '<tr><td class="text-muted" colspan="7"><i>No address found</i></td></tr>';
                    }
				}
			?>
            
            <?php include $_SERVER['DOCUMENT_ROOT']."/assets/_Footer.php"; ?>
</body>
</html>