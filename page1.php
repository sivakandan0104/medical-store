<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-image: url("images/medical4.png");
        }
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        .head {
            flex: 0 0 8%; 
            /*background-color: #059e9e;*/
            display: flex;
            align-items: center; 
            justify-content: right; 
        }
        .head a{
            margin-right:85px;
            text-decoration:none;
            font-size:20px;
            font-weight: bold;
            color:black;
        }
        a:hover{
            color:black;
        }
        .main {
            flex: 1;
            background-color: #063970;
            color: #fff; 
            display: flex;
        }
        img{
            float:left;
        }
        #id{
            margin-top:12%;
            margin-left:10%;
        }
        #id1{
            font-size:95px;
            color:#059e9e;
        }
        #id2{
            font-size:30px;
        }
        a:hover{
            color:white;
        }
    </style>
</head>
<body>
    <div class="head">
            <a href="#">HOME</a>
            <a href="userlog.php">LOGIN</a>
            <a href="userreg.php">REGISTER</a>
            <a href="adminlog.php">ADMIN</a>
           <!-- <a href="#">CONTACT</a>
            <a href="#">ABOUT US</a>-->
    </div>
    <!--<div class="main">
                <p id="id"><img src="images/main2.png" alt="medical">
                <span id="id1">THULASI</span><br><br>
                <span id="id2">MEDICAL STORE<br><br>
                ALL MEDICAL PRODUCTS AVAILABLE</span></p>
    </div>->
</body>
</html>
