<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/4e97f0f302.js" crossorigin="anonymous"></script>

    <style>
        body {
            background: #eee;
        }

        .custom-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: darkcyan;
            padding: 0px;
            margin: 0px;
        }

        .logo {
            margin: 10px 10px 10px 25px;
            max-width: 90px;
            border-radius: 50%;
        }

        header img {
            height: 70px;
            border-radius: 50%;
        }

        .ratings i {
            font-size: 16px;
            color: red;
        }

        .strike {
            color: red;
            text-decoration: line-through;
        }

        .icon a {
            margin-bottom: 10px;
            text-decoration: none;
            color: white;
            font-size: 20px;
            border: 1px solid black;
            padding: 10px;
            border-radius: 5px;
            margin-right: 20px;
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

        p{
            overflow: revert !important; 
            white-space: normal !important;
        }

        #zoom {
            display: flex;
            transition: transform .4s;
            width: 90%;
            margin: auto;
            flex-direction: column;
        }       

        .single-catalog{
            transition: transform ease-in-out 120ms;
        }

        .single-catalog:hover {
            -ms-transform: scale(1.1);
            -webkit-transform: scale(1.1);
            transform: scale(1.1); 
            transition-duration: 200ms;
            align-content: center;
            transform-origin: center;
            -webkit-transform-origin: center;
            -ms-transform-origin: center;
        }

        #cart {
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            height: 15vh;
            width: 100%;
        }

        #cart button {
            background-color: darkcyan;
            border: 1.5px solid black;
            border-radius: 5px;
            height: 35px;
            width: 110px;
            color: #fff;
        }
        
    </style>
</head>

<body>
    <?php
        include_once "connection.php";
        $product_id = $_GET['product_id'];
        $status = mysqli_query($conn, "SELECT name FROM product WHERE product_id = '$product_id'");
        $row = mysqli_fetch_array($status);
    ?>
    <div class="custom-header">
        <img src="./images/equipment/logo.png" alt="Company Logo" class="logo">
        <h1 class="mb-4" style="text-align:center; color: white; margin-top: 20px;"><strong><?php echo $row['name']; ?></strong></h1>
        <div class="icon">
            <a href="cart_test.php"><i class="fa-solid fa-cart-shopping"></i></a>
            <a href="profile.php"><i class="fa-solid fa-user"></i></a>
        </div>
    </div>

    <div class="container mt-5 mb-5" style="margin-left: 65px !important;" id ="zoom">
    <?php
        session_start();
        $farmer_id = $_SESSION['farmer_id'];
        $user_id = $_SESSION['user_id'];
        $result = mysqli_query($conn, "SELECT
                    v.description,
                    v.price,
                    v.vehicle_id,
                    v.model, 
                    v.startdate, 
                    v.enddate, 
                    v.image
                FROM
                    vehicle AS v
                INNER JOIN OWNER AS o
                ON
                    v.owner_id = o.owner_id
                INNER JOIN user_details AS u
                ON
                    o.user_id = u.user_id
                WHERE
                    v.product_id = $product_id
                    AND u.location IN(SELECT location FROM user_details WHERE user_id = $user_id);");

        while($row = mysqli_fetch_array($result))
        {

    ?>
        <div class="d-flex justify-content-center row; single-catalog" style="width:100%; margin-right: auto; margin-top: 45px;">
            <div class="col-md-10">
                <div class="row p-2 bg-white border rounded">
                    <div class="col-md-3 mt-1" style="margin-bottom: 0px !important; padding-top: 15px !important; padding-bottom: 15px !important; margin-top: 0px !important;"><img class="img-fluid img-responsive rounded product-image" src="<?php echo $row['image']; ?>"></div>
                    <div class="col-md-6 mt-1">
                        <h4><?php echo $row['model']; ?></h4>
                        <div class="d-flex flex-row">
                            <div class="ratings mr-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div><span>310</span>
                        </div>
                        <div>
                            <p class="text-justify text-truncate para mb-0"><?php echo $row['description']; ?><br><br></p>
                        </div>
                    </div>
                    <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                        <div class="d-flex flex-row align-items-center">
                        <h3 class="mr-1" id="price-<?php echo $row['vehicle_id']; ?>"><?php echo $row['price']; ?>/Per Day</h3>

                        </div>
                        <div class="d-flex flex-column mt-4" style="margin-top: 0px !important;">
                            <h6>Start date:</h6>
                            <input type="date" placeholder="Start Date" id="startdate-<?php echo $row['vehicle_id']; ?>" class="mb-2" min="<?php  echo $row['startdate']; ?>" max="<?php  echo $row['enddate']; ?>" onchange="dateValidate(<?php echo $row['vehicle_id']; ?>)">
                            <h6>End date:</h6>
                            <input type="date" placeholder="End Date" id="enddate-<?php echo $row['vehicle_id']; ?>" class="mb-2" max="<?php  echo $row['enddate']; ?>">
                            <button class="btn btn-primary btn-sm" type="button"  onclick="addToCart(<?php echo $row['vehicle_id']; ?>)" style="margin-top: 15px !important;">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
    
    <div id="cart">
        <button id="backToEquip" onclick="backToEquip()">Back</button>
        <button id="goToCartButton" onclick="redirectToCart()">Go to Cart</button>
    </div>

<script>
    function dateValidate(vehicleId){
        const date = document.getElementById('startdate-' + vehicleId).value;
        document.getElementById('enddate-' + vehicleId).setAttribute('min', date);
    }

    function addToCart(vehicleId)
    {
        var startdate = document.getElementById('startdate-' + vehicleId).value;
        var enddate = document.getElementById('enddate-' + vehicleId).value;
        var price = document.getElementById('price-' + vehicleId).innerText; 

        if (startdate === "" || enddate === "") {
            alert("Please select start date and end date.");
        } else {
            $.post("addToCart.php",
            {
                vehicle_id: vehicleId,
                start_date: startdate,
                end_date: enddate, 
                price: price
            },
            function(data, status){
                alert("Item added to the cart!");
            });
        }
    }

    function redirectToCart() {
        window.location.href = './cart_test.php';
    }

    function backToEquip() {
        window.location.href = 'Equip.html';
    }
</script>

</body>
</html>