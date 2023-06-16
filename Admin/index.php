<?php include $_SERVER['DOCUMENT_ROOT']."/auth_admin.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/assets/_Header.php"; ?>
    <title>Ceramica</title>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT']."/assets/_Nav_Loader.php"; ?>

    <div class="container my-5">
        <h1><b>Product Management</b></h1>
        <hr/>
        <a href="/Admin/Product/New.php" class="btn btn-dark rounded-0">+ Add Product</a>
        <a href="/Admin/Product/" class="btn btn-outline-dark rounded-0">View Products</a>
    </div>

    <div class="container my-5">
        <h1><b>Order Management</b></h1>
        <hr/>
        <a href="/Admin/Orders/" class="btn btn-dark rounded-0">View All</a>

        <div class="row w-100 mx-auto my-3">
            <a class="col-md-2 btn btn-outline-dark rounded-0 " href="/Admin/Orders/?stat=Received" class="text-decoration-none text-dark stretched-link">Received</a>
            <a class="col-md-2 btn btn-outline-dark rounded-0 " href="/Admin/Orders/?stat=Processing" class="text-decoration-none text-dark stretched-link">Processing</a>
            <a class="col-md-2 btn btn-outline-dark rounded-0 " href="/Admin/Orders/?stat=Shipped" class="text-decoration-none text-dark stretched-link">Shipped</a>                    
            <a class="col-md-2 btn btn-outline-dark rounded-0 " href="/Admin/Orders/?stat=Completed" class="text-decoration-none text-dark stretched-link">Completed</a>
            <a class="col-md-2 btn btn-outline-dark rounded-0 " href="/Admin/Orders/?stat=Cancellation Requested" class="text-decoration-none text-dark stretched-link">Requested</a>
            <a class="col-md-2 btn btn-outline-dark rounded-0 " href="/Admin/Orders/?stat=Cancelled" class="text-decoration-none text-dark stretched-link">Cancelled</a>
        </div>
    </div>

    <div class="container my-5">
        <h1><b>User Management</b></h1>
        <hr/>
        <a href="/Admin/Users/" class="btn btn-dark rounded-0">View Active Users</a>
        <a href="/Admin/Users/?q=Block" class="btn btn-outline-dark rounded-0">View Blocked Users</a>
    </div>
</body>
</html>