<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-image: url("images/medical1.jpg");
        }
        .main{
            width: 20%;
            height:auto;
            margin-left:30%;
            margin-top:8%;
            border:1px solid black;
        }
        h2{
            margin-top:4%;
            font-size:50px;
            color:black;
            text-align: center;
        }
        label{
            font-size:24px;
            margin-left:10%;
        }
        input{
            font-size:18px;
            padding:8px;
            margin-left:10%;
            width:75%;
        }
        input[type=submit]{
            width:80%;
            background-color: lightseagreen;
            color:azure;
            border:1px solid black;
        }
        p{
            font-size:20px;
        }
        h1{
            color:black;
        }
        body{
            background-color: lightgray;
        }
    </style>
</head>
<body>
    <h2>THULASI MEDICAL</h2>
    <div class="main">
        <center><h1>ADMIN LOGIN</h1></center><hr>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <label>username :</label><br><br>
            <input type="text" name="aname"><br><br>
            <label>password :</label><br><br>
            <input type="password" name="apword"><br><br><br>
            <input type="submit" name="enter" value="ENTER"><br>
        </form><br>
        <center><p>Don't Have An Account ?<a href="adminreg.php"> signup</a></p></center>
    </div>
</body>
</html>
<?php
include("mysqlconn.php");

    if (isset($_COOKIE['admin_id'])) {
        header('location:main.php');
        exit();
    }

    if (isset($_POST["enter"])) {
        $adminUsername = $_POST["aname"];
        $adminPassword = $_POST["apword"];

        $sql = "SELECT * FROM admin WHERE username = '$adminUsername'";
        $result = mysqli_query($conn, $sql);

        if ($result && $row = mysqli_fetch_assoc($result)) {
            $storedPassword = $row['password'];

            if ($adminPassword === $storedPassword) {

                setcookie('admin_id', $adminUsername, time() + 86400 * 30, '/');
                header('location:main.php');
            } else {

                echo "<script> alert ('Username/password is incorrect'); </script>";
            }
        } else {

            echo "<script> alert ('Username/password is incorrect'); </script>";
        }
    }

mysqli_close($conn);
?>


