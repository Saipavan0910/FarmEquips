<!DOCTYPE html>
<html lang="en">
<?php

session_start();
$farmer_id = $_SESSION['farmer_id'];

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Cart</title>
    <link rel="stylesheet" href="styles.css">
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.8.1/css/all.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/4e97f0f302.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>

    <style>
    ::-webkit-scrollbar {
      width: 8px;
    }

    ::-webkit-scrollbar-track {
      background: #f1f1f1; 
    }

    *{margin: 0;padding: 0}body{overflow-x: hidden}#bg-div{margin: 0;margin-top:100px;margin-bottom:100px}#border-btm{padding-bottom: 20px;margin-bottom: 0px;box-shadow: 0px 35px 2px -35px lightgray}#test{margin-top: 0px;margin-bottom: 40px;border: 1px solid #FFE082;border-radius: 0.25rem;width: 60px;height: 30px;background-color: #FFECB3}.active1{color: #00C853 !important;font-weight: bold}.bar4{width: 35px;height: 5px;background-color: #ffffff;margin: 6px 0}.list-group .tabs{color: #000000}#menu-toggle{height: 50px}#new-label{padding: 2px;font-size: 10px;font-weight: bold;background-color: red;color: #ffffff;border-radius: 5px;margin-left: 5px}#sidebar-wrapper{min-height: 100vh;margin-left: -15rem;-webkit-transition: margin .25s ease-out;-moz-transition: margin .25s ease-out;-o-transition: margin .25s ease-out;transition: margin .25s ease-out}#sidebar-wrapper .sidebar-heading{padding: 0.875rem 1.25rem;font-size: 1.2rem}#sidebar-wrapper .list-group{width: 15rem}#page-content-wrapper{min-width: 100vw;padding-left: 20px;padding-right: 20px}#wrapper.toggled #sidebar-wrapper{margin-left: 0}.list-group-item.active{z-index: 2;color: #fff;background-color: #fff !important;border-color: #fff !important}@media (min-width: 768px){#sidebar-wrapper{margin-left: 0}#page-content-wrapper{min-width: 0;width: 100%}#wrapper.toggled #sidebar-wrapper{margin-left: -15rem;display: none}}.card0{margin-top: 10px;margin-bottom: 10px}.top-highlight{color: #00C853;font-weight: bold;font-size: 20px}.form-card input, .form-card textarea{padding: 10px 15px 5px 15px;border: none;border: 1px solid lightgrey;border-radius: 6px;margin-bottom: 25px;margin-top: 2px;width: 100%;box-sizing: border-box;font-family: arial;color: #2C3E50;font-size: 14px;letter-spacing: 1px}.form-card input:focus, .form-card textarea:focus{-moz-box-shadow: 0px 0px 0px 1.5px skyblue !important;-webkit-box-shadow: 0px 0px 0px 1.5px skyblue !important;box-shadow: 0px 0px 0px 1.5px skyblue !important;font-weight: bold;border: 1px solid skyblue;outline-width: 0}input.btn-success{height: 50px;color: #ffffff;opacity: 0.9}#below-btn a{font-weight: bold;color: #000000}.input-group{position:relative;width:100%;overflow:hidden}.input-group input{position:relative;height:90px;margin-left: 1px;margin-right: 1px;border-radius:6px;padding-top: 30px;padding-left: 25px}.input-group label{position:absolute;height: 24px;background: none;border-radius: 6px;line-height: 48px;font-size: 15px;color: gray;width:100%;font-weight:100;padding-left: 25px}input:focus + label{color: #1E88E5}#qr{margin-bottom: 150px;margin-top: 50px}

    .col-md-10 {
        padding: 15px;
    }

    body {
        background: #eee;
    }

    .container {
        margin-left: 30px !important;
        max-width: 2000px;
        padding: 12px;
        width: 100%;
    }

    .custom-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: darkcyan;
        padding: 20px;
        margin: -4vh 0;
    }

    .logo img {
        height: 85px;
        border-radius: 50%;
    }

    header {
        background-color: darkcyan;
        color: rgb(4, 4, 4);
        padding: 0px;
        width: 81rem;
    }

    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 95%;
    }

    header img {
        height: 70px;
        border-radius: 50%;
    }

    .cart a {
        margin-bottom: 10px;
        text-decoration: none;
        color: white;
        font-size: 20px;
        border: 1px solid black;
        padding: 10px;
        border-radius: 5px;
        margin-right: 30px;
    }

    .ratings i {
        font-size: 16px;
        color: red;
    }

    .strike {
        color: red;
        text-decoration: line-through;
    }

    .product-img {
        width: 100%;
    }

    .dot {
        height: 7px;
        width: 7px;
        margin-left: 6px;
        margin-right: 6px;
        margin-top: 3px;
        background-color: darkcyan;
        border-radius: 50%;
        display: inline-block;
    }

    .spec {
        color: #938787;
        font-size: 15px;
    }

    h5 {
        font-weight: 400;
    }

    .description {
        font-size: 16px;
    }

    p {
        overflow: revert !important;
        white-space: normal !important;
    }

    .subtotal,
    .shipping,
    .estimated-tax,
    .order-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .custom-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: darkcyan;
        padding: 20px;
        margin: -4vh 0;
    }

    .estimated-delivery,
    .return-policy,
    .customer-service {
        display: inline-block;
        margin-right: 20px;
    }

    .estimated-delivery span:last-child,
    .return-policy a,
    .customer-service a {
        font-weight: bold;
    }

    .product-card {
        max-width: 800px;
        margin: 0px;
    }

    .cart-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        height: 45vh;
        width: 100%;
    }

    .cart-summary {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        border-top: 2px solid #ccc;
        padding: 10px;
    }

    .checkout-button {
        text-align: center;
    }

    .checkout-button a {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
    }

    *{
        scroll-behavior: smooth;
    }
    </style>

    <script>
        function updateStatus(vehicleId){
            console.log(vehicleId);
            const result = confirm("Are you sure you want to place this order ?");

            if(result){
                const url = "orderStatus.php?vehicle_id="+vehicleId ;
                window.location.href = url;
            }
        }
    </script>
