<?php

include $_SERVER['DOCUMENT_ROOT']."/auth.php"; 
include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";

if(isset($_GET['q'])){
    $oid = $_GET['q'];
}
else{
    header('location:/');
    exit;
}

$sql="update order_items set status = 'Cancellation Requested' where id = '$oid'";
$result=mysqli_query($con,$sql);
if($result){
    header('location:/Orders/');
}
else{
    header('location:/');
}
?>