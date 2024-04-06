<?php

include_once "connection.php";

session_start();
$user_id = $_SESSION['user_id'];

$status = mysqli_query($conn, "SELECT * FROM user_details WHERE user_id = '$user_id'");

$row = mysqli_fetch_assoc($status);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile Page</title>
        <script src="https://kit.fontawesome.com/4e97f0f302.js" crossorigin="anonymous"></script>
        <style>
            body {
                margin: 0px;
            }

            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.4);
            }

            .modal-content {
                background-color: #fefefe;
                margin: 15% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 30%;
            }

            .success-message {
                display: none;
                color: green;
                margin-top: 10px;
            }

            .change-button:hover, .edit-button:hover {
                cursor: pointer;
                opacity: 0.8;
            }

            .logoutLink a {
                text-decoration: none;
                color: red; 
            }

            .mainProfilePic {
                width: 100px;
                height: 100px;
                object-fit: cover;
                object-position: center;
            }

            header {
                background-color: darkcyan;
                color: #fff;
                padding: 10px 20px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .main{
                width: 70%;
            }

            .logo {
                height: 90px;
                width: 90px;
                border-radius: 50%;
            }

            header h2{
                font-family: fansong;
                font-size: 35px;
            }

            .content{
                display: flex;
                margin: 5px 20px;
            }

            .cart a {
                margin-bottom: 10px;
                text-decoration: none;
                color: white;
                font-size: 20px;
                border: 1px solid black;
                padding: 10px;
                border-radius: 5px;
                margin-right: 20px;
            }
            .mainPage{
                display: flex;
                flex-grow: 1;
            }

            .container{
                margin: 10px;
            }

            .first-contents{
                display: flex;
                flex-direction: column;
                gap: 5px;
            }


            .wrapper{
                margin: 0;
                border: 2px solid rgba(220, 214, 214, 0.541);
                border-radius: 5px;
            }

            .user-profile{
                padding: 5%;
                display: flex;
                border-radius: 5px;
                background-color: rgb(204, 206, 222);
            }

            .options-list{
                background-color: rgb(204, 206, 222);
                border-radius: 5px;
            }

            .one{
                width: 30%; 
            }
            .two{
                flex-direction: column;
                flex-grow: 1;
            }

            .content-part{
                margin-top: 5%;
            }

            .picture-part{
                display: flex;
                flex-direction: column;
                align-items: center;
                flex-grow: 1;
                margin-bottom: 5%;
            }

            .information{
                width: 60%;
                display: grid;
                padding-left: 3rem;
                grid-template-columns: 1fr 1fr;
                grid-template-rows: 1fr 1fr 1fr 1fr 1fr;
            }

            .total-info{
                display: flex;
            }

            .mainProfilePic{
                margin: 20px 0px;
                display: block;
                border : 1px solid black;
            }

            .change-button{
                background-color: white;
                color: rgb(180, 5, 5);
                border: 1px solid rgb(180, 5, 5);
                padding: 10px 5px;
                border-radius: 5px;
            }

            .info-item{
                display: flex;
                gap: 25px;
            }

            .edit-part{
                padding: 5% 8% 2% 8%;
                display: flex;
                justify-content: space-between;
            }

            .edit-button{
                background-color: rgb(240, 106, 58);
                border: 0;
                width: 25%;
                margin: 20px 0;
                font-size: 20px;
                border-radius: 5px;
            }

            .tag{
                color: rgb(187, 183, 183);
            }

            .data{
                color: rgb(9,49,99);
            }
            .logoutLink{
                text-decoration: none;
                font-size: 20px;
                color: rgb(9,49,99);
                margin: 20px 3.9rem;
            }

            .heading-part{
                margin-left: 3rem;
                color: rgb(9,49,99);
                font-size: 2rem;
            }

            .list{
                list-style: none;   
            }

            .list-items{
                margin: 20px;
                font-size: 20px;
                color: rgb(9,49,99);
            }

            .miniProfile{
                width: 100%;
                border-radius: 50%;
                border : 1px solid black;
            }

            .image-part{
                margin-right: %;
                width: 25%;
            }

            .list-items button{
                background: transparent;
                border: none;
                color: #000;
                font-size: 16px;
                cursor: pointer;
            }

            #order {
                display: none;
                flex-direction: column;
                align-items: center;
                justify-content: flex-start;
                width: 85%;
                height: 81vh;
                text-align: center;
            }

            #order h3 {
                font-family: "fangsong";
                font-size: 30px;
                margin: 20px 0px;
            }

            #order table {
                width: 80%;
                padding: 0px 0px 20px 0px;
            }

            #order table thead tr {
                background-color: #dedede;
                border: 2px solid #ccc;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                border-radius: 20px;
            }

            #order table thead tr th {
                padding: 10px 0px;
            }

            #order table tr {
                font-size: 18px;
                font-family: 'Source Serif 4';
            }

            #order table tr td {
                padding: 10px;
                margin: 10px;
                text-align: center;
            }

            #order table tbody tr {
                border: 2px solid grey;
                box-shadow: 0 6px 5px rgba(0, 0, 0, 0.1);
                border-radius: 20px;
            }
        </style>
        <script>
            function details(tab) {
                const profile = document.querySelector('.main#profile');
                const order = document.getElementById('order');

                if(tab === 'profile'){
                order.style.display = 'none';
                profile.style.display = 'flex';
                }
                else{
                order.style.display = 'flex';
                profile.style.display = 'none';
                }
            }
        </script>
            <script type="text/javascript">
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
    }
    </script>        
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    </head>
    <body>
        <header>
            <div>
                <img src="./images/equipment/logo.png" alt="Company Logo" class="logo">
            </div>
            <div id="google_translate_element" style="margin-left: 760px !important; margin-top: 5px !important;"></div>

            <div class="cart">
                <a href="Equip.html"><i class="icon fa-solid fa-tractor"></i></a>
                <a href="cart_test.php" class="icon"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
        </header>

    <div class="content">
        <div class="container one">
            <div class="first-contents">
                <div class="user-profile">
                    <div class="image-part">
                        <div class="miniProfile" >
                            <h1 style="text-align: center;"><?php echo strtoupper(substr($row['username'], 0, 1));?></h1>
                        </div>
                    </div>
                    <div class="name-part">
                            <h2 style="margin-left: 10px !important; padding-left: 30px !important;"><?php echo strtoupper($row['username']); ?></h2>
                    </div>
                </div>
                <div class="options-list">
                    <ul class="list">
                        <li class="list-items"><button onclick="details('profile')">PROFILE</button></li>
                        <li class="list-items"><button onclick="details('order')">ORDER HISTORY</button></li>
                    </ul>
                    <hr />
                    <div class="logoutLink">
                        <a href="logout.php" style="text-decoration: none; color: rgb(99, 9, 9);">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    <div class ="main" id = "profile">
        <div class="container two">
            <div class="wrapper">
                <div class="heading-part">
                    <p>Customer Profile</p>
                </div>
            </div>
            <div class="wrapper" style="border-top: none">
                <div class="total-info">
                    <div style="border-right: 2px solid rgba(220, 214, 214, 0.541); width: 70%">
                        <div class="content-part">
                            <div class="information">
                                <p class="tag" style="font-weight: bold; color: black;">Username:</p>
                                <p class="data"><?php echo strtoupper($row['username']); ?></p>
                                <p class="tag" style="font-weight: bold; color: black;">Type:</p>
                                <p class="data">Farmer</p>
                                <p class="tag" style="font-weight: bold; color: black;">Pan Card:</p>
                                <p class="data"><?php echo strtoupper($row['pan_card']); ?></p>
                                <p class="tag" style="font-weight: bold; color: black;">Aadhar Card:</p>
                                <p class="data"><?php echo htmlspecialchars($row['aadhar_card']); ?></p>
                                <p class="tag" style="font-weight: bold; color: black;">Location</p>
                                <p class="data"><?php echo htmlspecialchars($row['location']); ?></p>

                                <p class="tag" style="font-weight: bold; color: black;">Phone</p>
                                <p class="data" id="phoneNumber"><?php echo htmlspecialchars($row['phone_number']); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="picture-part">
                        <p class="tag" style="font-size: 20px">Profile Image</p>
                        <div class="mainProfilePic">
                            <h1 style="text-align: center; margin-top: 30px !important;"><?php echo strtoupper(substr($row['username'], 0, 1));?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="order">
        <h3>Your Orders!</h3>
        <table>
            <thead>
                <tr>
                <th>Model</th>
                <th>Product Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Price</th>
                <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $farmer = mysqli_query($conn, "SELECT * FROM farmer WHERE user_id = '$user_id'");
                $row = mysqli_fetch_assoc($farmer);
                $farmer_id = $row['farmer_id'];

                $check_date = mysqli_query($conn, "SELECT
                l.vehicle_id,
                l.end_date,
                o.status, 
                o.order_id
                FROM line_item as l
                INNER JOIN `order` as o ON
                o.order_id = l.order_id
                WHERE
                o.farmer_id = $farmer_id");
                while($check_row = mysqli_fetch_assoc($check_date)){
                    $date = $check_row['end_date'];
                    $curr_Date = date("Y-m-d");
                    $orderId = $check_row['order_id'];
                    $vehicleId = $check_row['vehicle_id'];

                if($curr_Date > $date){
                    $status = mysqli_query($conn, "UPDATE vehicle SET status = 'Not Rented' WHERE vehicle_id = $vehicleId");

                    $status2 = mysqli_query($conn, "UPDATE `order` SET status = 'Done' WHERE farmer_id = $farmer_id AND order_id = $orderId");
                }
                }

                $status = mysqli_query($conn, "SELECT
                l.vehicle_id,
                l.start_date,
                l.end_date,
                l.price,
                l.order_id,
                v.description,
                v.model,
                v.product_id,
                o.order_id,
                o.status,
                o.farmer_id, 
                p.name
                FROM line_item as l
                INNER JOIN vehicle as v ON
                l.vehicle_id = v.vehicle_id
                INNER JOIN `order` as o ON
                o.order_id = l.order_id
                INNER JOIN product as p ON
                v.product_id = p.product_id
                WHERE
                o.farmer_id = $farmer_id AND (o.status = 'Done' OR o.status = 'Placed')");

                $has_order = false;

                while($row = mysqli_fetch_assoc($status)){
                $has_order = true;
                ?>
            <tr>
                <td>
                    <p><?php echo $row['model'];?></p>
                </td>
                <td>
                    <p><?php echo $row['name'];?></p>
                </td>
                <td>
                    <p><?php echo $row['start_date'];?></p>
                </td>
                <td>
                    <p><?php echo $row['end_date'];?></p>
                </td>
                <td>
                    <p><?php echo $row['price'];?></p>
                </td>
                <td>
                    <p><?php echo $row['status'];?></p>
                </td>
            </tr>
            <?php
                }
                if (!$has_order) {
                echo "<script>
                var orderElement = document.getElementById('order');
                orderElement.innerHTML = '<span style=\"font-size: 35px; font-family: system-ui; padding: 10rem; margin-left: 6rem;\">No Orders Yet!! 👨‍🌾</span>';
                </script>";
                }
            ?>
            </tbody>
        </table>
        </div>
    </body>
</html>