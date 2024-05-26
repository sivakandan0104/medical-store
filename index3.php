<?php
session_start();

// Check if 'search_item' and 'cal' keys are set in the session
if(isset($_SESSION['search_item']) && isset($_SESSION['cal'])) {
    $item = $_SESSION['search_item'];
    $total = $_SESSION['cal'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .class1{
            width:500px;
            height:400px;
            border:2px solid black;
            margin-left:38%;
            margin-top:6%;
            background-color: white;
        }
        h2{
            text-align: center;
        }
        p{
            margin-left:22px;
            font-size:20px;
            padding:15px;
            font-weight:bold;
        }
        body{
            background-color: lightslategray;
        }
        hr{
            border:1px solid black;
        }
        #id1{
            font-weight: lighter;
            font-size: 25px;
            margin-left:10px;
        }
        a{
            text-decoration: none;
            padding:8px 15px;
            border:1px solid black;
            font-size:20px;
            background-color: lightslategray;
            color:white;
        }
    </style>
</head>
<body>
    <div class="class1">
        <h2>ORDER</h2><hr>
        <p>YOU'RE ORDER PLACED SUCCESSFULLY.</p>
        <p>ITEM NAME : <span id="id1"><?php echo ucfirst($item) ?></span></p>
        <P>TOTAL : <span id="id1"><?php echo $total ?></span></P>
        <center><a href="main.php">OKAY</a></center>
    </div>
</body>
</html>