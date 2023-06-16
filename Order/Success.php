<!DOCTYPE html>
<html lang="en">
<head>
    <?php include $_SERVER['DOCUMENT_ROOT']."/assets/_Header.php"; 
    
        if(!isset($_GET['q'])){
            header('location:/');
        }

    ?>
    <title>Ceramica</title>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT']."/assets/_Nav_Loader.php"; ?>

    <div class="container border border-success rounded-3 p-5 my-5">
        <h1 class="text-success"><b>Thank you for shopping.</b><br/>Your order has been placed successfully.</h1>
        <b>Your order number #<?php echo $_GET['q']; ?> is placed.</b><br/>
        We will contact you soon for confirmation and shipping details.<br/>
        Meanwhile you can view your order history <a href="/Orders">here.</a>
    </div>

    <div class="container">
        <br />
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/assets/Images_Promo/1.jpg" class="d-block w-100" alt="Floor Tiles">
                </div>
                <div class="carousel-item">
                    <img src="/assets/Images_Promo/2.jpg" class="d-block w-100" alt="Wall Tiles">
                </div>
                <div class="carousel-item">
                    <img src="/assets/Images_Promo/3.jpg" class="d-block w-100" alt="Bathroom Tiles">
                </div>
                <div class="carousel-item">
                    <img src="/assets/Images_Promo/4.jpg" class="d-block w-100" alt="Kitchen Tiles">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


        <br />
        <div class="row g-0">
            <div class="col-md-6">
                <a href="#"><img src="/assets/Images_Home/1.jpg" class="d-block w-100" alt="Tiles"></a>
            </div>
            <div class="col-md-6">
                <a href="#"><img src="/assets/Images_Home/2.jpg" class="d-block w-100" alt="Tiles"></a>
            </div>
            <div class="col-md-6">
                <a href="#"><img src="/assets/Images_Home/3.jpg" class="d-block w-100" alt="Tiles"></a>
            </div>
            <div class="col-md-6">
                <a href="#"><img src="/assets/Images_Home/4.jpg" class="d-block w-100" alt="Tiles"></a>
            </div>
            <div class="col-md-3">
                <a href="#"><img src="/assets/Images_Home/5.jpg" class="d-block w-100" alt="Tiles"></a>
            </div>
            <div class="col-md-3">
                <a href="#"><img src="/assets/Images_Home/6.jpg" class="d-block w-100" alt="Tiles"></a>
            </div>
            <div class="col-md-3">
                <a href="#"><img src="/assets/Images_Home/7.jpg" class="d-block w-100" alt="Tiles"></a>
            </div>
            <div class="col-md-3">
                <a href="#"><img src="/assets/Images_Home/8.jpg" class="d-block w-100" alt="Tiles"></a>
            </div>
        </div>
    </div>

    <?php include $_SERVER['DOCUMENT_ROOT']."/assets/_Footer.php"; ?>
</body>
</html>