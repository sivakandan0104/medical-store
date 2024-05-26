
<?php
    session_start();
?>
<?php

    include("mysqlconn.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search_item"])) {

        $_SESSION['search_item'] = $_POST['search_item'];

    }
    ?>
<?php
        include("mysqlconn.php");
    
        $username = $_COOKIE['user_id'];

        $searchItem = $_SESSION['search_item'];

        $query = "SELECT * FROM medicine WHERE name = '$searchItem'";

        $result = mysqli_query($conn, $query);

        $image = $name = $dose = $category =  $description = $stock = $amount = $quantity = "";

        if(mysqli_num_rows($result) > 0){
            if($row = mysqli_fetch_assoc($result)){
                    $image = $row["image_path"];
                    $name = ucfirst($row["name"]);
                    $dose =  $row["dose"];
                    $category = ucfirst($row["category"]);
                    $description = $row["description"] ;
                    $amount = $row["amount"];
                    $stock = $row["stock"];
            }
        }
        else{
                echo "<script>alert('ITEM ISNT AVAILABLE');</script>";
                exit();
        }

        if($stock > 0){
            $stock = $stock;
        }
        else{
            $stock = "Out Of Stock";
        }

        try{
            if(isset($_POST['submit'])){

                $quantity = 1;
    
                $sql = "INSERT INTO cart(item_name, user_name, amount, quantity, category) VALUES('$searchItem', '$username', $amount, $quantity, '$category')";

    
                if(mysqli_query($conn, $sql)){
                    echo "<script>alert('Item added to cart successfully');</script>";
                } else {
                    echo "Error adding item to cart: " . mysqli_error($conn);
                }
            }
        }
        catch(mysqli_sql_exception){
            echo "<script>alert('already placed');</script>";
        }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="content.css">
    <style>
        * {
            box-sizing: border-box;
        }

        .main {
            width: 60%;
            border: 2px solid black;
            margin-top:-2%;
            margin-left: 20%;
            /*display: flex;*/
            height: auto;
            /*flex-direction: column;*/
            background-color: white;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .container p{
            font-size:22px;
            margin-left:14%;
        }
        .button {
            display: inline-block;
        }
        img{
            width:200px;
            height:200px;
        }
        #cart, #pur {
            padding: 10px;
            color:black;
            border: 1px solid black;
            font-size:20px;
            cursor: pointer;
        }
        #cart{
            background-color: lightcoral;
        }
        #pur{
            background-color: lightseagreen;
            margin-left:20%;
        }

        .header1 {
            height: 15%; 
            background-color: lightseagreen;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            border-bottom: 1px solid black;
        }
        body{
            margin:0px;
        }

        .header1 h1 {
            font-size: 40px;
            padding: 30px;
        }
        .container{
            width:100%;
            margin:5%;
            flex-direction: column;
        }
        #id1{
            font-weight: bold;
        }
        #id2{
            font-weight: lighter;
            margin-left:20px;
        }
        .display1 {
            display: flex;
            margin-left:30%;
            margin-top: 20px;
        }
        .display1 form, .display1 a {
            margin-right: 20px;
        }
        input[type="submit"], button {
            padding: 10px 20px;
            font-size: 16px;
            margin-left:10%;
        }

        .cont {
            display: flex;
        }
        .left {
            width: 50%;
            margin-top: 20px;
            margin-left:7%;
        }

        .right {
            width: 20%;
            margin-top: 3%;
        }
    </style>
</head>
<body>
    <div class="header1">
        <h1>Product Details</h1>
    </div>

    <div class="main">
        <div class="container">
            <div class="cont">
                <div class="left">
                    <p id="id1">Name : <span id="id2"><?php echo "$name" ?></span></p><br>

                    <p id="id1">Dose : <span id="id2"><?php echo "$dose" ?> g</p><br>

                    <p id="id1">Category : <span id="id2"><?php echo "$category" ?></p><br>
                </div>
                <div class="right">
                    <img src="<?php echo $image ?>" alt="Image">
                </div>
            </div>

            <p id="id1" style="margin-right:20%;">Description : <span id="id2"><?php echo "$description" ?></p><br>

            <p id="id1">Amount :<span id="id2"> RS. <?php echo "$amount" ?></p><br>

            <p id="id1">Stock : <span id="id2"><?php echo "$stock" ?></p><br>

                    

            <div class="display1">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" style="display: inline-block;">
                        <!--<label>QUAN :</label>
                        <input type="number" name="quan" min="1" max="10">-->
                        <input type="submit" id="cart" value="ADD TO CART" name="submit">
                </form>
                <a href="purchase.php"><button id="pur">PURCHASE</button></a>
            </div>
        </div>
    </div>
</body>
</html>




























    