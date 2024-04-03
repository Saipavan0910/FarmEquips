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

        .main{
            height: 81vh;
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
            background-image: url(./images/equipment/profilebgg.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            filter: blur(3px);
            height: 29.5rem;
            width: 68rem;
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

        #equip, 
        #update {
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            width: 85%;
            height: 81vh;
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

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 28rem;
            top: 2rem;
            width: 30%;
        }

        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 15px;
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
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            font-size: 16px;
            font-family: emoji;
            width: 75%;
        }

        .form-control { 
            height: 30px;
            padding-left: 10px;
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
           
        function openModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
        }

        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
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
    <header>
        <div>
            <img src="./images/equipment/logo.png" alt="Comapny Logo" class="logo">
        </div>
        <div class="cart">
            <a href="upload.html"><i class="fa-solid fa-upload"></i></a>
            <a href="logout.php" class="icon"><i class="fa-solid fa-power-off"></i></a>
        </div>
    </header>
    <div id="content">
        <div class="sidebar">
            <div class="profile-pic">
                <h1><?php echo strtoupper(substr($row['username'], 0, 1)); ?></h1>
            </div>
            <button onclick="details('profile')">PROFILE</button>
            <button onclick="details('equip')">LISTED EQUIPMENT</button>
            <button onclick="details('updated')">UPDATE EQUIPMENT</button>
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
                        
                        $status = mysqli_query($conn, "SELECT * FROM vehicle where owner_id = $owner_id");

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
                            <button class="btn approve" onclick="openModal()">UPDATE</button>
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

            <div id="myModal" class="modal">
                <div class="modal-content">
                    <button onclick="closeModal()" id="close"><i class="fa-solid fa-xmark"></i></button>
                    <div class="form-container">
                        <form enctype="multipart/form-data" style="width: 70vh;" onsubmit="return validateForm()" method="POST" action="updateequip.php?vehicle_id=<?php echo $row['vehicle_id']; ?>">
                            <div class="form-group">
                                <label for="vehicleNumber">Vehicle Number</label>
                                <input type="text" class="form-control" placeholder="Vehicle Number" id="vehicleNumber" name="vehicleNumber" required>
                            </div>
                        
                            <div class="form-group">
                                <label for="vehicleType">Vehicle Type</label>
                                <select class="form-control" id="vehicleType" name="vehicleType" required>
                                    <option value="" disabled selected>Select Vehicle</option>
                                    <option value="1">Cultivators</option>
                                    <option value="2">Harvesters</option>
                                    <option value="3">Tractors</option>
                                    <option value="4">Seed Sowing Machine</option>
                                    <option value="5">Sprayers</option>
                                    <option value="6">Tiller</option>
                                    <option value="7">Trailer</option>
                                    <option value="8">Baler</option>
                                    <option value="9">Thresher</option>
                                    <option value="10">Water Pump</option>
                                    <option value="11">Cage Wheel</option>
                                    <option value="12">Plows</option>
                                </select>
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
    </div>
</body>
</html>