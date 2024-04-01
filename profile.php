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
    <title>Profile</title>
    <script src="https://kit.fontawesome.com/4e97f0f302.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: darkcyan;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .sidebar {
            background-color: darkslategray;
            width: 15%;
            padding: 18px;
            box-sizing: border-box;
            color: #fff;
        }

        .profile-pic {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            margin: 10px;
            text-align: center;
            font-size: 25px;
            background-color: black;
        }

        .profile-pic h1 {
            margin: 0px;
            padding-top: 16px;
        }

        .sidebar button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            background-color: transparent;
            border: none;
            color: #fff;
            text-align: left;
            cursor: pointer;
        }

        .sidebar button:hover {
            background-color: black;
        }

        .bg-image {
            background-image: url(profilebgg.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            filter: blur(3px);
            height: 29rem;
            width: 67rem;
        }

        .body-text{
            color: black;
            font-weight: bold;
            position: absolute;
            top: 55%;
            left: 53%;
            transform: translate(-50%, -50%);
            z-index: 2;
            width: 76%;
            padding: 0px 20px 0px 20px;
        }

        #content {
            display: flex;
        }

        #box{
            border: 2px solid black;
            border-radius: 40px;
            width: 60%;
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 0px 30px;
            box-shadow: 0px 0px 35px black;
        }

        .usercontent{
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
            width: 50%;
        }

        .usercontent h3{
            margin: 0px;
            font-family: ui-monospace;
            font-size: 18px;
            text-align: start;
            padding: 15px 10px;
            width: 75%;
        }

        .usercontent p{
            margin: 0px;
            padding: 15px 0px;
            font-size: 18px;
            font-family: serif;
            text-align: start;
            width: 100%;
        }

        .avatar{
            width: 50%;
        }

        .avatar img{
            width: 100%;
        }

        #userinfo{
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 20px 40px 0px 40px;
        }

        #order {
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            width: 85%;
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
</head>
<body>
    <header>
        <div>
            <img src="logo.png" alt="Comapny Logo" class="logo">
        </div>
        <h2>DASHBOARD</h2>
        <div class="cart">
            <a href="Equip.html"><i class="icon fa-solid fa-tractor"></i></a>
            <a href="cart.html" class="icon"><i class="fa-solid fa-cart-shopping"></i></a>
        </div>
    </header>
    <div id="content">
        <div class="sidebar">
            <div class="profile-pic">
                <h1>H</h1>
            </div>
            <button onclick="details('profile')">PROFILE</button>
            <button onclick="details('order')">ORDER HISTORY</button>
            <a href="logout.php"><button>LOGOUT</button></a>
        </div>
    
        <div class="main" id="profile">
            <div class="bg-image">
            </div>
            <div class="body-text">
                <div>
                    <h1 style="font-family: fangsong; margin: 0px; padding: 10px 0px 10px 40px;">Welcome, <?php echo strtoupper($row['username']); ?>!👋</h1>
                </div>
                <div id="userinfo">
                    <div id="box">
                        <div class="usercontent">
                            <h3>User Name</h3>
                            <h3>Category</h3>
                            <h3>Location</h3>
                            <h3>Aadhar Card Number</h3>
                            <h3>Pan Card Number</h3>
                            <h3>Phone Number</h3>
                        </div>
    
                        <div class="usercontent" style="width: 30%;">
                            <p><?php echo $row['username']; ?></p>
                            <p>Farmer</p>
                            <p><?php echo $row['location']; ?></p>
                            <p><?php echo $row['aadhar_card']; ?></p>
                            <p><?php echo strtoupper($row['pan_card']); ?></p>
                            <p><?php echo $row['phone_number']; ?></p>
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
                        <th>Model Name</th>
                        <th>Description</th>
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
                        
                        $status = mysqli_query($conn, "SELECT * FROM order
                                    INNER JOIN line_item ON 
                                    order.order_id = line_item.order_id");

                        while($row = mysqli_fetch_assoc($status)){
                    ?>
                    <tr>
                        <td>
                            <p><?php echo $farmer_id;?></p>
                        </td>
                        <td style="width: 20%;">
                            <p><?php echo $row['vehicle_id'];?></p>
                        </td>
                        <td>
                            <p><?php echo $row['startdate'];?></p>
                        </td>
                        <td>
                            <p><?php echo $row['enddate'];?></p>
                        </td>
                        <td>
                            <p><?php echo $row['price'];?></p>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function details(tab) {
            const profile = document.getElementById('profile');
            const order = document.getElementById('order');

            if(tab === 'profile'){
                order.style.display = 'none';
                profile.style.display = 'inherit';
            }
            else{
                order.style.display = 'inherit';
                profile.style.display = 'none';
            }
        }
    </script>
</body>
</html>