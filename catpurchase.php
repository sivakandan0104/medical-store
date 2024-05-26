<?php
session_start();

include("mysqlconn.php");

$username = $_COOKIE['user_id'];

if(isset($_SESSION['cat']) && isset($_SESSION['items']) && isset($_SESSION['amount'])) {
    $cat = $_SESSION['cat'];
    $Items = $_SESSION['items'];
    $amount = $_SESSION['amount'];

    $sql = "SELECT * FROM medicine WHERE category = '$cat'";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){
        $name = $row['name'];
        $category = $row['category'];
        $price = $row['amount'];

        if(isset($_POST['corder'])){

            $quantity = 1;

            $address = $_POST["address"];

            $orderDate = date("Y-m-d");

            $status = "Order Placed";

            $orderQuery = "INSERT INTO orders (customer_name, item_name, amount, category, status, order_date, address, quantity) 
                           VALUES ('$username', '$name', $price, '$category', '$status', '$orderDate', '$address', $quantity)";

            if (mysqli_query($conn, $orderQuery)) {
                $updateQuery = "UPDATE medicine SET stock = stock - $quantity WHERE name = '$name'";
                if (mysqli_query($conn, $updateQuery)) {
                    echo "<script>alert('Order placed successfully'); window.location.href = 'main.php';</script>";
                } else {
                    echo "<script>alert('Error in updating stock')</script>";
                }
            } else {
                echo "<script>alert('Error in placing order')</script>";
            }
        }
    }
} else {
    echo "<script>alert('Session variables are not set')</script>";
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="purchase.css">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: lightseagreen;
            color: white;
            display: flex;
            width: 100%;
            height: auto;
            padding-bottom: 2%;
            justify-content: center;
            align-items: center;
            border: 1px solid black;
        }

        .header h1 {
            font-size: 45px;
        }


        .main {
            width: 60%;
            border: 1px solid black;
            margin-top: -2%;
            margin-left: 20%;
            display: flex;
            height: auto;
            flex-direction: column;
            background-color:white;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            /*background-color: lightsalmon;*/
        }

        .content {
            width: 90%;
            margin-left: 5%;
            margin-bottom: 5%;
            /*border:1px solid black;*/
            height: auto;
            background-color: white;

        }

        .center {
            margin: 5%;
            margin-bottom: 5%;
        }

        .center p {
            font-size: 20px;
            margin-top: 20px;
            margin-bottom: 30px;
            font-weight: bold;
        }

        label {
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        textarea {
            width: 100%;
            margin-bottom: 30px;
            font-size: 18px;
        }

        input[type=submit] {
            background-color: lightseagreen;
            color: black;
            border: 1px solid black;
            padding: 12px;
            width: 40%;
            font-size: 18px;
            border-radius: 4px;
        }

        .display {
            display: inline;
        }

        #value {
            margin-left: 26px;
            font-size: 23px;
            font-weight: normal;
        }

        input[type=number] {
            margin-left: 20px;
            padding: 5px;
            font-size: 12px;
            width: 80px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>PURCHASE</h1>
    </div>
    <div class="main">
        <center>
            <h2>ENTER DETAILS</h2>
        </center>
        <div class="content">
            <div class="center">
                <div class="display">
                    <p>ITEM NAME:<span id="value"><?php foreach ($Items as $item) { echo $item["name"] . " , "; } ?></span></p>
                </div>
                <div class="display">
                    <p>TOTAL: <span id="value">RS.<?php echo "$amount" ?></span></p>
                </div>
                <div class="display">
                    <p>CATEGORY : <span id="value"><?php echo ucfirst($category) ?></span></p>
                </div>

                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <label>ADDRESS :</label><br><br><br>
                    <textarea name="address" rows="5" required></textarea>
                    <center><input type="submit" value="PLACE ORDER" name="corder"></center>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
