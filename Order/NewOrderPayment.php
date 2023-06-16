<?php include $_SERVER['DOCUMENT_ROOT']."/auth.php"; 

    if(isset($_POST['submit']) && isset($_POST['addr']) && isset($_SESSION['subtot'])){
        $addr = $_POST['addr'];
        $sub = $_SESSION['subtot'];
    }
    else{
        header('location:/');
        exit;
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
    <nav class="navbar bg-success text-light p-3">
        <span class="text-center w-100">Ceramica</span>
    </nav>
    <br/>
    <div class="d-flex justify-content-center">
        <div class="d-grid">
            <div class="btn btn-success rounded-0 m-auto mb-2">
                Step 1
            </div>
            <span>Select Address
            <svg xmlns="http://www.w3.org/2000/svg" style="height: 20px;" class="text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            </span>
        </div>
        <hr class="w-25 bg-success" style="height: 3px;"/>
        <div class="d-grid">
            <div class="btn btn-success rounded-0 m-auto mb-2">
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
            <b class="fs-1">Select Payment Option</b>
        </div>
        <hr/>
        <span><b class="fs-3 text-success">Amount : <?php echo $sub; ?></b> (Shipping charges may apply)</span>
        <form action="NewOrderConfirm.php" method="POST" class="my-5">
            <input type="hidden" name="addr" value="<?php echo $addr; ?>" />
            <h5 class="my-3"><b>Available Options</b></h5>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payopt" value="cash" id="flexRadioDefault1" checked>
                <label class="form-check-label" for="flexRadioDefault1">
                    Cash on delivery
                </label>
            </div>
            <h5 class="my-3"><b>Currently Unavailable</b></h5>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payopt" value="upi" id="flexRadioDefault2" disabled>
                <label class="form-check-label" for="flexRadioDefault2">
                    UPI
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payopt" value="card" id="flexRadioDefault3" disabled>
                <label class="form-check-label" for="flexRadioDefault3">
                    Credit Card / Debit Card
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payopt" value="netbanking" id="flexRadioDefault4" disabled>
                <label class="form-check-label" for="flexRadioDefault4">
                    Netbanking
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="payopt" value="emi" id="flexRadioDefault5" disabled>
                <label class="form-check-label" for="flexRadioDefault5">
                    EMI
                </label>
            </div>
            <br/>
            <hr/>
            <input type="submit" name="submit" value="Continue" class="btn btn-primary float-end"/>
        </form>
    </div>
</body>
</html>