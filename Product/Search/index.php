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
<body>
<?php include $_SERVER['DOCUMENT_ROOT']."/assets/_Nav_Loader.php"; ?>

    <div class="container mt-5">
        <form>
        <div class="d-flex justify-content-between">
            <b class="fs-1">Here's what we found</b>
            <div class="d-flex">
            <select class="form-select my-auto" style="width: 150px;" name="sort">
                <option value="id desc">Newest</option>
                <option value="name">A to Z</option>
                <option value="price">Price Low to High</option>
                <option value="price desc">Price High to Low</option>
            </select>
            <button class="btn ms-1 my-auto btn-sm btn-outline-dark">Apply</button>
            </div>
        </div>
        <hr/>
        <br/>
        <br/>
        </form>
    </div>

			<?php
                $sql="select * from product_master";
                if(isset($_GET['q'])){
                    $param = $_GET['q'];
                    $sql .= " where name like '%$param%'";
                }
                else if(isset($_GET['cata'])){
                    $param = $_GET['cata'];
                    $sql .= " where catagory like '%$param%'";
                }
                if(isset($_GET['sort'])){
                    $param = $_GET['sort'];
                    $sql .= " order by $param";
                }

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
						<div class="container shadow-sm my-2 p-3">
							<div class="row">
                                <img src="'.$imgpath.'" class="col-md-3"/>
                                <div class="col-md">
                                    <table class="table table-borderless h-100">
                                        <tr>
                                            <td colspan="3"><h1>'.$name.' <span class="fs-5"> ( '.$cata.' )</span></h1></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><h4 class="text-success">'.$price.'.00/-</h4></td>
                                        </tr>
                                        <tr class="h-50">
                                            <td>Color: '.$color.'</td>
                                            <td>Material: '.$material.'</td>
                                            <td>Finish: '.$finish.'</td>
                                        </tr>
                                        <tr class="h-50">
                                            <td colspan="3">
                                                <a href="/Product/Details.php?q='.$pid.'" class="btn btn-outline-dark">View</a>
                                                <form action="/Cart/addtocart.php" method="POST" class="d-inline-block">
                                                    <input type="hidden" name="pid" value="'.$pid.'"/>
                                                    <input type="hidden" name="qty" value="1"/>
                                                    <input type="submit" name="submit" class="btn btn-success" value="Add to cart" />
                                                </form>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
						</div>';
					}
                    if(mysqli_num_rows($result) == 0){
                        echo '<div class="container my-2 p-3">
                                <i>we could not find what you are looking for. Try diffrent search term.</i></div>';
                    }
				}
			?>
            
    
            <?php include $_SERVER['DOCUMENT_ROOT']."/assets/_Footer.php"; ?>
</body>
</html>