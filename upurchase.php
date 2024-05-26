<?php
session_start();
?>
<?php
include("mysqlconn.php");

$username = $_COOKIE['user_id'];

$address = $searchItem = $amount = $cal_amount =  $category = '';

$cal_amount = $_SESSION['cal_amount'];

$items = $_SESSION['items'];

$sql = "SELECT * FROM cart WHERE user_name = '$username'";

$result = mysqli_query($conn, $sql);

if (isset($_POST['order'])) {

    if (isset($_POST['address'])) {
    $address = $_POST['address'];
    }

    while ($row = mysqli_fetch_assoc($result)) {

        $searchItem = $row['item_name'];
        $amount = $row['amount'];
        $category = $row['category'];
        $quantity = 1;
        $status = "Order Placed";
        $orderDate = date("Y-m-d");

        $insertQuery = "INSERT INTO orders (customer_name, item_name, amount, category, status, order_date, address, quantity) 
                        VALUES ('$username', '$searchItem', $amount, '$category', '$status', '$orderDate', '$address', $quantity)";

        $sql4 = mysqli_query($conn, $insertQuery);

        if(isset($sql4)){
            $update = "UPDATE medicine SET stock = stock - $quantity WHERE name = '$searchItem'";
            mysqli_query($conn, $update);

            $sql_delete_cart = "DELETE FROM cart WHERE user_name = '$username'";

            if (mysqli_query($conn, $sql_delete_cart)) {
                /*echo "<script>alert('order placed successfully')</script>";*/
            } else {
                echo "error";
            }
        }
    }
    header("location:main.php");
    exit();
    
}


$conn->close();
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
            display:flex;
            width: 100%;
            height:auto;
            padding-bottom:2%;
            justify-content: center;
            align-items: center;
            border: 1px solid black;
        }
        .header h1{
            font-size:45px;
        }
        

        .main {
            width: 60%;
            border: 1px solid black;
            margin-top:-2%;
            margin-left:20%;
            display: flex;
            height: auto;
            flex-direction: column;
            background-color: white;
            height:auto;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            /*background-color: lightsalmon;*/
        }
        .content{
            width:90%;
            margin-left:5%;
            margin-bottom:5%;
            /*border:1px solid black;*/
            height:auto;
            background-color: white;
        }
        .center{
            margin:5%;
            margin-bottom:5%;
        }
        .center p{
            font-size:20px;
            margin-top:20px;
            margin-bottom: 30px;
            font-weight: bold;
        }
        label{
            font-size:20px;
            font-weight: bold;
            margin-top:20px;
            margin-bottom: 30px;
        }
        textarea {
            width: 100%;
            margin-bottom: 30px;
            font-size:18px;
        }
        input[type=submit]{
            background-color: lightseagreen;
            color:black;
            border:1px solid black;
            padding:12px;
            width:40%;
            font-size:18px;
            border-radius: 4px;
        }
        .display{
            display: inline;
        }
        #value{
            margin-left:26px;
            font-size:23px;
            font-weight:normal;
        }
        input[type=number]{
            margin-left:20px;
            padding:5px;
            font-size:12px;
            width:80px;
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
                    <p>ITEM NAME:<span id="value"><?php foreach ($items as $item) { echo $item ." , ";} ?></span></p>
                </div>
                <div class="display">
                    <p>TOTAL: <span id="value">RS.<?php echo "$cal_amount" ?></span></p>
                </div>

                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <label>ADDRESS :</label><br><br><br>
                    <textarea name="address" rows="5" required></textarea>
                    <center><input type="submit" value="PLACE ORDER" name="order"></center>
                </form>
            </div>
        </div>
    </div>
</body>

</html>