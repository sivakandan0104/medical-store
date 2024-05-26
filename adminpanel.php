
<?php
    include("footer.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> 
    <link rel="stylesheet" href="admin1.css">
    <script src="button.js"></script>
    
    <link rel="stylesheet" href="header.css">
    <style>
        #bb{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius:10px;
            font-family: "Times New Roman", Times, serif;
            font-size:25px;
        }
        #bb:hover{
            box-shadow:none;
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
    <div class="button">
        <a href="additem.php"><button id="bb"><h4>ENTER ITEM</h4></button></a>
        <a href="deleteitem.php"><button id="bb"><h4>DELETE ITEM</h4></button></a>
        <a href="customerlist.php"><button id="bb"><h4>CUSTOMER LIST</h4></button></a>
        <a href="product.php"><button id="bb"><h4>PRODUCT LIST</h4></button></a>
        <a href="orders.php"><button id="bb"><h4>ORDERS</h4></button></a>
    </div>
</body>
</html>