</head>

<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <img src="./images/equipment/logo.png" alt="Company Logo">
                </div>
                    <div class="cart">
                        <a href="Equip.html"><i class="icon fa-solid fa-tractor"></i></a>
                        <a href="profile.php" class="icon"><i class="fa-solid fa-user"></i></a>
                    </div>
            </div>
        </div>
    </header>

    <div class="w-100 d-flex flex-row justify-content-around">
        <div class="d-flex flex-column" style="width: 65%;">
            <div class="container m-4">
                <div class="w-100 d-flex justify-content-around row">
                    <?php
                    include_once "connection.php";
                    
                    // Check if the form is submitted for item removal
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['lineId'])) {
                        $lineId = mysqli_real_escape_string($conn, $_POST['lineId']);

                        // Delete the item from the cart
                        $deleteQuery = "DELETE FROM line_item WHERE line_id = '$lineId'";
                        mysqli_query($conn, $deleteQuery);
                    }

                    $status = mysqli_query($conn, "SELECT * FROM `order` WHERE farmer_id = $farmer_id AND `status` = 'In Cart'");
                    $row = mysqli_fetch_assoc($status);
                    
                    if($row == null){
                        $orderId = -1;
                    }
                    else{
                        $orderId = $row['order_id'];
                        
                    }

                    $orderStatus = mysqli_query($conn, "SELECT vehicle_id FROM line_item WHERE order_id = $orderId");
                    $orderRow = mysqli_fetch_assoc($orderStatus);

                    $query = "SELECT l.line_id, l.order_id, l.vehicle_id, l.start_date, l.end_date, l.price, v.model, v.description, v.image
                              FROM line_item l 
                              INNER JOIN vehicle v ON l.vehicle_id = v.vehicle_id AND l.order_id = $orderId";

                    $result = mysqli_query($conn, $query);

                    $subtotal = 0;

                    // Check if there are any cart items
                    if (mysqli_num_rows($result) > 0) {
                        // Loop through cart items
                        while ($row = mysqli_fetch_assoc($result)) {
                            $lineId = $row['line_id'];
                            $vehicleId = $row['vehicle_id'];
                            $startDate = $row['start_date'];
                            $endDate = $row['end_date'];
                            $pricePerDay = $row['price'];
                            $model = $row['model'];
                            $description = $row['description'];
                            $image = $row['image'];

                            $start = new DateTime($startDate);
                            $end = new DateTime($endDate);
                            $interval = $start->diff($end);
                            $numDays = $interval->days + 1;

                            // Add item price to subtotal
                            $totalPrice = $pricePerDay * $numDays;
                            $subtotal += $totalPrice;

                            // Generate HTML for each cart item
                            echo "<div class='col-md-10'>";
                            echo "<div class='row p-2 bg-white border rounded product-card'>";
                            echo "<div class='col-md-3 mt-1'>";
                            echo "<img class='img-fluid img-responsive rounded product-image' src='$image'>";
                            echo "</div>";
                            echo "<div class='col-md-6 mt-1'>";
                            echo "<h4>$model</h4>";
                            echo "<div class='d-flex flex-row'>";
                            echo "<div class='ratings mr-2'><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></div><span>310</span>";
                            echo "</div>";
                            echo "<div>";
                            echo "<p class='text-justify text-truncate para mb-0'>$description<br><br></p>";
                            echo "</div>";
                            echo "</div>";
                            echo "<div class='align-items-center align-content-center col-md-3 border-left mt-1'>";
                            echo "<div class='d-flex flex-row align-items-center'>";
                            echo "<h6 class='mr-1'> ₹ $totalPrice</h6>";
                            echo "</div>";
                            echo "<div class='d-flex flex-column mt-4' style='margin-top: 0px !important;'>";
                            echo "<h6>Start date: $startDate</h6>";
                            echo "<h6>End date: $endDate</h6>";
                            echo "<form action='remove_cart.php' method='post'>";
                            echo "<input type='hidden' name='lineId' value='$lineId'>";
                            echo "<button class='btn btn-danger btn-sm' type='submit'>Remove</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No items in the cart.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="w-25">
            <!-- Your cart summary and checkout button -->
            <div class="w-25">
                <div class="cart-container mt-5">
                    <div class="row" style="width: 40rem; justify-content: space-around; margin: 0px !important;">
                        <div class="col-md-6" style="margin-left: 40px;">
                            <div class="cart-summary">
                                <div class="subtotal">
                                    <span>Subtotal:</span>
                                    <span>₹<?php echo $subtotal; ?></span>
                                </div>
                                
                                <?php
                            
                                $status = mysqli_query($conn,"SELECT * from farmer");
                                $row = mysqli_fetch_assoc($status);
                                $farmer_id = $row['farmer_id']; 
                                
                                $incomeQuery = "SELECT income FROM farmer WHERE farmer_id = '$farmer_id'";
                                $incomeResult = mysqli_query($conn, $incomeQuery);
                                if ($incomeResult && mysqli_num_rows($incomeResult) > 0) {
                                    $incomeRow = mysqli_fetch_assoc($incomeResult);
                                    $income = $incomeRow['income'];

                                    // Calculate subsidy amount based on the user's income
                                    $subsidy_amount = 0;
                                    if ($income < 100000) {
                                        $subsidy_amount = $subtotal * 0.70; 
                                    } elseif ($income >= 100000 && $income < 200000) {
                                        $subsidy_amount = $subtotal * 0.50; 
                                    } elseif ($income >= 200000 && $income < 400000) {
                                        $subsidy_amount = $subtotal * 0.30; 
                                    } elseif ($income >= 400000) {
                                        $subsidy_amount = $subtotal * 0.10; 
                                    }
                                    ?>
                                    <div class="estimated-tax">
                                        <span>Estimated Subsidy :</span>
                                        <span style="color: red;"> - ₹<?php echo $subsidy_amount; ?></span>
                                    </div>
                                <?php } ?>


                                <div class="order-total">
                                    <span>Order Total:</span>
                                    <span>₹<?php $Total= $subtotal - $subsidy_amount; echo $Total?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="checkout-button mt-3 w-100">
                            <a href="#paywall" class="btn btn-primary">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Checkout Section --> 
    <div class="container-fluid px-0" id="bg-div">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-12" id="paywall">
            <div class="card card0">
                <div class="d-flex" id="wrapper">
                    <!-- Sidebar -->
                    <div class="bg-light border-right" id="sidebar-wrapper">
                        <div class="sidebar-heading pt-5 pb-4"><strong>PAY WITH</strong></div>
                        <div class="list-group list-group-flush"> <a data-toggle="tab" href="#menu1" id="tab1" class="tabs list-group-item bg-light">
                                <div class="list-div my-2">
                                    <div class="fa fa-home"></div> &nbsp;&nbsp; Bank
                                </div>
                            </a> <a data-toggle="tab" href="#menu2" id="tab2" class="tabs list-group-item active1">
                                <div class="list-div my-2">
                                    <div class="fa fa-credit-card"></div> &nbsp;&nbsp; Card
                                </div>
                            </a> <a data-toggle="tab" href="#menu3" id="tab3" class="tabs list-group-item bg-light">
                                <div class="list-div my-2">
                                    <div class="fa fa-qrcode"></div> &nbsp;&nbsp;&nbsp; Visa QR <span id="new-label">NEW</span>
                                </div>
                            </a> </div>
                    </div> <!-- Page Content -->
                    <div id="page-content-wrapper">
                        <div class="row pt-3" id="border-btm">
                            <div class="col-4"> <button class="btn btn-success mt-4 ml-3 mb-3" id="menu-toggle">
                                    <div class="bar4"></div>
                                    <div class="bar4"></div>
                                    <div class="bar4"></div>
                                </button> </div>
                            <div class="col-8">
                                <div class="row justify-content-right">
                                    <div class="col-12">
                                        <p class="mb-0 mr-4 mt-4 text-right">farmflow.support@gmail.com</p>
                                    </div>
                                </div>
                                <div class="row justify-content-right">
                                    <div class="col-12">
                                        <p class="mb-0 mr-4 text-right"><span class="top-highlight" id="first"></span> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="text-center" id="test">Pay</div>
                        </div>
                        <div class="tab-content">
                            <div id="menu1" class="tab-pane">
                                <div class="row justify-content-center">
                                    <div class="col-11">
                                        <div class="form-card">
                                            <h3 class="mt-0 mb-4 text-center">Enter bank details to pay</h3>
                                            <form>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="input-group"> <input type="text" id="bk_nm" placeholder="BBB Bank"> <label>BANK NAME</label> </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="input-group"> <input type="text" name="ben_nm" id="ben-nm" placeholder="John Smith"> <label>BENEFICIARY NAME</label> </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="input-group"> <input type="text" name="scode" placeholder="ABCDAB1S" class="placeicon" minlength="8" maxlength="11"> <label>SWIFT CODE</label> </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12"> <button type="submit" style="width: 125px; height: 38px; margin-left: 240px; margin-bottom: 15px;" onclick="updateStatus(<?php echo $orderRow['vehicle_id']; ?>)" id="submit-btn" class="btn btn-success placeicon"> ₹<?php echo $Total; ?></button></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p class="text-center mb-5" id="below-btn"><a href="./Equip.html">Back To Home Page</a></p>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="menu2" class="tab-pane in active">
                                <div class="row justify-content-center">
                                    <div class="col-11">
                                        <div class="form-card">
                                            <h3 class="mt-0 mb-4 text-center">Enter your card details to pay</h3>
                                            <form onsubmit="event.preventDefault()">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="input-group"> <input type="text" id="cr_no" placeholder="0000 0000 0000 0000" minlength="19" maxlength="19"> <label>CARD NUMBER</label> </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="input-group"> <input type="text" name="exp" id="exp" placeholder="MM/YY" minlength="5" maxlength="5"> <label>CARD EXPIRY</label> </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="input-group"> <input type="password" name="cvcpwd" placeholder="&#9679;&#9679;&#9679;" class="placeicon" minlength="3" maxlength="3"> <label>CVV</label> </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12"><button type="submit" style="width: 125px; height: 38px; margin-left: 240px; margin-bottom: 15px;" onclick="updateStatus(<?php echo $orderRow['vehicle_id']; ?>)" id="submit-btn" class="btn btn-success placeicon"> ₹<?php echo $Total; ?></button></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p class="text-center mb-5" id="below-btn"><a href="./Equip.html">Back To Home Page</a></p>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="menu3" class="tab-pane">
                                <div class="row justify-content-center">
                                    <div class="col-11">
                                        <h3 class="mt-0 mb-4 text-center">Scan the QR code to pay</h3>
                                        <div class="row justify-content-center">
                                            <div id="qr"> <img src="https://i.imgur.com/DD4Npfw.jpg" width="200px" height="200px"> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function(){
    //Menu Toggle Script
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    // For highlighting activated tabs
    $("#tab1").click(function () {
        $(".tabs").removeClass("active1");
        $(".tabs").addClass("bg-light"); 
        $("#tab1").addClass("active1");
        $("#tab1").removeClass("bg-light");
    });
    $("#tab2").click(function () {
        $(".tabs").removeClass("active1");
        $(".tabs").addClass("bg-light");
        $("#tab2").addClass("active1");
        $("#tab2").removeClass("bg-light");
    });
    $("#tab3").click(function () {
        $(".tabs").removeClass("active1");
        $(".tabs").addClass("bg-light");
        $("#tab3").addClass("active1");
        $("#tab3").removeClass("bg-light");
    });
})
</script>

</body>
</html>