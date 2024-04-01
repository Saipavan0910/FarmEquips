<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/4e97f0f302.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Your CSS styles */

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
    </style>
</head>

<body>

    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <img src="logo.png" alt="Company Logo">
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
                    // Include database connection
                    include_once "connection.php";

                    // Check if the form is submitted for item removal
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['lineId'])) {
                        // Sanitize the input
                        $lineId = mysqli_real_escape_string($conn, $_POST['lineId']);

                        // Delete the item from the cart
                        $deleteQuery = "DELETE FROM line_item WHERE line_id = '$lineId'";
                        mysqli_query($conn, $deleteQuery);
                    }

                    // Query to fetch all cart items
                    $query = "SELECT l.line_id, l.vehicle_id, l.start_date, l.end_date, l.price, v.model, v.description 
                              FROM line_item l
                              INNER JOIN vehicle v ON l.vehicle_id = v.vehicle_id";

                    $result = mysqli_query($conn, $query);

                    // Initialize subtotal variable
                    $subtotal = 0;

                    // Check if there are any cart items
                    if (mysqli_num_rows($result) > 0) {
                        // Loop through cart items
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Extract data from the current row
                            $lineId = $row['line_id'];
                            $vehicleId = $row['vehicle_id'];
                            $startDate = $row['start_date'];
                            $endDate = $row['end_date'];
                            $price = $row['price'];
                            $model = $row['model'];
                            $description = $row['description'];

                            // Add item price to subtotal
                            $subtotal += $price;

                            // Generate HTML for each cart item
                            echo "<div class='col-md-10'>";
                            echo "<div class='row p-2 bg-white border rounded product-card'>";
                            echo "<div class='col-md-3 mt-1'>";
                            echo "<img class='img-fluid img-responsive rounded product-image' src='./Firefly tractor working in farm and harvesting rice and picking up 32529.jpg'>";
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
                            echo "<h6 class='mr-1'> ₹ $price/per day</h6>";
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
                        <div class="col-md-6">
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
                            <a href="checkout.php" class="btn btn-primary" style="width: 160px;">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  

</body>

</html>

