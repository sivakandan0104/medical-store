<?php
    include("footer.php");
?>
<?php
    include("mysqlconn.php");

    $orderItems = [];

    if (isset($_POST["dd"])) {

        $date = $_POST["date"];

        $sql = "SELECT * FROM orders WHERE order_date = '$date'";

        $result = mysqli_query($conn,$sql);
    } else {
        $sql = "SELECT * FROM orders";

        $result = mysqli_query($conn, $sql);
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $orderItems[] = array(
            "name" => $row['customer_name'],
            "item" => $row['item_name'],
            "amount" => $row['amount'],
            "category" => $row['category'],
            "status" => $row['status']
        );
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="button.js"></script>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> 
    <style>
        form {
            font-size: 22px;
            margin-top: 2%;
            margin-left: 32%;
        }

        input[type=date] {
            width: 20%;
            font-size: 22px;
        }

        input[type=submit] {
            width: 10%;
            font-size: 22px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div id="adm">
            <h1>ADMIN PANEL</h1>
        </div>
        <div id="but">
            <button onclick="home()"><i class="fas fa-home"></i> HOME</button>
            <button onclick="logout1()"><i class="fas fa-sign-out-alt"></i> LOGOUT</button>
        </div>
    </div>
    <div class="main1">

        <h2>ORDER LIST</h2>
        <hr style="border:1px solid black">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <label>SELECT DATE :</label>
            <input type="date" name="date">
            <input type="submit" name="dd" value="Search">
        </form>
        <table>
    <tr>
        <th>NO</th>
        <th>CUSTOMER NAME</th>
        <th>ITEM NAME</th>
        <th>TOTAL</th>
        <th>CATEGORY</th>
        <th>STATUS</th>
    </tr>
    <?php 
    if (empty($orderItems)) {
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
        foreach ($orderItems as $counter => $orderItem) {
            echo '<tr>';
            echo '<td>'.($counter + 1).'</td>';
            echo '<td>'.$orderItem['name'].'</td>';
            echo '<td>'.$orderItem['item'].'</td>';
            echo '<td>'.$orderItem['amount'].'</td>';
            echo '<td>'.$orderItem['category'].'</td>';
            echo '<td>'.$orderItem['status'].'</td>';
            echo '</tr>';
        }
    }
    ?>
</table><br><br><br>


    </div>
</body>

</html>

