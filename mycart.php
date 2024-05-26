<?php
session_start();

include("mysqlconn.php");

$username = $_COOKIE['user_id'];

$sql = "SELECT * FROM cart WHERE user_name = '$username'";
$result = mysqli_query($conn, $sql);

$cartItems = array();
$items = array();
$cal_amount = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $itemname = ucfirst($row["item_name"]);
    $amount = $row["amount"];
    $quantity = $row["quantity"];
    $category = ucfirst($row["category"]);

    $sql1 = "SELECT image_path FROM medicine WHERE name = '$itemname'";
    $result1 = mysqli_query($conn, $sql1);

    if ($row1 = mysqli_fetch_assoc($result1)) {
        $image = $row1["image_path"];
    }

    $cal_amount += $amount * $quantity;

    $items[] = $itemname;

    $cartItems[] = array(
        "itemname" => $itemname,
        "amount" => $amount,
        "quantity" => $quantity,
        "category" => $category,
        "image" => $image
    );
}

$_SESSION['items'] = $items;
$_SESSION['cal_amount'] = $cal_amount;

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .button p {
            font-size: 28px;
            font-weight: bold;
            text-align: right;
            margin-right: 8%;
        }

        .header {
            background-color: lightseagreen;
            color: white;
            display: flex;
            margin: 0;
            width: 100%;
            height: auto;
            padding-bottom: 2%;
            justify-content: center;
            align-items: center;
            border: 2px solid black;
        }

        .header h1 {
            font-size: 45px;
        }

        .main {
            width: 80%;
            border: 2px solid black;
            margin-top: -2%;
            margin-left: 10%;
            display: flex;
            height: auto;
            flex-direction: column;
            background-color: white;
            height: 750px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .content {
            width: 90%;
            margin: 5%;
            border: 1px solid black;
            height: 700px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            width: 80%;
            margin-left: 10%;
        }

        th,
        td {
            width: 15%;
            text-align: center;
            padding: 8px;
            font-size: 20px;
        }

        caption {
            font-size: 20px;
            margin-top: 3%;
            margin-bottom: 3%;
            font-weight: bold;
        }

        button {
            background-color: #FF474C;
            padding: 6px;
            color: black;
            border: 1px solid black;
        }

        hr {
            border: 1px solid black;
        }

        th {
            background-color: lightgrey;
        }

        .button {
            display: inline-block;
            margin-right: 10px;
            margin-top: 3%;
        }

        .button button {
            padding: 10px;
            color: white;
            background-color: lightseagreen;
            margin-left: 83%;
            width: 8%;
            border: none;
            font-size: 16px;
            border: 1px solid black;
            cursor: pointer;
        }

        img {
            width: 45px;
            height: 30px;
        }
        #order{
            font-size:18px;
            padding:7px;
            background-color: lightseagreen;
            border:1px solid black;
            margin-left:80%;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>MY CART</h1>
    </div>
    <div class="main">
        <table>
            <caption>ITEM SELECTED</caption>
            <table>
    <tr>
        <th>NO</th>
        <th>ITEM</th>
        <th>ITEM NAME</th>
        <th>ITEM PRICE</th>
        <th>QUANTITY</th>
        <th>CATEGORY</th>
        <!--<th>ACTION</th>-->
    </tr>
    <?php 
    if (empty($cartItems)) {
        for ($i = 0; $i < 3; $i++) {
            echo '<tr>';
            echo '<td>&nbsp;</td>';
            echo '<td>&nbsp;</td>';
            echo '<td>&nbsp;</td>';
            echo '<td>&nbsp;</td>';
            echo '<td>&nbsp;</td>';
            echo '<td>&nbsp;</td>';
            echo '</tr>';
        }
    } else {
        foreach ($cartItems as $counter => $cartItem) {
            echo '<tr>';
            echo '<td>'.($counter + 1).'</td>';
            echo '<td><img src="'.$cartItem['image'].'"></td>';
            echo '<td>'.$cartItem['itemname'].'</td>';
            echo '<td>'.$cartItem['amount'].'</td>';
            echo '<td>'.$cartItem['quantity'].'</td>';
            echo '<td>'.$cartItem['category'].'</td>';
            //<!--<td><button><i class="fas fa-trash-alt fa-lg"></i></button></td>-->
            echo '</tr>';
        }
    }
    ?>
        </table>
        <div class="button">
            <form action="upurchase.php" method="post">
                <input type="submit" name="order1" value="PLACE ORDER" id="order">
            </form>
        </div>
    </div>
            </body>

</html>