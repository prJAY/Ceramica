<?php

include $_SERVER['DOCUMENT_ROOT']."/auth.php"; 
include $_SERVER['DOCUMENT_ROOT']."/dbconfig.php";

if(isset($_GET['q']) && isset($_GET['stat']) && isset($_GET['rtn'])){
    $oid = $_GET['q'];
    $stat = $_GET['stat'];
    $rtn = $_GET['rtn'];
}
else{
    header('location:/');
    exit;
}

$sql="update order_items set status = '$stat' where id = '$oid'";
$result=mysqli_query($con,$sql);
if($result){
    header('location:/Admin/Orders/View.php?q='.$rtn);
}
else{
    header('location:/');
}
?>