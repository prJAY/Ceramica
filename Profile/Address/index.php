<?php include $_SERVER['DOCUMENT_ROOT']."/auth.php"; ?>
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
        <div class="d-flex justify-content-between">
            <b class="fs-1">Address Book</b>
            <a class="btn btn-primary my-auto" href="/Profile/Address/New.php">+Add New</a>
        </div>
        <hr/>
        <br/>
        <br/>
        <div class="table-responsive">
        <table class="table table-hover" style="min-width:max-content;">
		<thead>
			<tr>
				<th>Name</th>
				<th>Contact</th>
				<th>Address</th>
                <th>Pincode</th>
				<th>City</th>
				<th>State</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$sql="select * from address_master where user_id = $uid";
				$result=mysqli_query($con,$sql);
				if($result){
					while($row=mysqli_fetch_assoc($result)){
						$aid=$row['id'];
						$name=$row['name'];
						$cno=$row['contact'];
                        $add=$row['line1'].','.$row['line2'];
                        $pin=$row['pin'];
						$city=$row['city'];
						$state=$row['state'];
                        
                        echo'
						<tr>
							<td>'.$name.'</td>
							<td>'.$cno.'</td>
							<td>'.$add.'</td>
                            <td>'.$pin.'</td>
							<td>'.$city.'</td>
							<td>'.$state.'</td>
							<td><a href="/Profile/Address/Edit.php?q='.$aid.'">Edit</a></td>
						</tr>';
					}
                    if(mysqli_num_rows($result) == 0){
                        echo '<tr><td class="text-muted" colspan="7"><i>No address found</i></td></tr>';
                    }
				}
			?>
		</tbody>
        </table>
        </div>
    </div>
</body>
</html>