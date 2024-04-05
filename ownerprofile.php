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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://kit.fontawesome.com/4e97f0f302.js" crossorigin="anonymous"></script>
        <style>
            #loginFormContainer {
                display: none;
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
                height: 81vh;
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

            .content{
                display: flex;
            }

            .one{
                width: 25%;
            }
            .two{
                width: 90%;
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
                cursor: pointer;
                background: transparent;
                border: none;
                color: #000;
                font-size: 16px;
            }
            
            #equip,
            #update {
                display: none;
                flex-direction: column;
                align-items: center;
                justify-content: flex-start;
                width: 85%;
                text-align: center;
            }

            #equip h3,
            #update h3 {
                font-family: "fangsong";
                font-size: 30px;
                margin: 20px 0px;
            }

            #equip table,
            #update table {
                width: 85%;
                padding: 0px 0px 20px 0px;
            }

            #equip table thead tr,
            #update table thead tr {
                background-color: #dedede;
                border: 2px solid #ccc;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                border-radius: 20px;
            }

            #equip table thead tr th,
            #update table thead tr th {
                padding: 10px 0px;
            }

            #equip table tr,
            #update table tr {
                font-size: 18px;
                font-family: 'Source Serif 4';
            }

            #equip table tr td,
            #update table tr td {
                padding: 10px;
                margin: 10px;
                text-align: center;
            }

            #equip table tbody tr,
            #update table tbody tr {
                border: 2px solid grey;
                box-shadow: 0 6px 5px rgba(0, 0, 0, 0.1);
                border-radius: 20px;
            }

            #close {
                float: right;
                font-size: 18px;
                font-weight: bold;
            }

            #close:hover,
            #close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }

            .form-group {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                justify-content: space-between;
                padding: 10px 15px;
                font-size: 16px;
                font-family: emoji;
                width: 100%;
                margin-bottom: 0px;
            }

            .btn {
                width: 5rem;
                height: 2rem;
                border-radius: 7px;
                border: 1px solid black;
                margin-right: 18px;
                cursor: pointer;
            }

            .approve {
                background-color: #55b755;
            }

            .reject {
                background-color: #d55252;
            }

            .one{
                width: 30%;
            }

            .modal-content {
                background-color: #fefefe;
                padding: 20px;
                border: 1px solid #888;
                border-radius: 10px; 
                width: 180%;
            }

            .form-control {
                width: 100%;
                height: 40px;
                padding: 5px 10px;
                border-radius: 5px;
                border: 1px solid #ccc;
                box-sizing: border-box;
            }

            .btn {
                width: 100px; /* Set button width */
                height: 40px; /* Set button height */
                border-radius: 5px; /* Add border-radius for rounded corners */
                border: none; /* Remove default button border */
                background-color: #007bff; /* Set button background color */
                color: #fff; /* Set button text color */
                cursor: pointer; /* Add pointer cursor on hover */
            }

            /* Close button */
            #close {
                position: absolute;
                top: 10px;
                right: 10px;
                font-size: 18px;
                font-weight: bold;
                cursor: pointer;
                color: #555;
            }

            #close:hover {
                color: #000;
            }

            /* Background overlay for modal */
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.6); /* Add semi-transparent background */
            }
        </style>
        <script>
            function details(tab) {
                const profile = document.querySelector('.main#profile');
                const equip = document.getElementById('equip');
                const updated = document.getElementById('update');

                if(tab === 'profile'){
                equip.style.display = 'none';
                updated.style.display = 'none';
                profile.style.display = 'flex';
                }
                else if(tab === 'equip') {
                equip.style.display = 'flex';
                profile.style.display = 'none';
                updated.style.display = 'none';
                }
                else {
                equip.style.display = 'none';
                profile.style.display = 'none';
                updated.style.display = 'flex';
                }
            }

            function deleted(vehicleId){
                const result = confirm("Are you sure you want to delete this equipment ?");

                if(result){
                    const url = "deleteequip.php?vehicle_id="+vehicleId ;
                    window.location.href = url;
                }
            }

            function openModal(vehicleId) {
                var modal = document.getElementById("loginFormContainer");
                modal.style.opacity = "none";
                modal.style.display = "flex";

                var form = document.getElementById("loginForm");
                form.action = "updateequip.php?vehicle_id=" + vehicleId;
            }

            function closeModal() {
                var modal = document.getElementById("loginFormContainer");
                modal.style.display = "none";
            }

            function showLogin() {
                document.getElementById('loginSection').style.display = 'block';
                document.getElementById('signUpSection').style.display = 'none';
            }

            function validateForm() {
                var vehicleNumber = document.getElementById('vehicleNumber').value;
                var vehicleNumberRegex = /^[a-zA-Z]{2}\s{0,1}\d{2}\s{0,1}[a-zA-Z]{2}\s{0,1}\d{4}$/;
                var errors = [];
                if (!vehicleNumberRegex.test(vehicleNumber)) {
                errors.push('Invalid Vehicle Number.');
                }

                var vehicleType = document.getElementById('vehicleType').value;
                var description = document.getElementById('description').value;

                var price = document.getElementById('price').value;
                var priceRegex = /^\d+(\.\d{1,2})?$/;
                if (!priceRegex.test(price)) {
                    errors.push('Invalid Price.');
                }

                if (errors.length > 0) {
                    alert(errors.join('\n'));
                    return false;
                }

                var image = document.getElementById('image').value;
                return true;
            }
        </script>
    </head>
    <body>
        <header style="border-bottom-style: solid !important; border-bottom-width: 30px !important;">
            <div>
                <img src="./images/equipment/logo.png" alt="Company Logo" class="logo">
            </div>
            <div class="cart">
                <a href="upload.html"><i class="icon fa-solid fa-upload"></i></a>
                <a href="logout.php" class="icon"><i class="fa-solid fa-power-off"></i></a>
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
                            <li class="list-items"><button onclick="details('equip')">LISTED EQUIPMENT</button></li>
                            <li class="list-items"><button onclick="details('updated')">UPDATE EQUIPMENT</button></li>
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
                                        <p class="data">Owner</p>
                                        <p class="tag" style="font-weight: bold; color: black;">Pan Card:</p>
                                        <p class="data"><?php echo strtoupper($row['pan_card']); ?></p>
                                        <p class="tag" style="font-weight: bold; color: black;">Aadhar Card:</p>
                                        <p class="data"><?php echo htmlspecialchars($row['aadhar_card']); ?></p>
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

    <div id="equip">
        <h3>Your Equipments!!</h3>
        <table>
            <thead>
                <tr>
                    <th>S No.</th>
                    <th>Vehicle Number</th>
                    <th>Model</th>
                    <th>Description</th>
                    <th>From</th>
                    <th>Till</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $owner = mysqli_query($conn, "SELECT * FROM owner WHERE user_id = '$user_id'");
                $row = mysqli_fetch_assoc($owner);
                $owner_id = $row['owner_id'];
                $status = mysqli_query($conn, "SELECT * FROM vehicle where owner_id = $owner_id");

                $has_equip = false;
                $i = 1;

                while($row = mysqli_fetch_assoc($status)){
                $has_equip = true;
                ?>
                <tr>
                    <td>
                    <p><?php echo $i;?></p>
                    </td>
                    <td>
                    <p><?php echo $row['vehicle_num'];?></p>
                    </td>
                    <td>
                    <p><?php echo $row['model'];?></p>
                    </td>
                    <td style="width: 20%;">
                    <p><?php echo $row['description'];?></p>
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
                    <td>
                    <p><?php echo $row['status'];?></p>
                    </td>
                </tr>
                <?php
                $i++;
                }
                if (!$has_equip) {
                echo "<script>
                var orderElement = document.getElementById('equip');
                orderElement.innerHTML = '<span style=\"font-size: 35px; font-family: system-ui; padding: 10rem; margin-left: 6rem;\">No Equipments Listed!! 👨‍🌾</span>';
                </script>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div id="update">
        <h3>Manage Equipments!!</h3>
        <table>
            <thead>
                <tr>
                    <th>S No.</th>
                    <th>Vehicle Number</th>
                    <th>Model</th>
                    <th>Action</th>
                    <th>Status</th>
                </tr>
            </thead>
        <tbody>
            <?php
            $owner = mysqli_query($conn, "SELECT * FROM owner WHERE user_id = '$user_id'");
            $row = mysqli_fetch_assoc($owner);
            $owner_id = $row['owner_id'];
            $status = mysqli_query($conn, "SELECT * FROM vehicle where owner_id = $owner_id AND status = 'Not Rented'");

            $has_equip = false;
            $i = 1;

            while($row = mysqli_fetch_assoc($status)){
                $has_equip = true;
            ?>
            <tr class="<?php echo $row['vehicle_id'] ?>">
                <td>
                    <p><?php echo $i;?></p>
                </td>
                <td>
                    <p><?php echo $row['vehicle_num'];?></p>
                </td>
                <td>
                    <p><?php echo $row['model'];?></p>
                </td>
                <td style="width: 15rem;">
                    <button class="btn btn-primary" onclick="openModal(<?php echo $row['vehicle_id']; ?>)">UPDATE</button>
                    <button class="btn reject" onclick="deleted(<?php echo $row['vehicle_id']; ?>)">DELETE</button>
                </td>
                <td>
                    <p><?php echo $row['status'];?></p>
                </td>
            </tr>
            <?php
                    $i++;
                }
                if (!$has_equip) {
                echo "<script>
                        var orderElement = document.getElementById('equip');
                        orderElement.innerHTML = '<span style=\"font-size: 35px; font-family: system-ui; padding: 10rem; margin-left: 6rem;\">No Equipments Listed!! 👨‍🌾</span>';
                    </script>";
                }
            ?>
        </tbody>
    </table>

    <div id="loginFormContainer" class="modal">
        <div style="margin: 1.75rem 22rem;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update</h5>
                    <button onclick="closeModal()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="loginForm" method="POST" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label for="username">Vehicle number</label>
                            <input type="text" class="form-control" id="username" name="vehicleNumber" placeholder="Enter your vechile number">
                        </div>
                        <div class="form-group">
                            <label for="model">Model</label>
                            <input type="text" class="form-control" id="model" placeholder="Model" name="model" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" placeholder="Description(Company Name, Fuel Type, Power...)" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Price">Price</label>
                            <input type="text" class="form-control" id="price" placeholder="Price (per day)" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="startdate">Start Date</label>
                            <input type="date" class="form-control" id="startdate" name="startdate" required>
                        </div>
                        <div class="form-group">
                            <label for="enddate">End Date</label>
                            <input type="date" class="form-control" id="enddate" name="enddate" required>
                        </div>
                        <div style="text-align: center; width: 85%">
                            <button type="submit" class="btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>