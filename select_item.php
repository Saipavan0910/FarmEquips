<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
        }

        header {
            background-color: darkcyan;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        img {
            height: 70px;
            border-radius: 50%;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        input[type="text"], input[type="date"] {
            padding: 8px;
            margin: 5px 0;
        }

        button {
            background-color: darkcyan;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button#goToCartButton {
            margin-top: 20px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <header>
        <img src="logo.png" alt="Company Logo">
    </header>

    <table>
        <thead>
            <tr>
                <th>Serial No.</th>
                <th>Products Description</th>
                <th>Price</th>
                <th>Select</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $product_id = $_GET['product_id'];

                include_once "connection.php";
                
                session_start();
                $farmer_id = $_SESSION['farmer_id'];
                $user_id = $_SESSION['user_id'];
                $result = mysqli_query($conn, "SELECT
                            v.description,
                            v.price,
                            v.vehicle_id
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

                $i=1;
                while($row = mysqli_fetch_array($result))
                {

            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td id='price'><?php echo $row['price']; ?></td>
                <td>
                    <input type="date" placeholder="startdate" id="startdate-<?php echo $row['vehicle_id']; ?>">
                    <br>
                    <input type="date" placeholder="enddate" id="enddate-<?php echo $row['vehicle_id']; ?>">
                    <br>
                    <button onclick="addToCart(<?php echo $row['vehicle_id']; ?>)">Add to Cart</button>
                </td>
            </tr>
            <?php
                    $i++;
                }
            ?>
        </tbody>
    </table>

    <button id="goToCartButton" onclick="redirectToCart()">Go to Cart</button>

    <script>
        function addToCart(vehicleId){
            console.log(vehicleId)
            var startdate = document.getElementById('startdate-'+vehicleId).value;
            var enddate = document.getElementById('enddate-'+vehicleId).value;
            var price = document.getElementById('price').innerHTML

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
                    alert("Data: " + data + "\nStatus: " + status);
                });
                alert("Item added to the cart!");
            }
        }

        function redirectToCart() {
        window.location.href = 'cart.html';
    }
    </script>
</body>
</html>