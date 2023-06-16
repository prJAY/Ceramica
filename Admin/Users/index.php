<?php include $_SERVER['DOCUMENT_ROOT']."/auth_admin.php"; 
    if(isset($_GET['q'])){
        $stat = $_GET['q'];
    }
    else{
        $stat = "Active";
    }
    if($stat == "Active"){
        $altstat = "Block";
        $bg = "danger";
    }
    else{
        $altstat = "Active";
        $bg = "success";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include $_SERVER['DOCUMENT_ROOT']."/assets/_Header.php"; 
    include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";
    ?>
    <title>Ceramica</title>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT']."/assets/_Nav_Loader.php"; ?>

    <div class="container mt-5">
        <h1><b>User List</b></h1>
        <hr/>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $sql="select * from user_master where user_status='$stat'";
                $result=mysqli_query($con,$sql);
                if($result){
                    while($row=mysqli_fetch_assoc($result)){
                        $uid = $row['user_id'];
                        $uname = $row['user_name'];
                        $uemail= $row['user_email'];
                        $ucno= $row['user_cno'];
                        $ustatus= $row['user_status'];

                        $btn = "";
                        if($row['user_type'] == "C"){
                            $btn = '<a href="/Admin/Users/ChangeUser.php?q='.$uid.'&stat='.$altstat.'" class="btn btn-sm btn-outline-'.$bg.'">'.$altstat.'</a>';
                        }

                        echo '
                        <tr>
                            <td>'.$uname.'</td>
                            <td>'.$uemail.'</td>
                            <td>'.$ucno.'</td>
                            <td>'.$ustatus.'</td>
                            <td>'.$btn.'</td>
                        </tr>
                        ';
                    }
                }
                
                ?>
            </tbody>

        </table>
    </div>
</body>
</html>